<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Order;
use App\Models\Task;
use App\Models\Type;
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
        // if(in_array(user_id,$task->user->pluck('id')->all()))
        $tasks = Task::with('work')->where('open', '=', 1)->get();
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
        $users = User::all();
        if (count($users) == 0) {
            return redirect()->route('tasks.index')->with('error', 'Невозможно добавить, т.к. пользователей нет');
        }
        $works = Work::orderBy('step', 'asc')->get();
        if (count($works) == 0) {
            return redirect()->route('tasks.index')->with('error', 'Невозможно добавить, т.к. статусов нет');
        }
        $orders = Order::select('id')->where('open', '=', 1)->orderBy('id', 'desc')->get();
        if(count($orders) == 0){
            return redirect()->route('tasks.index')->with('error', 'Невозможно добавить, т.к. заказов нет');
        }
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

        $task = new Task;

        $task->name = $request->name;
        $task->work_id = $request->status;
        $task->description = $request->description;
        $task->order_id = $request->order;
        $task->step = $request->step;
        $task->created_at = Carbon::createFromFormat('m/d/Y', $request->date1)->format('d-m-Y');
        $task->updated_at = Carbon::createFromFormat('m/d/Y', $request->date2)->format('d-m-Y');
        $task->user_id = Auth::user()->id;
        $task->open = 1;

        $task->save();

        $users = User::where('status_id', 1)->orWhere('status_id', 2)->get();
        foreach ($users as $user) {
            Note::create([
                'name' => 'Создана задача  №' . $task->id,
                'user_id' => $user->id,
                'type_id' => Type::where('title', 'задача')->first()->id,
                'open' => 1,
                'created_at' => now(),
            ]);
        }

        foreach ($request->users as $user) {
            if (User::find($user)->status_id != 1 || User::find($user)->status_id != 2) {
                Note::create([
                    'name' => 'Создана задача  №' . $task->id,
                    'user_id' => $user,
                    'type_id' => Type::where('title', 'задача')->first()->id,
                    'open' => 1,
                    'created_at' => now(),
                ]);
            }
        }

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
        // $works = Work::orderBy('step', 'asc')->get();
        // $orders = Order::select('id')->orderBy('id', 'desc')->get();
        $user = User::find($task->user_id);
        return view('admin.tasks.show', compact('task', 'user'));
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
        $users = User::all();
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
        // dd($request->all());
        if(isset($request->name) && isset($request->status)&& isset($request->description)
            && isset($request->order) && isset($request->step)
            && isset($request->open)){
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

            $data['work_id'] = $request->status;
            $data['order_id'] = $request->order;
            $data['created_at'] = Carbon::createFromFormat('m/d/Y', $request->date1)->format('d-m-Y');
            $data['updated_at'] = Carbon::createFromFormat('m/d/Y', $request->date2)->format('d-m-Y');

            $task->update($data);
            $task->user()->sync($request->users);
        } else {
            $request->validate([
                'status' => 'required|integer',
            ]);
            // $task = Task::find($id);
            Task::where('id',$id)->update([
                'work_id' => $request->status,
            ]);
        }

        if($request->open == 2){
            $users = User::where('status_id', 1)->orWhere('status_id', 2)->get();
            foreach ($users as $user) {
                Note::create([
                    'name' => 'Задача №' . $id . ' переведена в закрытые',
                    'user_id' => $user->id,
                    'type_id' => Type::where('title', 'задача')->first()->id,
                    'open' => 1,
                    'created_at' => now(),
                ]);
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Изменения сохранены');
    }

    public function showClose(){
        $tasks = Task::where('open', '=', 2)->where('user_id', '=', Auth::user()->id)->paginate(15);
        return view('admin.tasks.showClose', compact('tasks'));
    }

    public function rules(){
        return view('admin.tasks.rules');
    }

    public function updateToClose($id)
    {
        Task::where('id',$id)->update([
            'open' => 2,
        ]);
        $tasks = Task::where('open', '=', 2)->where('user_id', '=', Auth::user()->id)->paginate(15);

        $users = User::where('status_id', 1)->orWhere('status_id', 2)->get();
        foreach ($users as $user) {
            Note::create([
                'name' => 'Задача №' . $id . ' переведена в закрытые',
                'user_id' => $user->id,
                'type_id' => Type::where('title', 'задача')->first()->id,
                'open' => 1,
                'created_at' => now(),
            ]);
        }

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
        $tasks->user()->sync([]);
        $tasks->delete();

        $users = User::where('status_id', 1)->orWhere('status_id', 2)->get();
        foreach ($users as $user) {
            Note::create([
                'name' => 'Задача №' . $id . ' удалена',
                'user_id' => $user->id,
                'type_id' => Type::where('title', 'задача')->first()->id,
                'open' => 1,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('tasks.closetasks')->with('error', 'Задача удалена');
    }
}
