<?php

namespace App\Http\Controllers;

use App\Models\{Theme, Category, User, Comments};
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function profileIndex($name) {
        #Валидация добавь
        $user = User::where('name', $name)->with('comments')->first();
        $comments = Comments::with('user')->where('user_id', $name)->get();
        return Inertia::render('Profile', [
            'themes' => Theme::where('user_id', $user->id)->get(),
            'user' => $user,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'comments' => $comments
            // 'user' => Auth::user(),
        ]);
    }

    public function updateAvatar(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'avatar_change' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // dd($request->all());
        
        $user = Auth::user();
        $avatarPath = public_path($user->avatar);
    
        // Удаляем старую аватарку, если она существует
        if ($user->avatar && file_exists($avatarPath)) {
            unlink($avatarPath);
        }
    
        // Сохраняем новую аватарку
        $name = time() . "." . $request->file('avatar_change')->extension();
        $destination = 'avatars'; // Путь для хранения аватарок
        $path = $request->file('avatar_change')->storeAs($destination, $name, 'public');
    
        // Обновляем путь к аватарке в базе данных
        $user->where('id', $user->id)->update([
            'avatar' => $path
        ]);
    
        return redirect()->back()->with('success', 'Аватарка успешно изменена!');
    }
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => $request->user(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function download($name)
    {
        $user = User::where('name', $name)->firstOrFail();

        $content = "Имя: {$user->name}\n";
        $content .= "Email: {$user->email}\n";
        $content .= "Возраст: {$user->age} лет\n";

        // Устанавливаем заголовки для скачивания файла
        return response()->stream(function () use ($content) {
            echo $content;
        }, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="profile.txt"',
        ]);
    }
}
