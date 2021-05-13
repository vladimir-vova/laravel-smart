<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    // Главная
    public function index()
    {
        return view('admin.index');
    }

    // Профиль
    public function profile(){
        return view('admin.views.profile');
    }

    public function profileData(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find(Auth::user()->id);
        $user->update($request->all());

        return redirect()->route('profile.index')->with('success', 'Изменения сохранены');
    }

    public function profilePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        User::where('id', Auth::user()->id)->update([
            'password' => bcrypt($request->password),
            'password_id' => 1,
        ]);

        return redirect()->route('profile.index')->with('success', 'Пароль изменен');
    }

    /* изменение шага в статусе списка  */

    public function step($way, $name, $step)
    {
        if ($way == 'down') {
            Work::where('step', $step - 1)->update(['step' => $step]);
            Work::where('step', $step)->where('title', $name)->update(['step' => $step - 1]);
        }
        if ($way == 'up') {
            Work::where('step', $step + 1)->update(['step' => $step]);
            Work::where('step', $step)->where('title', $name)->update(['step' => $step + 1]);
        }
        return redirect()->route('works.index')->with('success', 'Изменения сохранены');
    }

    /* Работа с contact */

    public function contactForm()
    {
        return view('admin.views.contact');
    }

    public function contact(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'name' => 'required',
            // 'email' => 'required|email',
            'subject' => 'required',
        ]);

        DB::table('message')->insert([
            // 'name' => $request->name,
            // 'email' => $request->email,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'step' => 1,
            'created_at' => date("Y-m-d"),
        ]);

        session()->flash('success', 'Письмо отправлено');
        return redirect()->route('contact.create');
    }

    public function message(){
        $messages = DB::table('message')->orderBy('id', 'desc')->paginate(50);
        return view('admin.views.contact.index', compact('messages'));
    }

    public function messageShow($message){
        $message = DB::table('message')->find($message);
        return view('admin.views.contact.show', compact('message'));
    }

    public function messageDestroy($message){
        DB::table('message')->where('id', '=', $message)->delete();
        return redirect()->route('message.index')->with('error', 'Письмо удалено');
    }

    public function note()
    {
        $note = Note::orderBy('id', 'desc')->paginate(50);
        return view('admin.views.note.index', compact('note'));
    }
}
