<?php

namespace App\Http\Controllers;

use App\Mail\RegisterGreeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect(route('index'));
        }

        $validateFields = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'surname' => 'required',
            'study_group' => 'nullable',
            'password' => 'required'
        ]);

        $validateFields['is_admin'] = false;
        $validateFields['status'] = 'healthy';
        $validateFields['role'] = (isset($validateFields['study_group']))? 'student' : 'worker';

        if (User::where('email', $validateFields['email'])->exists()){
            return redirect(route('registration'))->withErrors([
                'email' => 'Такой пользователь уже зарегистрирован'
            ]);
        }

        $user = User::create($validateFields);

        Mail::to($user)->send(new RegisterGreeting($user->name));

        if ($user){
            Auth::login($user);
            return redirect(route('index'));
        }

        return redirect(route('login'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
}
