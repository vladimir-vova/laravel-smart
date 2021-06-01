<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Order;
use App\Models\Status;
use App\Models\Task;
use App\Models\Type;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('open', '=', 1)->orderBy('id', 'desc')->paginate(50);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status_id', 2)->get();
        return view('admin.orders.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(User::where('status_id',2)->orWhere('status_id',3)->orWhere('status_id', 4)->get());
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'users' => 'required',
        ]);

        $order = new Order;

        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->work_id = 2;
        $order->user_id = $request->users;

        $order->save();

        // $data = $request->all();
        // // $data['user_id'] = Status::where('title', 'администратор')->first()->users[0]->id;

        // Order::create($data);

        $users = User::where('status_id', 1)->orWhere('status_id', 2)->get();
        foreach($users as $user){
            Note::create([
            'name' => 'Новый заказ',
            'user_id' => $user->id,
            'type_id' => Type::where('title', 'заказ')->first()->id,
            'open' => 1,
            'created_at' => now(),
        ]);
        }
        
        session()->flash('success', 'Заказ создан');
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $orders = Order::find($id);
        $users = User::where('status_id', 2)->get();
        return view('admin.orders.edit', compact('orders', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'users' => 'required',
        ]);

        Order::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'work_id' => 2,
            'user_id' => $request->users,
        ]);

        return redirect()->route('orders.index')->with('success', 'Изменения сохранены');
    }

    public function showClose()
    {
        $orders = Order::where('open', '=', 2)->paginate(15);
        return view('admin.orders.showClose', compact('orders'));
    }

    // public function wayClose($id)
    // {
    //     Order::find($id)->update(['open'=> 2]);
    //     return redirect()->route('orders.index')->with('success', 'Сделка перемещена');
    // }

    // public function wayOpen(Request $request, $id)
    // {
    //     $search = $request->search;
    //     Order::find($id)->update(['open' => 1]);
    //     return redirect()->route('orders.closeorders',compact('search'))->with('success', 'Сделка перемещена');
    //     // return redirect()->route('orders.closeorders')->with('success', 'Сделка перемещена');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $orders = Order::find($id);
    //     $orders->delete();
    //     return redirect()->route('orders.index')->with('error', 'Заказ удален');
    // }

    public function orderUpdate(Request $request)
    {
        Order::find($request->id)->update(['open' => 2]);
        return response()->json(['success' => true], 200);
        // return redirect()->route('orders.index')->with('success', 'Сделка перемещена');
    }

    public function wayOpen(Request $request)
    {
        Order::find($request->id)->update(['open' => 1]);
        return response()->json(['success' => true], 200);
        // return redirect()->route('orders.index')->with('success', 'Сделка перемещена');
    }

    public function orderDelete(Request $request)
    {
        // dd($request->all());
        // session()->flash('error', 'Письмо удалено'.$request->id);
        if(Task::where('order_id', $request->id)->count() == 0){
            Order::where('id', $request->id)->delete();
            return response()->json(['success' => true], 200);
        }
        session()->flash('error', 'Заказ невозможно удалить');
    }
}
