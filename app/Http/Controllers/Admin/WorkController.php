<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = [
            'bg-primary'=> 'Синий',
            'bg-secondary'=> 'Серый',
            'bg-success'=> 'Зеленый',
            'bg-danger'=> 'Красный',
            'bg-warning'=> 'Оранжевый',
            'bg-info' => 'Голубой',
            'bg-light' => 'Светлый',
            'bg-dark' => 'Черный',
        ];
        $works = Work::orderBy('step', 'desc')->paginate(15);
        return view('admin.works.index', compact('works', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->title);
        $request->validate([
            'title' => 'required',
            'color' => 'required',
        ]);

        $step = Work::all()->count() + 1;
        Work::create([
            'title' => $request->title,
            'step' => $step,
            'color' => $request->color,
        ]);

        session()->flash('success', 'Статус заказа создан');
        return redirect()->route('works.index');
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
        $colors = [
            'bg-primary' => 'Синий',
            'bg-secondary' => 'Серый',
            'bg-success' => 'Зеленый',
            'bg-danger' => 'Красный',
            'bg-warning' => 'Оранжевый',
            'bg-info' => 'Голубой',
            'bg-light' => 'Светлый',
            'bg-dark' => 'Черный',
        ];
        $works = Work::find($id);
        return view('admin.works.edit', compact('works', 'colors'));
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
            'title' => 'required',
            'color' => 'required',
        ]);

        $works = Work::find($id);
        $works->update($request->all());

        return redirect()->route('works.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $works = Work::find($id);

        if ($works->orders->count() == 0) {
            if ($works->step != Work::all()->count()) {
                for ($i = $works->step; $i < Work::all()->count(); $i++) {
                    Work::where('step', $i + 1)->update(['step' => $i]);
                }
            }
            $works->delete();
            return redirect()->route('works.index')->with('success', 'Статус удален');
        }
        return redirect()->route('orders.index')->with('error', 'Статус занят');
    }
}
