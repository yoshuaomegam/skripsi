{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Tambah Pelaporan')

@section('content_header')
@stop

@section('content')
<div class="box box-info">
        <div class="box-header with-border"><h3 class="box-title" style="margin-left: 15px;margin-bottom: 5px;" >APBDesa Tahun {{$data->tahun_apbd}}</h3>
            
          </div>
              <div class="box-body">
                  <div class="container" style="width: auto;">
                      <div class="form-group">
                          <h3>Nama Belanja : {{$data->nama}}</h3>
                          <h3>Belanja : {{$data->belanja}} </h3>
                          <h3>Belanja : {{$data->tipe}} </h3>
                          <hr>
                            <h3>Lampiran</h3>
                            <table id="pelaporan"  class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th width="10">No</th>
                                        <th>File</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                              @foreach ($data2 as $index =>$detail)
                              <?php $no=1;?>
                              <tr>
                          <td>{{$index+1}}</td>
                          <td>{{$detail->file}}</td>
                          <td>
                            @if(!$detail->deskripsi)
                            tidak ada
                            @else  
                            {{$detail->deskripsi}}
                        @endif</td>
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
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
$(document).ready(function(){
    $('#belanja').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>
<script>
$(document).ready(function(){
    $('#total_penerimaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>
@stop

