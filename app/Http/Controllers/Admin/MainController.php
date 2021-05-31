<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Status;
use App\Models\Type;
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
    public function profile()
    {
        $users = Status::all();
        if (count($users) != 0) {
            return view('admin.views.profile');
        }
        return redirect()->route('admin.index')->with('success', 'Нет статусов');
    }


    public function profileData(Request $request)
    {
        if (User::find(Auth::user()->id)->email == $request->email) {
            $request->validate([
                'name' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
            ]);
        }

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

    public function note()
    {
        $note = Note::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        return view('admin.views.note.index', compact('note'));
    }

    public function noteUpdate(Request $request)
    {
        session()->flash('success', 'Письмо прочитано');
        Note::where('id', $request->id)->update([
            'open' => 2,
        ]);
        return response()->json(['success' => true], 200);
    }

    public function noteDelete(Request $request)
    {
        // dd($id);
        // session()->flash('error', 'Письмо удалено'.$request->id);
        Note::where('id', $request->id)->delete();
        return response()->json(['success' => true], 200);
        // session()->flash('error', 'Письмо удалено');
    }
}
