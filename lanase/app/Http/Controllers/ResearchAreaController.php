<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Research_Area;
use Laracasts\Flash\Flash;

class ResearchAreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Research_Area::all();
        return view('panel.researcharea.index')->with('areas', $areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panel.researcharea.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $area = new Research_Area($request->all());
        //cambiar nombre de la imagen
        unset($area->image);
        if($request->file('image')){
            $image=$request->file('image');
            $image_name=$request->title_es.time().'.'.$image->getClientOriginalExtension();
            $path=public_path()."/images/researcharea/";
            $request->image=$image_name;
            $area->image=$image_name;
        }
        if($area->save()){
            if($request->file('image')){
                $image->move($path, $image_name);
            }
            Flash::overlay('Se ha registrado '.$area->title_es.' de forma exitosa.', 'Alta exitosa');
        }else{
            Flash::overlay('Ha ocurrido un error al registrar '.$area->title_es, 'Error');
        }

        return redirect()->route('researcharea.create');
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
