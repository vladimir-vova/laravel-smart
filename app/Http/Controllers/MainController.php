<?php

namespace App\Http\Controllers;

use Aws\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    
    public function index(){
        return view('index');
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

        session()->flash('success', 'Письмо отправлено. Скоро с вами свяжется наш специалист.');
        return redirect()->route('orders.quit');
    }

}
