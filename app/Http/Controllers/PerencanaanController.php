<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DesaModel;
use Illuminate\Support\Facades\Auth;
use App\PelaporanModel;
use App\PerencanaanModel;
use App\DetailPerencanaanModel;
use Alert;
class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $total=0;
        $data=PelaporanModel::find($id);
        $adadata=PerencanaanModel::where('id_pelaporan','=',$id)->first();
        if(!$adadata){
            return view('perencanaan/tambahperencanaan',compact('data'));
        }
        else{
        $data2=DetailPerencanaanModel::where('id_perencanaan','=',$adadata->id)->get();
        foreach($data2 as $index => $dana){
            $total += $dana->perencanaan;
        }
        return view('perencanaan/perencanaan',compact('data','adadata','data2','total'));
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

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
          $data2->save();
        }
        Alert::success('Data berhasil ditambahkan', 'Sukses');
        return redirect()->back();
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
    //    $data=PerencanaanModel::find($id);
    //    $data2=DetailPerencanaanModel::where('id_perencanaan','=',$id)->first();
    //    return view('perencanaan/editperencanaan',compact('data','data2'));
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
        $data= PerencanaanModel::find($id);
        $total=str_replace(".", "", $request->total_penerimaan);
        $data->total_penerimaan=$total;
        $data->sumber=$request->sumber;
        $data->save();
        return redirect()->back();
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
