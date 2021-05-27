<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Order;
use App\Models\Type;
use App\Models\User;
use Aws\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

    // remont
    public function remont()
    {
        return view('websites.remont');
    }

    // public function orders()
    // {
    //     return view('contact');
    // }

    public function contact(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // DB::table('message')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'subject' => $request->subject,
        //     'message' => $request->message,
        //     'step' => 2,
        //     'created_at' => date("Y-m-d"),
        // ]);

        $users = User::where('status_id', 1)->orWhere('status_id', 2)->get();
        foreach ($users as $user) {
            Note::create([
                'name' => 'Новый заказ',
                'user_id' => $user->id,
                'type_id' => Type::where('title', 'заказ')->first()->id,
                'open' => 1,
                'created_at' => now(),
            ]);
        }

        session()->flash('success', 'Письмо отправлено. Скоро с вами свяжется наш специалист.');
        return redirect()->route('spasibo');
        // return Redirect::to('/#contact');
    }

    public function spasibo()
    {
        return view('spasibo');
    }

}
