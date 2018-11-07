<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PelaporanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;
use Redirect;
use App\DesaModel;
class PelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $id_desa=DesaModel::where('id_operator','=',$id)->value('id');
        $data=PelaporanModel::with('daftar_desa')->where('id_desa','=',$id_desa)->get();
        return view('pelaporan/pelaporan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelaporan/tambahpelaporan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_operator = Auth::id();
        $id_desa=DB::table('desa')->where('id_operator','=',$id_operator)->value('id');
        $tahun=DB::table('pelaporan')->select('tahun_apbd')->where('id_desa','=',$id_desa)->get()->pluck('tahun_apbd')->toArray();
        if(in_array($request->tahun_apbd, $tahun)){
            alert()->error('Tidak bisa memasukkan tahun yang sama', 'Error');
            return Redirect::back()->withErrors(['Tidak bisa memasukkan tahun yang sama', 'The Message']);
        }
        else{
            $data= new PelaporanModel;
            $data->tahun_apbd=$request->tahun_apbd;
            $data->tahun_perencanaan=$request->tahun_apbd+1;
            $data->id_desa=$id_desa;
            $data->save();
            Alert::success('Data berhasil ditambahkan', 'Sukses');
            return redirect('admin/pelaporan');
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
        $data= PelaporanModel::find($id);
        return view('pelaporan/menupelaporan', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= PelaporanModel::find($id);
        return view('pelaporan/editpelaporan', compact('data'));
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
        $id_operator = Auth::id();
        $id_desa=DB::table('desa')->where('id_operator','=',$id_operator)->value('id');
        $tahun=DB::table('pelaporan')->select('tahun_apbd')->where('id_desa','=',$id_desa)->get()->pluck('tahun_apbd')->toArray();
        if(in_array($request->tahun_apbd, $tahun)){
            alert()->error('Tidak bisa memasukkan tahun yang sama', 'Error');
            return Redirect::back()->withErrors(['Tidak bisa memasukkan tahun yang sama', 'The Message']);
        }
        else{
            $data= PelaporanModel::find($id);
            $data->tahun_apbd=$request->tahun_apbd;
            $data->tahun_perencanaan=$request->tahun_apbd+1;
            $data->id_desa=$id_desa;
            $data->save();
            Alert::success('Data berhasil diperbaharui', 'Sukses');
            return redirect('admin/pelaporan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= PelaporanModel::find($id);
        $data->delete();
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect('admin/pelaporan');
    }
}
