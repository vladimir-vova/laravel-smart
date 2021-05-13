<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function message(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        // dd($request->all());
        $messages = DB::table('message')->where('name', 'LIKE', "%{$request->search}%")->orWhere('email', 'LIKE', "%{$request->search}%")->orWhere('subject', 'LIKE', "%{$request->search}%")->orderBy('id', 'desc')->paginate(50);
        return view('admin.views.contact.index', compact('messages'));
    }

    public function users(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        // dd($request->all());
        $people = User::with('status')->where('name', 'LIKE', "%{$request->search}%")->orWhere('email', 'LIKE', "%{$request->search}%")->orderBy('id', 'desc')->paginate(50);
        return view('admin.users.index', compact('people'));
        // $messages = DB::table('message')->where('name', 'LIKE', "%{$request->search}%")->orWhere('email', 'LIKE', "%{$request->search}%")->orWhere('subject', 'LIKE', "%{$request->search}%")->orderBy('id', 'desc')->paginate(50);
        // return view('admin.views.contact.index', compact('messages'));
    }

    public function orders(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        if (Auth::user()->status_id == 2 || Auth::user()->status_id == 3) {
            $orders = Order::with('user')->with('work')->with('client')->where('open', '=', 1)
            ->where(function ($query) {
                $query->where('condition', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('type', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('direction', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('start', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('description', 'LIKE', "%{$_REQUEST['search']}%");
            })->orderBy('id', 'desc')->paginate(50);
        } else {
            $orders = Order::with('user')->with('work')->with('client')->where('open', '=', 1)->where('client_id', '=', Auth::user()->id)
            ->where(function ($query) {
                $query->where('condition', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('type', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('direction', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('start', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('description', 'LIKE', "%{$_REQUEST['search']}%");
            })->orderBy('id', 'desc')->paginate(50);
        }
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersclose(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        // $orders = Order::where('open', '=', 2)->where('client_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        if (Auth::user()->status_id == 2 || Auth::user()->status_id == 3) {
            $orders = Order::where('open', '=', 2)
            ->where(function ($query) {
                $query->where('condition', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('type', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('direction', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('start', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('description', 'LIKE', "%{$_REQUEST['search']}%");
            })->orderBy('id', 'desc')->paginate(50);
        } else {
            $orders = Order::where('open', '=', 2)->where('client_id', '=', Auth::user()->id)
            ->where(function ($query) {
                $query->where('condition', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('type', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('direction', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('start', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('description', 'LIKE', "%{$_REQUEST['search']}%");
            })->orderBy('id', 'desc')->paginate(50);
        }
        return view('admin.orders.showClose', compact('orders'));
    }

    public function taskclose(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        $tasks = Task::where('open', '=', 2)
        ->where('name', 'LIKE', "%{$request->search}%")
        ->paginate(15);
        return view('admin.tasks.showClose', compact('tasks'));
        // dd($request->all());
        // $people = User::with('status')->where('name', 'LIKE', "%{$request->search}%")->orWhere('email', 'LIKE', "%{$request->search}%")->orderBy('id', 'desc')->paginate(50);
        // return view('admin.users.index', compact('people'));
        // $messages = DB::table('message')->where('name', 'LIKE', "%{$request->search}%")->orWhere('email', 'LIKE', "%{$request->search}%")->orWhere('subject', 'LIKE', "%{$request->search}%")->orderBy('id', 'desc')->paginate(50);
        // return view('admin.views.contact.index', compact('messages'));
    }
}