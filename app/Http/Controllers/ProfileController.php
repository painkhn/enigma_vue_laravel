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
use Carbon\Carbon;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function profileIndex($name) {
        #Валидация добавь
        $user = User::where('name', $name)->with('comments')->first();
        $comments = Comments::with('user')->where('profile_id', $user->id)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Profile', [
            'themes' => Theme::where('user_id', $user->id)->get(),
            'user' => $user,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'comments' => $comments
            // 'user' => Auth::user(),
        ]);
    }

    public function Admin() {
        $users = User::all();
        // $users_limited = User::all()->limit(10);
        $themes = Theme::with('category')->get();
    
        // Получаем новых пользователей за последние 7 дней
        $newUsers = User::where('created_at', '>=', now()->subDays(7))
                        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')
                        ->get();
    
        return Inertia::render('AdminPage', [
            'users' => $users,
            'themes' => $themes,
            'newUsers' => $newUsers,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function banUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_ban = true;
        $user->save();

        return redirect()->back()->with('success', 'Пользователь забанен.');
    }

    public function unbanUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_ban = false;
        $user->save();

        return redirect()->back()->with('success', 'Пользователь разбанен.');
    }

    public function search(Request $request) {
        $word = $request->word;
        $user_search = User::where('name', 'like', "%{$word}%")->orderBy('id')->get();
        // return $this->index($theme=$theme_search);
        return response()->json($user_search);
    }

    public function excel()
    {
        $totalUsers = User::count() ?: '0';
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count() ?: '0';
        $usersThisHalfYear = User::where('created_at', '>=', Carbon::now()->subMonths(6))->count() ?: '0';
        $usersThisYear = User::where('created_at', '>=', Carbon::now()->subYear())->count() ?: '0';

        $totalThemes = Theme::count() ?: '0';
        $themesThisMonth = Theme::whereMonth('created_at', Carbon::now()->month)->count() ?: '0';
        $themesThisHalfYear = Theme::where('created_at', '>=', Carbon::now()->subMonths(6))->count() ?: '0';
        $themesThisYear = Theme::where('created_at', '>=', Carbon::now()->subYear())->count() ?: '0';

        $data = [
            [' '],
            ['Всего пользователей', $totalUsers],
            ['Пользователей за этот месяц', $usersThisMonth],
            ['Пользователей за полгода', $usersThisHalfYear],
            ['Пользователей за год', $usersThisYear],
            [' '],
            ['Всего тем', $totalThemes],
            ['Тем за этот месяц', $themesThisMonth],
            ['Тем за полгода', $themesThisHalfYear],
            ['Тем за год', $themesThisYear],
        ];

        return Excel::download(new ReportExport($data), 'report.xlsx');
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
