<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Status::all();
        if (count($users) != 0) {
            $people = User::with('status')->orderBy('id', 'desc')->paginate(50);
            return view('admin.users.index', compact('people'));
        }
        return redirect()->route('admin.index')->with('success', 'Нет статусов');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Status::all();
        if (count($status) == 0) {
            return redirect()->route('users.index')->with('success', 'Нельзя добавить, т.к. нет статусов');
        }
        return view('admin.users.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'status_id' => 'required|integer',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Str::random(8),
            'status_id' => $request->status_id,
        ]);

        session()->flash('success', 'Пользователь создан');
        return redirect()->route('users.index');
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
        $user = User::find($id);
        $status = Status::pluck('title', 'id')->all();
        return view('admin.users.edit', compact('user', 'status'));
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
            'status_id' => 'required|integer',
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Order::where('user_id',$id)->count() == 0){
            $notes = Note::where('user_id',$id)->get();
            foreach ($notes as $note) {
                $note->delete();
            }
            $user = User::find($id);
            $user->delete();
            return redirect()->route('users.index')->with('error', 'Пользователь удален');
        }
        return redirect()->route('orders.index')->with('error', 'Пользователь имеет заказы');
    }
}
