<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KecamatanModel;
use Alert;
use Excel;
use File;
class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data=KecamatanModel::all();
       return view('kecamatan/kecamatan', compact('data'));
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
            $data= new KecamatanModel;
            $data->nama=$request->nama;
            $data->camat=$request->camat;
            $data->save();
            Alert::success('Data berhasil ditambahkan', 'Sukses');
            return redirect('kecamatan');
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
        $this->validate($request, array(
            'nama'=>'required|max:225'));
            $data= KecamatanModel::find($id);
            $data->nama=$request->nama;
            $data->camat=$request->camat;
            $data->save();
            Alert::success('Data berhasil diperbaharui', 'Sukses');
            return redirect('kecamatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= KecamatanModel::find($id);
        $data->delete();
        Alert::success('Data Berhasil dihapus', 'Sukses');
        return redirect('kecamatan');
    }
    public function import(Request $request){
        $kecamatan = KecamatanModel::pluck('nama')->toArray();

        if($request->hasFile('filekecamatan')){
            $path = $request->file('filekecamatan')->getRealPath();
            $data = Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    if (in_array($value->nama, $kecamatan))
                    continue;
                    $insert[] = [
                                'nama' => $value->nama,
                                'camat' => $value->camat
                            ];
                            $kecamatan[] = $value->nama;
                   
                }
 
                if( ! empty($insert)){
                   KecamatanModel::insert($insert);
                   Alert::success('Data berhasil disimpan', 'Sukses');
                }

                ///
            }
        }

        return redirect('kecamatan');
    }
    }

