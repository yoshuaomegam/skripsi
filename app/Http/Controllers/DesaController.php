<?php

namespace App\Http\Controllers;
use Alert;
use Illuminate\Http\Request;
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
class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DesaModel::with('daftar_kecamatan','daftar_operator')->get();
        return view('Desa/desa',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan=KecamatanModel::all();
        $select=[];
        foreach ($kecamatan as $dropdown) {
            $select[$dropdown->id]=$dropdown->nama;
        }
        return view('Desa/tambahdesa',compact('select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function store(Request $request)
    {
        $message = [
            'name.unique' => 'Username sudah ada',
            'name.required' => 'Username harus diisi'
        ];
        $this->validate($request, array(
            'nama' => 'required|string|max:255|unique:desa',
            'name' => 'required|string|max:255|unique:users',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ),$message);

        $operator= new User;
        $operator->name=$request->name;
        $operator->email=$request->email;
        $operator->password=Hash::make($request->password);
        $operator->save();
        $role=new roleuserModel;
        $role->role_id=1;
        $role->user_id=$operator->id;
        $role->user_type="App\User";
        $role->save();
        $desa= new DesaModel;
        $desa->nama=$request->nama;
        $desa->id_operator=$operator->id;
        $desa->id_kecamatan=$request->kecamatan;
        $desa->nama_kades=$request->nama_kades;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $name = str_slug($request->nama).'.'.$logo->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/logo');
            $imagePath = $destinationPath. "/".  $name;
            $logo->move($destinationPath, $name);
            $desa->logo = $name;
          }
    
          if ($request->hasFile('foto_kades')) {
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
        $id_operator=DesaModel::where('id','=',$id)->value('id_operator');
        $data= DesaModel::find($id);
        $data->delete();
        $data2 = User::find($id_operator); 
        $data3 = roleuserModel::where('user_id','=',$id_operator)->delete();
        $data2->delete();


        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect('desa');
    }
}
