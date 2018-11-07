{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
            <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
      <h3 class="box-title">Form Data Desa</h3>
      <div class="box-tools pull-right">
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <form action="{{ route('desa.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                    <label for="nama">Nama Desa/Kelurahan :</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>   
                <div class="form-group">
                        <label for="nama">Kecamatan :</label>
                        <select name="kecamatan" id="kecamatan" class="form-control">
                                @foreach ($select as $key=>$dropdown)
                                <option value="{{ $key }}" {{ (Input::old("kecamatan") == $key ? "selected":"") }}>{{ $dropdown }}</option>
                            @endforeach
                        </select>
                        
                    </div>  
                    <div class="form-group">
                            <label for="nama">Nama Kades :</label>
                            <input type="text" class="form-control" id="nama_kades" name="nama_kades" value="{{ old('nama_kades') }}">
                        </div>   
                        <div class="form-group">
                                <label for="foto">Foto Kades :</label>
                                <input type="file"  class="form-control" id="foto_kades"  name="foto_kades" value="{{ old('foto_kades') }}" >
                            </div>      
                        <div class="form-group">
                                <label for="logo">Logo :</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>   
                            <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="logo">Username Operator :</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                           placeholder="">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="logo">Email :</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="">
                                   
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="logo">Password :</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="" id="password">
                                           <br>
                                        <input type="checkbox" onclick="lihatpassword()"> munculkan password
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label for="logo">Konfirmasi Password :</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="" id="password2">
                                           <br>
                                           <input type="checkbox" onclick="lihatpassword2()"> munculkan password
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                   <input type="submit" class="form-control btn btn-success" value="Tambah Data">
                                </div>   

    </div><!-- /.box-body -->
  </div><!-- /.box -->

            
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        function lihatpassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
            function lihatpassword2() {
                var x = document.getElementById("password2");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
@stop