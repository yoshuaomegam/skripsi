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
                  <div class="box-header with-border"><h3 class="box-title" style="margin-left: 15px;margin-bottom: 5px;" >APBDesa Tahun {{$data->tahun_apbd}}</h3>
                      <td><a href="/admin/menupelaporan/{{$data->id}}/apbdesa/pendapatan" class="btn btn-xs btn-success fa fa-plus"  title="tambah" style="position:absolute;right:20px;"></a></td>
                    </div>
                        <div class="box-body">
                            <div class="container" style="width: auto;">
                                <div class="form-group">
                                    <h3>Total Pendapatan : Rp. {{number_format($total,0,",",".")}}</h3>
                                      <table id="pelaporan"  class="table table-striped table-bordered" style="width:100%">
                                              <thead>
                                              <tr>
                                                  <th width="10">No</th>
                                                  <th>Nama Pendapatan</th>
                                                  <th>Pendapatan</th>
                                                  <th width="20"></th>
                                                    <th width="20"></th>
                                                  <th width="20"></th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                        @foreach ($data2 as $index =>$pendapatan)
                                        <?php $no=1;?>
                                        <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$pendapatan->nama}}</td>
                                    <td>Rp. {{number_format($pendapatan->pendapatan,0,",",".")}}</td>
                                    <td><a href="/admin/menupelaporan/{{$data->id}}/apbdesa/showpendapatan/{{$pendapatan->id}}" class="btn btn-xs btn-success fa fa-info"  title="detail" ></td>
                                    <td><a href="/admin/menupelaporan/{{$data->id}}/apbdesa/editpendapatan/{{$pendapatan->id}}" class="btn btn-xs btn-success fa fa-edit"  title="edit" ></td>
                                    <td></td>
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
    

@stop


@section('css')
@stop

@section('js')


<script>$(document).ready(function(){
    $('#pelaporan').dataTable( {
        "columnDefs": [
            { "orderable": false, 
            "targets": [4,5],
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