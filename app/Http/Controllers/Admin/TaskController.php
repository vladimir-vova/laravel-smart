<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $works = Work::orderBy('step', 'asc')->get();
        return view('admin.tasks.index', compact('works', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::pluck('title', 'id')->all();
        // $tags = Tag::pluck('title', 'id')->all();
        $users = User::where('status_id','<>','1')->get();
        $works = Work::orderBy('step', 'asc')->get();
        $orders = Order::select('id')->orderBy('id', 'desc')->get();
        return view('admin.tasks.create', compact('works','orders', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required',
            'status' => 'required|integer',
            'description' => 'required',
            'order' => 'required|integer',
            'step' => 'required|integer',
            // 'users' => 'required|integer',
        ]);

        $task = Task::create([
            'name' => $request->name,
            'work_id' => $request->status,
            'description' => $request->description,
            'order_id' => $request->order,
            'step' => $request->step,
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => Auth::user()->id,
            'open' => 1,
        ]);

        $task->user()->sync($request->users);

        return redirect()->route('tasks.index')->with('success', 'Задача добавлена');
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
        //
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
        //
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
