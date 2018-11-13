<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DesaModel;
use Illuminate\Support\Facades\Auth;
use App\PelaporanModel;
use App\PerencanaanModel;
use App\DetailPerencanaanModel;
class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data=PelaporanModel::find($id);
        return view('perencanaan/perencanaan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data=PelaporanModel::find($id);
        return view('perencanaan/tambahperencanaan',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $data= new PerencanaanModel;
        $total=str_replace(".", "", $request->total_penerimaan);
        $data->id_pelaporan=$id;
        $data->total_penerimaan=$total;
        $data->sumber=$request->sumber;
        $data->save();
        for ($i=0; $i < count($request->nama); $i++) { 
          $data2=new DetailPerencanaanModel;
          $dana[]=str_replace(".", "", $request->perencanaan[$i]);
          $data2->id_perencanaan=$data->id;
          $data2->nama=$request->nama[$i];
          $data2->perencanaan=$dana[$i];
          $data2->tipe=$request->tipe[$i];
          $data2->mulai=$request->mulai[$i];
          $data2->estimasiselesai=$request->estimasiselesai[$i];
          $data2->save();
          redirect('/admin/menupelaporan/$id/perencanaan');
        }
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
