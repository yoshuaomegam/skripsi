@extends('adminlte::page')

@section('title', 'Edit Pelaporan')

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
                {!! Form::model($data,['route'=>['admin.pelaporan.update', $data->id],'method'=>'POST']) !!}
                <span class="help-block">
                        @if($errors->any())
                        <strong style="color:red;" class="warning">{{$errors->first()}}</strong>
                        @endif                   
                        </span>   
                        {{ Form::label('title','Tahun APBDesa') }}
                        {{Form::selectRange('tahun_apbd', 2015, 2140, null ,['class' => 'form-control'])}}
                <br>
                
                
                {{ Form::submit('Update',  array('class'=>'btn btn-warning btn-lg btn-block'))}}
                {!! Form::close() !!}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    


@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop