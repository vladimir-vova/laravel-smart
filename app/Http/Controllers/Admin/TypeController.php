<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Type::orderBy('id', 'desc')->paginate(15);
        return view('admin.type.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.create');
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
            'title' => 'required',
        ]);

        Type::create([
            'title' => $request->title,
        ]);

        session()->flash('success', 'Тип создан');
        return redirect()->route('types.index');
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
        $type = Type::find($id);
        return view('admin.type.edit', compact('type'));
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
        ]);

        $type = Type::find($id);
        $type->update($request->all());

        return redirect()->route('types.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        if($type->note->count() == 0){
            $type->delete();
            return redirect()->route('types.index')->with('success', 'Тип удален');
        } 
        return redirect()->route('types.index')->with('error', 'Тип занят');
    }

    public function add()
    {
        $type = [
            'заказ',
            'задача',
            'другие',
        ];
        foreach ($type as $item) {
            Type::create([
                'title' => $item,
            ]);
        }

        session()->flash('success', 'Типы добавлены');
        return redirect()->route('types.index');
    }
}
