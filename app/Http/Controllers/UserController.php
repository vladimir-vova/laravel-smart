<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function create()
    // {
    //     return view('user.register');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'password_id' => 1,
    //     ]);

    //     session()->flash('success', 'Регистрация пройдена');
    //     Auth::login($user);

    //     $users = User::where('status_id', 2)->orWhere('status_id', 3)->get();
    //     foreach ($users as $user) {
    //         Note::create([
    //             'name' => 'Новый пользователь',
    //             'user_id' => $user->id,
    //             'type_id' => Type::where('title', 'пользователь')->first()->id,
    //             'open' => 1,
    //             'created_at' => now(),
    //         ]);
    //     }

    //     return redirect()->route('admin.index');
    //     // return redirect()->route('login.create');
    // }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
        session()->flash('success', 'Вы авторизовались');
        return redirect()->route('admin.index');
        // if (Auth::user()->is_admin) {
        //     return redirect()->route('admin.index');
        // } else {
        //     return redirect()->route('admin.index');
        // }
        }

        return redirect()->back()->with('error', 'Incorrect login or password');
    }

    public function passwordForm(){
        return view('user.password');
    }

    public function password(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
        if(User::where('email', $request->email)->count()==1){
            User::where('email', $request->email)->update([
                'password' => bcrypt($request->password),
                'password_id' => 1,
            ]);
            return redirect()->route('login.create')->with('success', 'Пароль изменен');
        }
        return redirect()->route('password.create')->with('error', 'Такой email не существует');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
