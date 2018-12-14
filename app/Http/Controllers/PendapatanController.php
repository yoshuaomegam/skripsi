<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\PelaporanModel;
use App\PendapatanModel;
use App\DetailPendapatanModel;
use App\DesaModel;
use Alert;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dropdown=["Pendapatan asli desa","Hasil usaha","Hasil aset","Swadaya partisipasi dan gotong royong","Lain-lain pendapatan asli desa","Transfer","Dana desa","Bagian dari pajak/retribusi daerah","Alokasi dana desa","Bantuan Keuangan dari APBD Provinsi","Bantuan Keuangan APBD Kabupaten","Pendapatan lain-lain","Hibah/sumbangan pihak ketiga"];
        $data=PelaporanModel::find($id);
        return view('pendapatan/tambahpendapatan',compact('data','dropdown'));
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
        $nama=PendapatanModel::select('nama')->where('id_pelaporan','=',$id)->get()->pluck('nama')->toArray();
        
    if(in_array($request->nama, $nama)){
            alert()->error('Tidak bisa memasukkan nama pendapatan yang sama', 'Error');
            return Redirect::back()->withInput()->withErrors(['Tidak bisa memasukkan nama pendapatan yang sama']);
        }
        $total=str_replace(".", "", $request->pendapatan);
        $data=new PendapatanModel;
        $data->id_pelaporan=$id;
        $data->nama=$request->nama;
        $data->pendapatan=$total;
        dd($request->all());
        $data->save();
        if($request->hasFile('file')){
            
        foreach ($request->file('file') as $i=> $file) {
            $data2=new DetailPendapatanModel;
            $data2->id_pendapatan=$data->id;
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/pendapatan');
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


    public function store2(Request $request, $id, $id_pendapatan)
    {
        $this->validate($request, [
            'file' => 'max:2048'
        ]);
            if($request->hasFile('file')){
            foreach ($request->file('file') as $i=>$file) {
            $data2=new DetailPendapatanModel;
            $data2->id_pendapatan=$id_pendapatan;
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/pendapatan');
            $imagePath = $destinationPath. "/".  $name;
            $file->move($destinationPath, $name);
            $data2->file = $name;
            $data2->deskripsi = $request->deskripsi[$i];
            $data2->save();
            Alert::success('File berhasil ditambahkan', 'Sukses');
            return redirect()->back();
            }
               
        }
          
    Alert::success('File berhasil ditambahkan', 'Sukses');
    return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id_pendapatan)
    {
        $data=PendapatanModel::where('id','=',$id_pendapatan)->first();
        $data2=DetailPendapatanModel::where('id_pendapatan','=',$id_pendapatan)->get();
        return view('pendapatan/showpendapatan', compact('data','data2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_pendapatan)
    {
        $data=PendapatanModel::where('id','=',$id_pendapatan)->first();
        $data2=DetailPendapatanModel::where('id_pendapatan','=',$id_pendapatan)->get();
        $dropdown=["Pendapatan asli desa","Hasil usaha","Hasil aset","Swadaya partisipasi dan gotong royong","Lain-lain pendapatan asli desa","Transfer","Dana desa","Bagian dari pajak/retribusi daerah","Alokasi dana desa","Bantuan Keuangan dari APBD Provinsi","Bantuan Keuangan APBD Kabupaten","Pendapatan lain-lain","Hibah/sumbangan pihak ketiga"];
        return view('pendapatan/editpendapatan', compact('data','data2','dropdown'));
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
    public function update2(Request $request)
    {
        dd($id_detail);
        $data2=DetailPendapatanModel::find($id_detail);
        $data2=$request->deskripsi;
        Alert::success('Deskripsi berhasil diganti', 'Sukses');
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
    public function destroy2($id,$id_pendapatan,$id_detail)
    {
        dd($id);
    }

}
