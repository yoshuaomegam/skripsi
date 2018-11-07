@extends('adminlte::page')

@section('title', 'Perencanaan')

@section('content_header')
@stop

@section('content')

<div class="box">
        <div class="box-header with-border">
                <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
          <h3 class="box-title">Perencanaan tahun {{$data->tahun_perencanaan}}</h3>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            
        </div><!-- /.box-header -->
      </div><!-- /.box -->

@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop