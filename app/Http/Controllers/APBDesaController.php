<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PelaporanModel;
use App\PendapatanModel;
use App\DetailPendapatanModel;
use App\DesaModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class APBDesaController extends Controller
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
        $id_operator = Auth::id();
        $id_desa=DesaModel::where('id_operator','=',$id_operator)->value('id');
        $id_pelaporan=PelaporanModel::where('id_desa','=',$id_desa)->value('id');
        $data2=PendapatanModel::with('daftar_lampiran')->where('id_pelaporan','=',$id)->get();
        
        $id_pendapatan=PendapatanModel::select('id')->where('id_pelaporan','=',$id_pelaporan)->get()->pluck('id')->toArray();
        foreach($data2 as $index => $dana){
            $total += $dana->pendapatan;
        }
        return view('apbdesa/apbdesa',compact('data','data2','total','data3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    }
}
