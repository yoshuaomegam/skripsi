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
              <td><a href="#editmodal" class="btn btn-xs btn-success fa fa-edit" aria-hidden="true" title="edit" style="position:absolute;right:60px;" data-toggle="modal" data-target="#editmodal{{$adadata->id}}"></a></td>
              <td>
              {!! Form::model($adadata,['route'=>['admin.perencanaan.delete', $adadata->id,$data->id],'method'=>'DELETE', 'id'=>'form']) !!}
              {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus','style'=>'position:absolute;right:20px;')) !!}
              {!! Form::close() !!}
            </td>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          
          <h5>Total Penerimaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. {{number_format($adadata->total_penerimaan,0,",",".")}}</h3>
          <h5>Sumber &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  {{$adadata->sumber}}</h3>
            <h5>Dana Perencanaan &nbsp;&nbsp;&nbsp; : Rp. {{number_format($total,0,",",".")}} </h5>


            <hr>
            <a href="#tambahmodal" class="btn btn-success" title="edit" data-toggle="modal" data-target="#tambahmodal">Tambah Data Perencanaan</a>
            <br>
            <br>
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
            @foreach ($data2 as $index => $perencanaan)
            <?php $no=1;?>
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$perencanaan->nama}}</td>
                    <td>Rp. {{number_format($perencanaan->perencanaan,0,",",".")}}</td>
                    <td>@if(!$perencanaan->tipe)
                        Tidak Ada
                        @else
                        {{$perencanaan->tipe}}
                        @endif
                      </td> 
                      <td>
    <a href="#editperencanaan" class="btn btn-xs btn-success fa fa-edit" title="edit" data-toggle="modal" data-target="#editperencanaan{{$perencanaan->id}}"></a></td>
                      </td>
                          <td>
                                 {!! Form::model($perencanaan,['route'=>['admin.perencanaan.delete2', $perencanaan->id,$data->id],'method'=>'DELETE', 'id'=>'form']) !!}
                                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                                {!! Form::close() !!}
                          </td>  
                </tr>

                <div class="modal fade" id="editperencanaan{{$perencanaan->id}}" data-id="{{$perencanaan->id}}" tabindex="-1" role="dialog" aria-labelledby="editperencanaanLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h2 class="modal-title" id="editperencanaanLabel">Edit Data Perencanaan</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        {!! Form::model($perencanaan,['route'=>['admin.perencanaan.update2', $perencanaan->id, $data->id],'method'=>'POST']) !!} 
                        {{ Form::label('title','Nama Perencanaan') }}
                        {{ Form::hidden('id', NULL, array('class'=>'form-control','id'=>'id'))}}
                        {{ Form::text('nama', NULL, array('class'=>'form-control','maxlength'=>'225','required'=>'required'))}}
                        <br>
                        {{ Form::label('title','Penerimaan Dana') }}
                              <div>
                                <div class="input-group margin-bottom-sm">
                                  <span class="input-group-addon">Rp.</span>
                                  {!! Form::text('perencanaan', null, ['class'=>'form-control','id'=>'dana']) !!}
          
                                </div>
                              </div>
                              <br>
                              {{ Form::label('title','Tipe') }}
                              <select name="tipe" id="tipe" class="form-control tipe-list" value="">
                                <option value="{{$perencanaan->tipe}}"<?php if($perencanaan->id==$perencanaan->id) echo 'selected="selected"'; ?>><?php echo $perencanaan->tipe; ?></option>
                                <?php
                                $dropdown=array("Tidak ada","Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa","Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan","Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan","Pembangunan pemanfaatan dan pemeliharaan ekonomi");
                                $select[]=$perencanaan->tipe;
                                $arr=array_diff($dropdown, $select);
                                ?>
                                @foreach ($arr as $drop)
                                <option value="{{$drop}}">{{$drop}}</option>
                                @endforeach
                                
                              </select>
                      </div>
                      <div class="modal-footer">
                        {{ Form::submit('Tutup',  array('class'=>'btn btn-secondary', 'data-dismiss'=>'modal' ))}}
                        {{ Form::submit('Edit',  array('class'=>'btn btn-success'))}}
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>    
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
                        {!! Form::text('total_penerimaan', null, ['class'=>'form-control','id'=>'total_penerimaan','required'=>'required']) !!}
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

      <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="tambahmodalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="tambahmodalLabel">Tambah Macam-Macam Data Perencanaan</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  {!! Form::open(array('route'=>['admin.perencanaan.store2', $data->id],'data-parsley-validate'=>'')) !!}
                  {{ Form::hidden('id', $adadata->id, array('class'=>'form-control','id'=>'id'))}}
                  <div class="table-responsive">  
                    <table class="table table-bordered" id="dynamic_field">  
                        <tr>  
                            
                            <td><label>Nama Perencanaan</label>
                                <input type="text" name="nama[]"  class="form-control name_list" required></td>  
                            <td style="width:5px;vertical-align:middle;" rowspan="5"> <button type="button" name="add" id="add" class="form-control btn btn-success fa fa-plus-circle"></button></td>    
                        </tr>
                    <tr>
                            <td>
                                    <label>Dana Perencanaan</label>
                                    <div class="input-group margin-bottom-sm">
                                            <span class="input-group-addon">Rp.</span>
                                <input type="text" id="perencanaan" name="perencanaan[]" required class="form-control perencanaan_list"></td>
                                    </div>
                            </tr>
                    <tr> 
                            <td><label>Tipe Perencanaan</label>
                                <select name="tipe[]" id="tipe" class="form-control tipe-list">
                                <option value="">Tidak ada</option>    
                                <option value="Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa">Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa</option>
                                <option value="Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan">Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan</option>
                                <option value="Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan">Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan</option>
                                <option value="Pembangunan pemanfaatan dan pemeliharaan ekonomi">Pembangunan pemanfaatan dan pemeliharaan ekonomi</option>
                            </select>
                        </tr>
                    </table>               
                </div>
              </div>
              <div class="modal-footer">
                {{ Form::submit('Tutup',  array('class'=>'btn btn-secondary', 'data-dismiss'=>'modal' ))}}
                {{ Form::submit('Simpan',  array('class'=>'btn btn-success'))}}
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>    
    

@stop

@section('css')

@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function(){      
    var postURL = "<?php echo url('addmore'); ?>";
    var i=1;  
    $('#add').click(function(){  
         i++; 
         var html='<tbody id="hapus'+i+'"><tr class="dynamic-added"><td><label>Nama Perencanaan</label><input type="text" name="nama[]"  class="form-control name_list" ></td><td></td></tr><tr id="" class="dynamic-added"><td><label>Dana Perencanaan</label><div class="input-group margin-bottom-sm"><span class="input-group-addon">Rp.</span><input type="text" id="rencana'+i+'" name="perencanaan[]" class="form-control perencanaan_list" required></td></div><td><button type="button" name="remove" id="'+i+'" class="form-control btn btn-danger btn_remove fa fa-window-close" style="vertical-align:middle;" rowspan="5"></button></td></tr><tr><td><label>Tipe Perencanaan</label><select name="tipe[]" id="tipe" class="form-control tipe-list"><option value="">Tidak ada</option><option value="Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa">Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa</option><option value="Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan">Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan</option><option value="Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan">Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan</option><option value="Pembangunan pemanfaatan dan pemeliharaan ekonomi">Pembangunan pemanfaatan dan pemeliharaan ekonomi</option></select><td></td></tr></tbody>';
         $('#dynamic_field').append(html); 
         $('#rencana'+i+'').mask('000.000.000.000.000.000.000.000', {reverse: true});
        });  
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#hapus'+button_id+'').remove();  
    });  

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#submit').click(function(){            
         $.ajax({  
              url:postURL,  
              method:"POST",  
              data:$('#add_name').serialize(),
              type:'json',
              success:function(data)  
              {
                  if(data.error){
                      printErrorMsg(data.error);
                  }else{
                      i=1;
                      $('.dynamic-added').remove();
                      $('#add_name')[0].reset();
                      $(".print-success-msg").find("ul").html('');
                      $(".print-success-msg").css('display','block');
                      $(".print-error-msg").css('display','none');
                      $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                  }
              }  
         });  
    });  


    function printErrorMsg (msg) {
       $(".print-error-msg").find("ul").html('');
       $(".print-error-msg").css('display','block');
       $(".print-success-msg").css('display','none');
       $.each( msg, function( key, value ) {
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
       });
    }
  });  
</script>
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script>
    $(document).ready(function(){
      $('#total_penerimaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
  })
</script>
<script>
  $(document).ready(function(){
    $('#dana').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>
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
  $(document).ready(function(){
    $('#perencanaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
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
</script>
    <!-- Include this after the sweet alert js file -->
  @include('sweet::alert')
@stop