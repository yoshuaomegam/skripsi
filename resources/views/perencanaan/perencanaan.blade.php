@extends('adminlte::page')

@section('title', 'Perencanaan')

@section('content_header')
@stop

@section('content')

<div class="box">
        <div class="box-header with-border">
                <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
          <h3 class="box-title">Perencanaan tahun {{$data->tahun_perencanaan}}</h3>
          <td><a href="/admin/menupelaporan/{{$data->id}}/perencanaan/tambahperencanaan" class="btn btn-xs btn-success fa fa-plus"  title="tambah" style="position:absolute;right:20px;"></a></td>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="desa"  class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="10">No</th>
                <th>Nama desa</th>
                <th>Kecamatan</th>
                <th>Logo desa</th>
                <th>Nama kepala desa</th>
                <th>Foto kepala desa</th>
                <th>Nama Operator</th>
                <th width="20"></th>
            </tr>
        </thead>
        <tbody>

                  <tr>
                  <td></td>
                  <td></td>
                    <td></td>
                    <td>
                        <td>
                       </td>
                    <td>
                         </td> 
                    <td></td>   
                    <td>
                          {{--  {!! Form::model($desa,['route'=>['desa.delete', $desa->id,],'method'=>'DELETE', 'id'=>'form']) !!}
                          {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                          {!! Form::close() !!}  --}}
                        </td>  
                                                 </td>
                  
                </tr>

</tbody>
        <tfoot>
    
        </tfoot>
        </table>
        </div><!-- /.box-header -->
      </div><!-- /.box -->

@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop