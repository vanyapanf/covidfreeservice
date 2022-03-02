<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if (Auth::check()){
            return redirect()->intended(route('index'));
        }

        $formFields = $request->only(['email', 'password']);

        if (Auth::attempt($formFields)){
            return redirect()->intended(route('index'));
        }

        return redirect(route('login'))->withErrors([
           'email' => 'Не удалось авторизоваться'
        ]);
    }
}
