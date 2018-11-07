@extends('adminlte::page')

@section('title', 'Data Kecamatan')

@section('content_header')

@stop

@section('js')
<script>$(document).ready(function(){
        $('#kecamatan').dataTable( {
            "columnDefs": [
                { "orderable": false, 
                "targets": [3,4],
             }
              ]
          } );
          $('[data-toggle="edit"]').tooltip();   
          $('[data-toggle="hapus"]').tooltip(); 
          $('[data-toggle="tambah"]').tooltip();
          $('[data-toggle="import"]').tooltip();  
});</script>
<script>    
        $('.btn-danger').on('click', function(e) {
            var form = e.target.form;
            e.preventDefault();
            swal({
                title: "Apakah Anda yakin untuk menghapus data ini?",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                // buttons: true,
                buttons: ["Batal", "Hapus"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    this.form.submit();
                } else {
                    swal("Dibatalkan");
                } 
            });
            }); 
</script>
<script>    
    $('.btn-block').on('click', function(e) {
        var form = e.target.form;
        e.preventDefault();
        swal({
            title: "Apakah Anda yakin untuk menyimpan file ini?",
            // text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            // buttons: true,
            buttons: ["Batal", "Simpan"],
            dangerMode: true,
            
            
        })
        .then((willDelete) => {
            if (willDelete) {
  
                this.form.submit();
            } else {
                swal("Dibatalkan");
            } 
        });
        }); 
  </script>
  <script>    
      $('.btn-block').on('click', function(e) {
          var form = e.target.form;
          e.preventDefault();
          swal({
              title: "Apakah Anda yakin untuk menyimpan file ini?",
              // text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              // buttons: true,
              buttons: ["Batal", "Simpan"],
              dangerMode: true,
              
              
          })
          .then((willDelete) => {
              if (willDelete) {
    
                this.form.submit();
              } else {
                  swal("Dibatalkan");
              } 
          });
          }); 
    </script>
<script src="js/sweetalert.min.js"></script>
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')

@stop

@section('content')
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
                <div class="box box-info">
                        <div class="box-header with-border"><h3 class="box-title" style="margin-left: 15px;margin-bottom: 5px;" >Master Kecamatan</h3>
                            <td><a href="#tambahmodal" class="btn btn-xs btn-success fa fa-plus"  title="tambah" data-toggle="modal" data-target="#tambahmodal" style="position:absolute;right:20px;"></a></td>
                            <td><a href="#excelmodal" class="btn btn-xs btn-success fa fa-file-excel-o"  title="import" data-toggle="modal" data-target="#excelmodal" style="position:absolute;right:60px;"></a></td>
                          </div>
                              <div class="box-body">
                                  <div class="container" style="width: auto;">
                                      <div class="form-group">
                                            <table id="kecamatan"  class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th width="10">No</th>
                                                        <th>nama kecamatan</th>
                                                        <th>camat</th>
                                                        <th width="20"></th>
                                                        <th width="20"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        @foreach ($data as $index =>$kecamatan)
                                        <?php $no=1;?>
                                                        <tr>
                                                            <td>{{$index+1}}</td>
                                                            <td>{{$kecamatan->nama}}</td>
                                                            <td>{{$kecamatan->camat}}</td>
                                                            <td><a href="" class="btn btn-xs btn-success"   data-toggle="modal" data-target="#editmodal{{$kecamatan->id}}" title="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></td>                              
                                                            <!-- Modal Edit-->
                      <div class="modal fade" id="editmodal{{$kecamatan->id}}" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2 class="modal-title" id="editmodalLabel">Edit Data Kecamatan</h2>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              {!! Form::model($kecamatan,['route'=>['kecamatan.update', $kecamatan->id],'method'=>'POST']) !!}
                                    {{ Form::label('title','Nama Kecamatan') }}
                                    {{ Form::text('nama', NULL, array('class'=>'form-control','required'=>'','maxlength'=>'225'))}}
                                   <br>
                                    {{ Form::label('title','Nama Camat') }}
                                    {{ Form::text('camat', NULL, array('class'=>'form-control','maxlength'=>'225'))}}
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
                                                            <td>
                                                              {!! Form::model($kecamatan,['route'=>['kecamatan.delete', $kecamatan->id,],'method'=>'DELETE']) !!}
                                                              {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                                                              {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                        </tbody>
                                                <tfoot>
                                            
                                                </tfoot>
                                                </table>
                                                <!-- Button trigger modal -->
                      


                                            </div>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
    


                      <!-- Modal Tambah-->
                      <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="tambahmodalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2 class="modal-title" id="tambahmodalLabel">Tambah Data Kecamatan</h2>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                    {!! Form::open(array('route'=>'kecamatan.store','data-parsley-validate'=>'')) !!}
                                    {{ Form::label('title','Nama Kecamatan') }}
                                    {{ Form::text('nama', NULL, array('class'=>'form-control','required'=>'','maxlength'=>'225'))}}
                                   <br>
                                    {{ Form::label('title','Nama Camat') }}
                                    {{ Form::text('camat', NULL, array('class'=>'form-control'))}}
                                    <br>
                                 
                                 
                            </div>
                            <div class="modal-footer">
                                    {{ Form::submit('Tutup',  array('class'=>'btn btn-secondary', 'data-dismiss'=>'modal' ))}}
                              {{ Form::submit('Tambah',  array('class'=>'btn btn-success'))}}
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>             

                      
                      <!-- Modal Import-->
                      <div class="modal fade" id="excelmodal" tabindex="-1" role="dialog" aria-labelledby="excelmodalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2 class="modal-title" id="excelmodalLabel">Tambah Data Kecamatan Melalui Excel</h2>
                              <h6>Format Excel untuk baris pertama yaitu 'nama' dan baris kedua yaitu 'camat'</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ URL::to('importkecamatan') }}"   class="form-horizontal" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <input type="file" name="filekecamatan">
                                  <br>
                                  <button class="btn btn-success btn-lg btn-block">Import File</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>             
                      
@stop


@section('css')

@stop

