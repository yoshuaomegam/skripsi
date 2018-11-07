@extends('adminlte::page')

@section('title', 'Data Desa')

@section('content_header')

@stop
@section('content')

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
          <div class="box box-info">
                  <div class="box-header with-border"><h3 class="box-title" style="margin-left: 15px;margin-bottom: 5px;" >Master Desa</h3>
                      <td><a href="/tambahdesa" class="btn btn-xs btn-success fa fa-plus"  title="tambah" data-toggle="modal" style="position:absolute;right:20px;"></a></td>
                      <td><a href="#excelmodal" class="btn btn-xs btn-success fa fa-file-excel-o"  title="import" data-toggle="modal" data-target="#excelmodal" style="position:absolute;right:60px;"></a></td>
                    </div>
                        <div class="box-body">
                            <div class="container" style="width: auto;">
                                <div class="form-group">
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
                                                @foreach ($data as $index =>$desa)
                                                <?php $no=1;?>
                                                    <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>{{$desa->nama}}</td>
                                                      <td>{{$desa->daftar_kecamatan->nama}}</td>
                                                      <td>@if(!$desa->logo)
                                                    tidak ada     
                                                    
                                                    @else
                                                          <img src="uploads/logo/{{$desa->logo}}" style="width:50px;height:50px;" /></td>                                                         
                                                        
                                                    @endif
                                                          <td>
                                                          {{$desa->nama_kades}}</td>
                                                      <td>
                                                            @if(!$desa->logo)
                                                            tidak ada     
                                                            
                                                            @else  
                                                        <img src="uploads/foto_kades/{{$desa->foto_kades}}" style="width:50px;height:50px;" />
                                                    @endif</td> 
                                                      <td>{{$desa->daftar_operator->name}}</td>   
                                                      <td>
                                                            {!! Form::model($desa,['route'=>['desa.delete', $desa->id,],'method'=>'DELETE', 'id'=>'form']) !!}
                                                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                                                            {!! Form::close() !!}
                                                          </td>  
                                                    @endforeach                                        </td>
                                                    
                                                  </tr>

                                  </tbody>
                                          <tfoot>
                                      
                                          </tfoot>
                                          </table>
                                      </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      </div>
                            </form>
                      </div>
                    </div>
                  </div>
                </div>             
@stop


@section('css')
@stop

@section('js')
<script>$(document).ready(function(){
        $('#desa').dataTable( {
            "columnDefs": [
                { "orderable": false, 
                "targets": [7],
             }
              ]
          } ); 
          $('[data-toggle="hapus"]').tooltip(); 
          $('[data-toggle="tambah"]').tooltip();  
});</script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
@include('sweet::alert')

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
@stop