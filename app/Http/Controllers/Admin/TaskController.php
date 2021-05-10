<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('open','<>',2)->get();
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
        // dd(Carbon::createFromFormat('m/d/Y', $request->date1)->format('d-m-Y'));
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
            'created_at' => Carbon::createFromFormat('m/d/Y', $request->date1)->format('d-m-Y'),
            'updated_at' => Carbon::createFromFormat('m/d/Y', $request->date2)->format('d-m-Y'),
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
        $task = Task::find($id);
        $works = Work::orderBy('step', 'asc')->get();
        $orders = Order::select('id')->orderBy('id', 'desc')->get();
        $users = User::where('status_id', '<>', '1')->get();
        return view('admin.tasks.show', compact('task', 'works', 'orders', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $works = Work::orderBy('step', 'asc')->get();
        $orders = Order::select('id')->orderBy('id', 'desc')->get();
        $step = [0 => 'Срочное', 1 => 'Обычное'];
        $users = User::where('status_id', '<>', '1')->get();
        $taus = DB::table('task_user')->where('task_id',$id)->get();
        // dd($users[1]->task);
        // foreach($users as $item){
        //     dd($item->task[0]->id);
        // }
        return view('admin.tasks.edit', compact('task', 'works', 'orders', 'step', 'users', 'taus'));
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
        $request->validate([
            'name' => 'required',
            'status' => 'required|integer',
            'description' => 'required',
            'order' => 'required|integer',
            'step' => 'required|integer',
            'open' => 'required|integer',
            // 'users' => 'required|integer',
        ]);

        $task = Task::find($id);
        $data = $request->all();

        $data['created_at'] = Carbon::createFromFormat('m/d/Y', $request->date1)->format('d-m-Y');
        $data['updated_at'] = Carbon::createFromFormat('m/d/Y', $request->date2)->format('d-m-Y');

        $task->update($data);
        $task->user()->sync($request->users);

        return redirect()->route('tasks.index')->with('success', 'Изменения сохранены');
    }

    public function showClose(){
        $tasks = Task::where('open', '<>', 1)->paginate(15);
        return view('admin.tasks.showClose', compact('tasks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
        return redirect()->route('tasks.closetasks')->with('error', 'Задача удалена');
    }
}
