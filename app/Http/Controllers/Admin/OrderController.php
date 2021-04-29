<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
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
        if(Auth::user()->status_id==2 || Auth::user()->status_id == 3){
            $orders = Order::orderBy('id', 'desc')->paginate(50);
        }else {
            $orders = Order::where('client_id','=', Auth::user()->id)->orderBy('id', 'desc')->paginate(50);
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
        // dd($request->all());
        $request->validate([
            'condition' => 'required',
            'type' => 'required',
            'direction' => 'required',
            'start' => 'required',
            'description' => 'required',
        ]);
        Order::create([
            'condition' => $request->condition,
            'type' => $request->type,
            'direction' => $request->direction,
            'start' => $request->start,
            'description' => $request->description,
            'client_id' => auth()->user()->id,
        ]);
        session()->flash('success', 'Пользователь создан');
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
        $work = ['В ожидании', 'В работе', 'Тестирование', 'На проверке'];

        $coor = User::where('status_id','=','4')->orderBy('id', 'desc')->get();
        $orders = Order::find($id);
        // $status = Status::pluck('title', 'id')->all();
        return view('admin.orders.edit', compact('orders', 'coor', 'condition', 'type', 'direction', 'start','work'));
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
        // dd($request->work_id);
        if($request->work_id == null && $request->user_id == null){
            $request->validate([
                'condition' => 'required',
                'type' => 'required',
                'direction' => 'required',
                'start' => 'required',
                'description' => 'required',
                'work_id' => 'required|integer',
                'user_id' => 'required|integer',
            ]);
        } else {
            $request->validate([
                'condition' => 'required',
                'type' => 'required',
                'direction' => 'required',
                'start' => 'required',
                'description' => 'required',
            ]);
        }
        $orders = Order::find($id);
        $orders->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
