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
        $orders = Order::where('open', '=', 1)
            ->where(function ($query) {
                $query->where('name', 'LIKE', "%{$_REQUEST['search']}%")
                    ->orWhere('email', 'LIKE', "%{$_REQUEST['search']}%");
            })->orderBy('id', 'desc')->paginate(50);
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersclose(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        $orders = Order::where('open', '=', 2)
            ->where(function ($query) {
                $query->where('name', 'LIKE', "%{$_REQUEST['search']}%")
                ->orWhere('email', 'LIKE', "%{$_REQUEST['search']}%");
            })->orderBy('id', 'desc')->paginate(50);
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
