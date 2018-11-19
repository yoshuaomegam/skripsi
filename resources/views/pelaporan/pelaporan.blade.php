@extends('adminlte::page')

@section('title', 'Pelaporan')

@section('content_header')

@stop

@section('content')
<div class="row">

    
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
          <div class="box box-info">
                  <div class="box-header with-border"><h3 class="box-title" style="margin-left: 15px;margin-bottom: 5px;" >Data Pelaporan</h3>
                      <td><a href="/admin/tambahpelaporan" class="btn btn-xs btn-success fa fa-plus"  title="tambah" style="position:absolute;right:20px;"></a></td>
                    </div>
                        <div class="box-body">
                            <div class="container" style="width: auto;">
                                <div class="form-group">
                                      <table id="pelaporan"  class="table table-striped table-bordered" style="width:100%">
                                              <thead>
                                              <tr>
                                                  <th width="10">No</th>
                                                  <th>Nama desa</th>
                                                  <th>Nama Pelaporan</th>
                                                  <th width="20"></th>
                                              </tr>
                                          </thead>
                                          @foreach ($data as $index =>$pelaporan)
                                                <?php $no=1;?>
                                                    <tr>
                                                    <td>{{$index+1}}</td>
                                                      <td>{{$pelaporan->daftar_desa->nama}}</td>          
                                                      <td><a href="/admin/menupelaporan/{{$pelaporan->id}}"> APBDesa tahun {{$pelaporan->tahun_apbd}} dan Perencanaan/Monitoring Tahun {{$pelaporan->tahun_perencanaan}}</a></td>            
                                                      <td><a href="/admin/editpelaporan/{{$pelaporan->id}}" class="btn btn-xs btn-success" title="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></td>                                         
                                                      <td>
                                                        {!! Form::model($pelaporan,['route'=>['admin.pelaporan.delete', $pelaporan->id,],'method'=>'DELETE']) !!}
                                                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                                                        {!! Form::close() !!}
                                                      </td>  
                                                    </tr>
                                            @endforeach
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
    $('#pelaporan').dataTable( {
        "columnDefs": [
            { "orderable": false, 
            "targets": [3],
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

      <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  <!-- Include this after the sweet alert js file -->
@include('sweet::alert')
@stop