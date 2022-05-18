<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile() {
       return view('web.profile.index');
    }

    public function saveProfileChanges(Request $request) {
        $validateFields = $request->validate([
            'email' => 'nullable|email',
            'name' => 'nullable',
            'surname' => 'nullable',
            'study_group' => 'nullable',
            'password' => 'nullable'
        ]);

        $validateFields['role'] = (isset($validateFields['study_group']))? 'student' : 'worker';

        $user = User::where('id', Auth::user()->id)->first();

        if (isset($validateFields['email'])
            && User::where('email', $validateFields['email'])->exists()){
            return redirect(route('profile'))->withErrors([
                'email' => 'Пользователь с такой почтой уже зарегистрирован'
            ]);
        }

        if (isset($validateFields['email'])) {
            $user->email = $validateFields['email'];
        }
        if (isset($validateFields['name'])) {
            $user->name = $validateFields['name'];
        }
        if (isset($validateFields['surname'])) {
            $user->surname = $validateFields['surname'];
        }
        if (isset($validateFields['study_group'])) {
            $user->study_group = $validateFields['study_group'];
        }
        if (isset($validateFields['role'])) {
            $user->role = $validateFields['role'];
        }
        if (isset($validateFields['password'])) {
            $user->password = Hash::make($validateFields['password']);
        }

        $user->save();

        return redirect(route('user'));
    }
}
