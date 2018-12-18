<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BelanjaModel;
use App\DetailBelanjaModel;
use App\PelaporanModel;
use Alert;
use Redirect;
use Illuminate\Support\Facades\Route;
class BelanjaController extends Controller
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
        $dropdown=["Penyelenggaraan Pemerintahan Desa","Pelaksanaan Pembangunan Desa","Pembinaan Kemasyarakatan Desa","Pemberdayaan Masyarakat Desa","Belanja Tak Terduga"];
        $data=PelaporanModel::find($id);
        return view('belanja/tambahbelanja',compact('data','dropdown'));
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
        $nama=BelanjaModel::select('nama')->where('id_pelaporan','=',$id)->get()->pluck('nama')->toArray();  
        if(in_array($request->nama, $nama)){
            alert()->error('Tidak bisa memasukkan nama belanja yang sama', 'Error');
            return Redirect::back()->withInput()->withErrors(['Tidak bisa memasukkan nama belanja yang sama']);
        }
        $total=str_replace(".", "", $request->belanja);
        $data=new BelanjaModel;
        $data->id_pelaporan=$id;
        $data->nama=$request->nama;
        $data->belanja=$total;
        $data->tipe=$request->tipe;
        $data->save();
        if($request->hasFile('file')){
            
        foreach ($request->file('file') as $i=> $file) {
            $data2=new DetailBelanjaModel;
            $data2->id_belanja=$data->id;
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/belanja');
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
    public function store2(Request $request, $id, $id_belanja)
    {
        $this->validate($request, [
            'file' => 'max:2048'
        ]);
            if($request->hasFile('file')){
            foreach ($request->file('file') as $i=>$file) {
            $data2=new DetailBelanjaModel;
            $data2->id_belanja=$id_belanja;
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/uploads/belanja');
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
    public function show($id,$id_belanja)
    {
        $data=BelanjaModel::where('id','=',$id_belanja)->first();
        $data2=DetailBelanjaModel::where('id_belanja','=',$id_belanja)->get();
        return view('belanja/showbelanja', compact('data','data2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_belanja)
    {
        
        $data=BelanjaModel::where('id','=',$id_belanja)->first();
        $data2=DetailBelanjaModel::where('id_belanja','=',$id_belanja)->get();
        $dropdown=["Penyelenggaraan Pemerintahan Desa","Pelaksanaan Pembangunan Desa","Pembinaan Kemasyarakatan Desa","Pemberdayaan Masyarakat Desa","Belanja Tak Terduga"];
        return view('belanja/editbelanja', compact('data','data2','dropdown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$id_belanja)
    {
        // dd($request->nama);
        $nama=BelanjaModel::select('nama')->where('id_pelaporan','=',$id)->get()->pluck('nama')->toArray();
        $namasebelumnya=BelanjaModel::select('nama')->where('id_pelaporan','=',$id)->where('id','=', $id_belanja)->value('nama');
        if(in_array($request->nama, $nama) && ($request->nama!=$namasebelumnya)){
            alert()->error('Tidak bisa memasukkan nama belanja yang sudah ada', 'Error');
            return Redirect::back()->withInput()->withErrors(['Tidak bisa memasukkan nama belanja yang sudah ada']);
        }
        $total=str_replace(".", "", $request->belanja);
        $data=BelanjaModel::find($id_belanja);
        $data->nama=$request->nama;
        $data->belanja=$total;
        $data->save();
        Alert::success('Deskripsi berhasil diganti', 'Sukses');
        return redirect()->route('admin.apbdesa',$id);

    }
    public function update2(Request $request,$id,$id_belanja,$id_detail)
    {
        $data2=DetailBelanjaModel::find($id_detail);
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
    public function destroy($id,$id_belanja)
    {
        $data=BelanjaModel::find($id_belanja);
        $data->delete();
        Alert::success('Detail Belanja sudah Dihapus', 'Sukses');
        return redirect()->back();
    }
    public function destroy2($id,$id_belanja,$id_detail)
    {
        $data2=DetailBelanjaModel::find($id_detail);
        $data2->delete();
        Alert::success('Detail Belanja sudah Dihapus', 'Sukses');
        return redirect()->back();
    }
}
