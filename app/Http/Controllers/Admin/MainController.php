<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function step($way, $name, $step)
    {
        if($way=='down'){
            Work::where('step', $step - 1)->update(['step' => $step]);
            Work::where('step', $step)->where('title',$name)->update(['step' => $step-1]);
        }
        if($way=='up'){
            Work::where('step', $step + 1)->update(['step' => $step]);
            Work::where('step', $step)->where('title', $name)->update(['step' => $step+1]);
        }
        return redirect()->route('works.index')->with('success', 'Изменения сохранены');
    }

    public function contactForm(){
        return view('admin.views.contact');
    }

    public function contact(Request $request){
        //
    }
}
