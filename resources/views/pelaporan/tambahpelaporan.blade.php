{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Tambah Pelaporan')

@section('content_header')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
            <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
      <h3 class="box-title">Form Data Pelaporan</h3>
      <div class="box-tools pull-right">
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
                      {!! Form::open(array('route'=>'admin.pelaporan.store','data-parsley-validate'=>'')) !!}
                      <span class="help-block">
                      @if($errors->any())
                      <strong style="color:red;" class="warning">{{$errors->first()}}</strong>
                      @endif                   
                      </span>   
                      {{ Form::label('title','Tahun APBDesa') }}
                      {{Form::selectRange('tahun_apbd', 2015, 2140, old('tahun_apbd') ,['class' => 'form-control'])}}
<br>
                      <label for="">Note : Tahun Perencanaan dan Monitoring lebih 1 tahun dari tahun APBDesa</label>
                      <br>
                      <br>
                      {{ Form::submit('Tambah',  array('class'=>'form-control btn btn-success'))}}
                      {!! Form::close() !!}
    </div><!-- /.box-body -->
  </div><!-- /.box -->

            
@stop

@section('css')
@stop

@section('js')


@stop

