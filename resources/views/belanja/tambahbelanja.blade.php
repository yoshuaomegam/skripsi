{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Tambah Pelaporan')

@section('content_header')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
            <a href="{{ url()->previous() }}" class="fa fa-chevron-circle-left" aria-hidden="true"></a>
      <h3 class="box-title">Form Data Belanja Tahun {{$data->tahun_perencanaan}}</h3>
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
                      {!! Form::open(array('route'=>['admin.belanja.store', $data->id],'data-parsley-validate'=>'','files'=>'true','enctype'=>'multipart/form-data')) !!}                     
                      {!! Form::label('title', 'Nama Belanja') !!}
                      {!! Form::text('nama', old('nama'), ['class'=>'form-control','id'=>'total_penerimaan','required'=>'required']) !!}
                                        <br>
                                        <label>Dana Belanja</label>
                                        <div class="input-group margin-bottom-sm">
                                                <span class="input-group-addon">Rp.</span>
                                    <input type="text" id="belanja" name="belanja" value="{{old('belanja')}}" class="form-control perencanaan_list" required></td>
                                        </div>
                                        <br>
                                        <label>Tipe Belanja</label>
                                        <select name="tipe" id="tipe" class="form-control tipe-list" required>
                                            @foreach ($dropdown as $key => $tipe)
                                            <option value="{{ $tipe}}" {{ (old("tipe") == $tipe ? "selected":"") }}>{{ $tipe }}</option>
                                        @endforeach
                                </select>      
                                        <br>
                                        <div id="map"></div>
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
<style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
      </style>
@stop

@section('js')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
$(document).ready(function(){
    $('#belanja').mask('000.000.000.000.000.000.000.000', {reverse: true});
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

