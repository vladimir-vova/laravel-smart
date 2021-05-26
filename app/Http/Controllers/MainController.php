<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Type;
use App\Models\User;
use Aws\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    
    public function index(){
        return view('index');
    }

    // medic
    public function medic()
    {
        return view('websites.medic');
    }

    // tort
    public function tort()
    {
        return view('websites.tort.tort');
    }

    public function svyas()
    {
        return view('websites.tort.svyaz');
    }

    public function orders()
    {
        return view('contact');
    }

    public function contact(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
        ]);

        DB::table('message')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'step' => 2,
            'created_at' => date("Y-m-d"),
        ]);

        $users = User::where('status_id', 2)->orWhere('status_id', 3)->orWhere('status_id', 4)->get();
        foreach ($users as $user) {
            Note::create([
                'name' => 'Новый заказ(сообщение)',
                'user_id' => $user->id,
                'type_id' => Type::where('title', 'сообщение')->first()->id,
                'open' => 1,
                'created_at' => now(),
            ]);
        }

        session()->flash('success', 'Письмо отправлено. Скоро с вами свяжется наш специалист.');
        return redirect()->route('orders.quit');
    }

}
