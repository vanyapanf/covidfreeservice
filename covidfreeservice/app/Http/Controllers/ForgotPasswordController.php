<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request){
        $validateFields = $request->validate([
            'email' => 'required|email|string|exists:users'
        ]);

        $user = User::where(['email' => $validateFields['email']])->first();

        if (!$user){
            return redirect(route('forgot_password'))->withErrors([
                'email' => 'Такого пользователя не существует'
            ]);
        }

        $new_password = uniqid();

        $user->password = Hash::make($new_password);
        $user->save();

        Mail::to($user)->send(new ForgotPassword($new_password));

        return redirect(route('index'));
    }
}
