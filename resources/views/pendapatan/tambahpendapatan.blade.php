{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Tambah Pelaporan')

@section('content_header')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
            <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
      <h3 class="box-title">Form Data Pendapatan Tahun {{$data->tahun_perencanaan}}</h3>
      @if (count($errors) > 0)
      <div class="alert alert-danger">
          <strong>Whoops!</strong> Ada yang salah<br><br> 
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
      </div>
@endif

      <div class="box-tools pull-right">
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
                      {!! Form::open(array('route'=>['admin.pendapatan.store', $data->id],'data-parsley-validate'=>'','files'=>'true','enctype'=>'multipart/form-data')) !!}                     
                        <label>Nama Pendapatan</label>
                                                <select name="nama" id="nama" class="form-control tipe-list" required>
                                                    @foreach ($dropdown as $key => $nama)
                                                    <option value="{{ $nama}}" {{ (old("nama") == $nama ? "selected":"") }}>{{ $nama }}</option>
                                                @endforeach
                                        </select>      
                                        <br>
                                        <label>Dana Pendapatan</label>
                                        <div class="input-group margin-bottom-sm">
                                                <span class="input-group-addon">Rp.</span>
                                    <input type="text" id="pendapatan" name="pendapatan" value="{{old('pendapatan')}}" class="form-control perencanaan_list" required></td>
                                        </div>
                                        <br>
                                       
                                                                      <table class="table table-bordered" id="dynamic_field">  
                                                                          <td>File</td>
                                                                          <td>Deskripsi</>
                                                                          <td>Aksi</td>
                                                                          <tr>  
                                                                              <td><input type="file" name="file[]" placeholder="File" class="form-control" file="true" enctype="multipart/form-data"></td>  
                                                                              <td><input type="text" name="deskripsi[]" placeholder="Deskripsi" class="form-control deskripsi_list"/></td>  
                                                                              <td><button type="button" name="add" id="add" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span> </button></td>  
                                                                          </tr>  
                                          
                                                                      </table>  
                                       <br>
                      {{ Form::submit('Tambah',  array('class'=>'form-control btn btn-success'))}}
                     
                      {!! Form::close() !!}
    </div><!-- /.box-body -->
    
  </div><!-- /.box -->

  
            
@stop

@section('css')
@stop

@section('js')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
$(document).ready(function(){
    $('#pendapatan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>
<script>
$(document).ready(function(){
    $('#total_penerimaan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
</script>
<script type="text/javascript">

    $(document).ready(function(){      

      var postURL = "<?php echo url('addmore'); ?>";

      var i=1;  


      $('#add').click(function(){  

           i++;  

           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="file[]" placeholder="File" class="form-control file_list"></td><td><input type="text" name="deskripsi[]" placeholder="Deskripsi" class="form-control deskripsi_list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="glyphicon glyphicon-remove"></span></button></td></tr>');  

      });  


      $(document).on('click', '.btn_remove', function(){  

           var button_id = $(this).attr("id");   

           $('#row'+button_id+'').remove();  

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
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')
@stop

