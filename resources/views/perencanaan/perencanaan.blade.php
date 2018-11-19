@extends('adminlte::page')

@section('title', 'Perencanaan')

@section('content_header')
@stop

@section('content')

<div class="box">
        <div class="box-header with-border">
                <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
          <h3 class="box-title">Perencanaan tahun {{$data->tahun_perencanaan}}</h3>
          <td><a href="#editmodal" class="btn btn-xs btn-success fa fa-edit"  title="edit" style="position:absolute;right:20px;" data-toggle="modal" data-target="#editmodal{{$adadata->id}}"></a></td>
          <div class="box-tools pull-right">
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <h5>Total Penerimaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. {{number_format($adadata->total_penerimaan,0,",",".")}}</h3>
          <h5>Sumber &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  {{$adadata->sumber}}</h3>
            <h5>Dana Perencanaan &nbsp;&nbsp;&nbsp; : Rp. {{number_format($total,0,",",".")}} </h5>
            <hr>
          <table id="desa"  class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="10">No</th>
                <th>Nama Perencanaan</th>
                <th>Dana</th>
                <th>Tipe</th>
                <th width="20"></th>
                <th width="20"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data2 as $index =>$perencanaan)
            <?php $no=1;?>
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$perencanaan->nama}}</td>
                    <td>Rp. {{number_format($perencanaan->perencanaan,0,",",".")}}</td>
                    <td>{{$perencanaan->tipe}}</td> 
                    <td></td>
                    <td>
                          {{--  {!! Form::model($desa,['route'=>['desa.delete', $desa->id,],'method'=>'DELETE', 'id'=>'form']) !!}
                          {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                          {!! Form::close() !!}  --}}
                        </td>  
                </tr>
                <tr>
                </tr>
                @endforeach
</tbody>
        </table>
        <br>

        </div><!-- /.box-header -->

      </div><!-- /.box -->
      

      <div class="modal fade" id="editmodal{{$adadata->id}}" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title" id="editmodalLabel">Edit Data Perencanaan</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::model($adadata,['route'=>['admin.perencanaan.update', $adadata->id, $data->id],'method'=>'POST']) !!} 
              {{ Form::label('title','Penerimaan Dana') }}
                    <div>
                      <div class="input-group margin-bottom-sm">
                        <span class="input-group-addon">Rp.</span>
                        {!! Form::text('total_penerimaan', null, ['class'=>'form-control','id'=>'total_penerimaan']) !!}

                      </div>
                    </div>
                    <br>
                    {{ Form::label('title','Sumber') }}
                    {{ Form::text('sumber', NULL, array('class'=>'form-control','maxlength'=>'225'))}}
                    <br>
            </div>
            <div class="modal-footer">
                    {{ Form::submit('Tutup',  array('class'=>'btn btn-secondary', 'data-dismiss'=>'modal' ))}}
              {{ Form::submit('Edit',  array('class'=>'btn btn-success'))}}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>    

@stop

@section('css')

@stop

@section('js')

    <script> console.log('Hi!'); </script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script>
    $(document).ready(function(){
      $('#total_penerimaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
  })
</script>
    <!-- Include this after the sweet alert js file -->
  @include('sweet::alert')
@stop