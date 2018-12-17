<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PembiayaanModel;
use App\DetailPembiayaanModel;
use App\PelaporanModel;
use Alert;
use Redirect;
class PembiayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dropdown=["Sisa lebih perhitungan anggaran (SILPA) tahun sebelumnya","Pencairan dana cadangan","Hasil penjualan kekayaan desa yang dipisahkan","Pembentukan dana cadangan","Penyertaan modal desa"];
        $data=PelaporanModel::find($id);
        return view('pembiayaan/tambahpembiayaan',compact('data','dropdown'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this->validate($request, [
            'file' => 'max:2048'
        ]);
        $nama=PembiayaanModel::select('nama')->where('id_pelaporan','=',$id)->get()->pluck('nama')->toArray();  
        if(in_array($request->nama, $nama)){
            alert()->error('Tidak bisa memasukkan nama pembiayaan yang sama', 'Error');
            return Redirect::back()->withInput()->withErrors(['Tidak bisa memasukkan nama pembiayaan yang sama']);
        }
        $total=str_replace(".", "", $request->pembiayaan);
        $data=new PembiayaanModel;
        $data->id_pelaporan=$id;
        $data->nama=$request->nama;
        $data->pembiayaan=$total;
        $data->save();
        if($request->hasFile('file')){
            foreach ($request->file('file') as $i=> $file) {
                $data2=new DetailPembiayaanModel;
                $data2->id_pembiayaan=$data->id;
                $name = $file->getClientOriginalName();
                $destinationPath = public_path('/uploads/pembiayaan');
                $imagePath = $destinationPath. "/".  $name;
                $file->move($destinationPath, $name);
                $data2->file = $name;
                $data2->deskripsi = $request->deskripsi[$i];
                $data2->save();
            }
    }
        Alert::success('Data berhasil ditambahkan', 'Sukses');
        return redirect()->route('admin.apbdesa',$id);
        
    }
    
    public function store2(Request $request, $id, $id_pembiayaan)
    {
        $this->validate($request, [
            'file' => 'max:2048'
        ]);
            if($request->hasFile('file')){
            foreach ($request->file('file') as $i=>$file) {
            $data2=new DetailPembiayaanModel;
            $data2->id_pembiayaan=$id_pembiayaan;
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/pembiayaan');
            $imagePath = $destinationPath. "/".  $name;
            $file->move($destinationPath, $name);
            $data2->file = $name;
            $data2->deskripsi = $request->deskripsi[$i];
            $data2->save();
            Alert::success('File berhasil ditambahkan', 'Sukses');
            return redirect()->back();
            }
               
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id_pembiayaan)
    {
        $data=PembiayaanModel::where('id','=',$id_pembiayaan)->first();
        $data2=DetailPembiayaanModel::where('id_pembiayaan','=',$id_pembiayaan)->get();
       
        return view('pembiayaan/showpembiayaan', compact('data','data2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$id_pembiayaan)
    {
        $data=PembiayaanModel::where('id','=',$id_pembiayaan)->first();
        $data2=DetailPembiayaanModel::where('id_pembiayaan','=',$id_pembiayaan)->get();
        $dropdown=["Sisa lebih perhitungan anggaran (SILPA) tahun sebelumnya","Pencairan dana cadangan","Hasil penjualan kekayaan desa yang dipisahkan","Pembentukan dana cadangan","Penyertaan modal desa"];
        return view('pembiayaan/editpembiayaan', compact('data','data2','dropdown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$id_pembiayaan)
    {
     // dd($request->nama);
     $nama=PembiayaanModel::select('nama')->where('id_pelaporan','=',$id)->get()->pluck('nama')->toArray();
     $namasebelumnya=PembiayaanModel::select('nama')->where('id_pelaporan','=',$id)->where('id','=', $id_pembiayaan)->value('nama');
     if(in_array($request->nama, $nama) && ($request->nama!=$namasebelumnya)){
         alert()->error('Tidak bisa memasukkan nama pembiayaan yang sudah ada', 'Error');
         return Redirect::back()->withInput()->withErrors(['Tidak bisa memasukkan nama pembiayaan yang sudah ada']);
     }
     $total=str_replace(".", "", $request->pembiayaan);
     $data=PembiayaanModel::find($id_pembiayaan);
     $data->nama=$request->nama;
     $data->pembiayaan=$total;
     $data->save();
     Alert::success('Deskripsi berhasil diganti', 'Sukses');
     return redirect()->route('admin.apbdesa',$id);
    }

    public function update2(Request $request,$id,$id_pembiayaan,$id_detail)
    {
        $data2=DetailPembiayaanModel::find($id_detail);
        $data2->deskripsi=$request->deskripsi;
        $data2->save();
        Alert::success('Deskripsi berhasil diganti', 'Sukses');
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$id_pembiayaan)
    {
        $data=PembiayaanModel::find($id_pembiayaan);
        $data->delete();
        Alert::success('Detail Pembiayaan sudah Dihapus', 'Sukses');
        return redirect()->back();
    }
    public function destroy2($id,$id_pembiayaan,$id_detail)
    {
        $data2=DetailPembiayaanModel::find($id_detail);
        $data2->delete();
        Alert::success('Detail Pembiayaan sudah Dihapus', 'Sukses');
        return redirect()->back();
    }
}
