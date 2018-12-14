<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\KecamatanModel;
use App\DesaModel;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\roleuserModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\PelaporanModel;
use App\PerencanaanModel;
use App\DetailPerencanaanModel;
class Driver extends Controller
{
    public function create()
    {
        $kecamatan=array();
        $select=[];
        foreach ($kecamatan as $id=>$dropdown) {
            $select[$id]=$dropdown;
        }
        return view('Desa/tambahdesa',compact('select'));
    }
        public function store()
    {

        $operator= new User;
        $operator->name="yos";
        $operator->email="yos@gmail.com";
        $operator->password=Hash::make("123456");
        $operator->save();
        $role=new roleuserModel;
        $role->role_id=1;
        $role->user_id=1;
        $role->user_type="App\User";
        $role->save();
        $desa= new DesaModel;
        $desa->nama="dumplengan";
        $desa->id_operator=1;
        $desa->id_kecamatan=1;
        $desa->nama_kades="guniran";
        if ($request->hasFile('logo')==false) {
            $logo = $request->file('logo');
            $name = str_slug($request->nama).'.'.$logo->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/logo');
            $imagePath = $destinationPath. "/".  $name;
            $logo->move($destinationPath, $name);
            $desa->logo = $name;
          }
          if ($request->hasFile('foto_kades')==false) {
            $kades = $request->file('foto_kades');
            $name = str_slug($request->nama_kades).'.'.$kades->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/foto_kades');
            $imagePath = $destinationPath. "/".  $name;
            $kades->move($destinationPath, $name);
            $desa->foto_kades = $name;
          }
        $desa->save();
          Alert::success('Data berhasil ditambahkan', 'Sukses');
            return redirect('desa');
    }
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
        // $data3=DetailPerencanaanModel::where('id_perencanaan','=',$adadata->id)->pluck('tipe');

        foreach($data2 as $index => $dana){
            $total += $dana->perencanaan;
        }
        return view('perencanaan/perencanaan',compact('data','adadata','data2','total','dropdown'));
    }
    
}
}
