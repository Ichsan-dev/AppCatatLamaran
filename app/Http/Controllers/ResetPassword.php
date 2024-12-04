<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePasswordRequest;


class ResetPassword extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('ResetPassword.index', compact('user'));
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();

        // Cek apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back();
        }

        // Perbarui kata sandi
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('ResetPassword')->with('status', 'Kata sandi berhasil diperbarui.');
    }
}
