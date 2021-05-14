<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Order;
use App\Models\Status;
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
        if (Auth::user()->status_id == 2 || Auth::user()->status_id == 3) {
            $orders = Order::with('user')->with('work')->with('client')->where('open', '=', 1)->orderBy('id', 'desc')->paginate(50);
        } else {
            $orders = Order::with('user')->with('work')->with('client')->where('open', '=', 1)->where('client_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(50);
        }
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $condition = ['Новый проект', 'Существующий проект', 'Спасти проект'];
        $type = ['Интернет-магазин', 'Адаптивный сайт', 'Мобильное приложени', 'Личный кабинет', 'Другое'];
        $direction = ['Розничные продажи', 'Оптовые продажи', 'Производственная компания', 'Другое'];
        $start = ['Немедленно', 'В течение недели', 'В течение месяца'];
        return view('admin.orders.create', compact('condition', 'type', 'direction', 'start'));
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
            'condition' => 'required',
            'type' => 'required',
            'direction' => 'required',
            'start' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();

        $data['client_id'] = Auth::user()->id;
        // $data['user_id'] = Status::where('title', 'администратор')->first()->users[0]->id;

        Order::create($data);

        $users = User::where('status_id', 2)->orWhere('status_id', 3)->orWhere('status_id', 4)->get();
        foreach($users as $user){
            Note::create([
            'name' => 'Новый заказ',
            'user_id' => $user->id,
            'type_id' => Type::where('title', 'заказ')->first()->id,
            'open' => 1,
            'created_at' => now(),
        ]);
        }

        // Order::create([
        //     'condition' => $request->condition,
        //     'type' => $request->type,
        //     'direction' => $request->direction,
        //     'start' => $request->start,
        //     'description' => $request->description,
        //     'client_id' => Auth::user()->id,
        //     'user_id' => Status::where('title', 'администратор')->first()->id,
        // ]);
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
        $condition = ['Новый проект', 'Существующий проект', 'Спасти проект'];
        $type = ['Интернет-магазин', 'Адаптивный сайт', 'Мобильное приложени', 'Личный кабинет', 'Другое'];
        $direction = ['Розничные продажи', 'Оптовые продажи', 'Производственная компания', 'Другое'];
        $start = ['Немедленно', 'В течение недели', 'В течение месяца'];
        // $work = ['В ожидании', 'В работе', 'Тестирование', 'На проверке'];
        
        $work = Work::orderBy('step', 'asc')->get();
        $coor = User::where('status_id', '=', '4')->orderBy('id', 'asc')->get();
        $orders = Order::find($id);
        // $status = Status::pluck('title', 'id')->all();
        return view('admin.orders.edit', compact('orders', 'coor', 'condition', 'type', 'direction', 'start', 'work'));
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
        // dd($request->user_id);
        if ($request->work_id != null && $request->user_id != null) {
            $request->validate([
                'condition' => 'required',
                'type' => 'required',
                'direction' => 'required',
                'start' => 'required',
                'description' => 'required',
                'work_id' => 'required|integer',
                'user_id' => 'required|integer',
                'open' => 'required|integer',
            ]);
        } else {
            $request->validate([
                'condition' => 'required',
                'type' => 'required',
                'direction' => 'required',
                'start' => 'required',
                'description' => 'required',
                'open' => 'required|integer',
            ]);
        }
        $data = $request->all();
        $orders = Order::find($id);
        $orders->update($data);

        return redirect()->route('orders.index')->with('success', 'Изменения сохранены');
    }

    public function showClose()
    {
        if (Auth::user()->status_id == 2 || Auth::user()->status_id == 3) {
            $orders = Order::where('open', '=', 2)->paginate(15);
        } else {
            // $orders = Order::with('user')->with('client')->where('open', '<>', 1)->paginate(15);
            $orders = Order::where('open', '=', 2)->where('client_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        }
        return view('admin.orders.showClose', compact('orders'));
    }

    public function wayClose(Request $request, $id)
    {
        Order::find($id)->update(['open'=> 2]);
        return redirect()->route('orders.index')->with('success', 'Сделка перемещена');
    }

    public function wayOpen(Request $request, $id)
    {
        $search = $request->search;
        Order::find($id)->update(['open' => 1]);
        return redirect()->route('orders.closeorders',compact('search'))->with('success', 'Сделка перемещена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Order::find($id);
        $orders->delete();
        return redirect()->route('orders.index')->with('error', 'Заказ удален');
    }
}
