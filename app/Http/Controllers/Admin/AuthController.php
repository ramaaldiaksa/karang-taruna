<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\AdminResetPasswordMail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    /**
     * Tampilkan form Lupa Password
     */
    public function showForgotPasswordForm()
    {
        return view('admin.forgot-password');
    }

    /**
     * Kirim link reset password ke email admin
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Kami tidak dapat menemukan admin dengan alamat email tersebut.',
            ])->onlyInput('email');
        }

        // Generate Secure Token
        $token = Str::random(64);

        // Hapus token lama untuk email ini jika ada
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Simpan token baru
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        // Buat URL Reset Password
        $resetUrl = url('/admin/reset-password/' . $token . '?email=' . urlencode($request->email));

        // Kirim email
        try {
            Mail::to($request->email)->send(new AdminResetPasswordMail($user, $resetUrl));
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Gagal mengirim email reset password: ' . $e->getMessage(),
            ])->onlyInput('email');
        }

        return back()->with('status', 'Link reset password telah dikirim ke email Anda! Silakan periksa kotak masuk.');
    }

    /**
     * Tampilkan form Reset Password
     */
    public function showResetForm(Request $request, $token)
    {
        return view('admin.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Proses pembaruan password admin
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record) {
            return back()->withErrors([
                'email' => 'Permintaan reset password tidak valid atau telah kedaluwarsa.',
            ]);
        }

        // Cek kedaluwarsa (1 jam / 60 menit)
        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors([
                'email' => 'Link reset password telah kedaluwarsa. Silakan ajukan ulang.',
            ]);
        }

        // Cek kecocokan token
        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors([
                'email' => 'Token reset password tidak valid.',
            ]);
        }

        // Update password user admin
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Hapus token reset dari database
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return redirect('/admin/login')->with('success', 'Password Anda berhasil diperbarui! Silakan masuk menggunakan password baru.');
        }

        return back()->withErrors([
            'email' => 'Gagal memperbarui password. Akun admin tidak ditemukan.',
        ]);
    }
}
