<?php

namespace App\Http\Controllers\Cats;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Requests\CatStoreRequest;
use App\Http\Requests\CatUpdateRequest;
use Yajra\DataTables\Facades\DataTables;

class CatsController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct(){

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $cats = Cat::get();
            return DataTables::of($cats)
                ->addIndexColumn()
                ->addColumn('column_name',function($cat){
                    return $cat->column_name;
                })
                ->addColumn('action',function($cat){
                    return view('cats._action', compact('cat'));
                })
                ->rawColumns(['column_name', 'action'])
                ->make(true);
        }
        return view('cats.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = false;
        return view('cats.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CatStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatStoreRequest $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $cat = Cat::create([
            'name' => $request->name,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('cats.index')->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        return view('cats.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CatUpdateRequest  $request
     * @param  \App\Models\Cat $cat
     * @return \Illuminate\Http\Response
     */
    public function update(CatUpdateRequest $request, Cat $cat)
    {
        $request->validate([
            'field_name' => 'required'
        ]);

        $cat->field_name = $request->field_name;

        $cat->updated_by = auth()->id();
        $cat->save();

        return redirect()->route('cats.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {
        $cat->delete();
        return redirect()->route('cats.index')->with('success', 'Successfully Deleted');
    }
}
