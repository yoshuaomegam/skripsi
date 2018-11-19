{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Tambah Pelaporan')

@section('content_header')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
            <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
      <h3 class="box-title">Form Data Perencanaan Tahun {{$data->tahun_perencanaan}}</h3>
      <div class="box-tools pull-right">
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
                      {!! Form::open(array('route'=>['admin.perencanaan.store', $data->id],'data-parsley-validate'=>'')) !!}
                      {!! Form::label('title', 'Total Penerimaan Dana') !!}
                      <div>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp.</span>
                          {!! Form::text('total_penerimaan', null, ['class'=>'form-control','id'=>'total_penerimaan']) !!}
                        </div>
                      </div>
                      <br>
                      {!! Form::label('title', 'Sumber') !!}
                      {!! Form::text('sumber', null, ['class'=>'form-control']) !!}
                      <hr style="border-style: inset;">                     
                      <div class="table-responsive">  
                        <table class="table table-bordered" id="dynamic_field">  
                            <tr>  
                                
                                <td><label>Nama Perencanaan</label>
                                    <input type="text" name="nama[]"  class="form-control name_list"></td>  
                                <td style="width:5px;vertical-align:middle;" rowspan="5"> <button type="button" name="add" id="add" class="form-control btn btn-success fa fa-plus-circle"></button></td>    
                            </tr>
                        <tr>
                                <td>
                                        <label>Dana Perencanaan</label>
                                        <div class="input-group margin-bottom-sm">
                                                <span class="input-group-addon">Rp.</span>
                                    <input type="text" id="perencanaan" name="perencanaan[]" class="form-control perencanaan_list" ></td>
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
        
                      {{ Form::submit('Tambah',  array('class'=>'form-control btn btn-success'))}}
                      {!! Form::close() !!}
    </div><!-- /.box-body -->
    
  </div><!-- /.box -->


  
            
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
         var html='<tbody id="hapus'+i+'"><tr class="dynamic-added"><td><label>Nama Perencanaan</label><input type="text" name="nama[]"  class="form-control name_list"></td><td></td></tr><tr id="" class="dynamic-added"><td><label>Dana Perencanaan</label><div class="input-group margin-bottom-sm"><span class="input-group-addon">Rp.</span><input type="text" id="perencanaan2" name="perencanaan[]" class="form-control perencanaan_list" ></td></div><td><button type="button" name="remove" id="'+i+'" class="form-control btn btn-danger btn_remove fa fa-window-close" style="vertical-align:middle;" rowspan="5"></button></td></tr><tr><td><label>Tipe Perencanaan</label><select name="tipe[]" id="tipe" class="form-control tipe-list"><option value="">Tidak ada</option><option value="Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa">Pembangunan pemanfaatan dan pemeliharaan infrastruktur dan lingkungan desa</option><option value="Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan">Pembangunan pemanfaatan dan pemeliharaan sarana dan prasarana kesehatan</option><option value="Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan">Pembangunan pemanfaatan dan pemeliharaan pendidikan dan kebudayaan</option><option value="Pembangunan pemanfaatan dan pemeliharaan ekonomi">Pembangunan pemanfaatan dan pemeliharaan ekonomi</option></select><td></td></tr></tbody>';
         $('#dynamic_field').append(html);  
         $('#perencanaan2').mask('000.000.000.000.000.000.000.000', {reverse: true});
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
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
$(document).ready(function(){
    $('#perencanaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>
<script>
$(document).ready(function(){
    $('#total_penerimaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>

@stop

