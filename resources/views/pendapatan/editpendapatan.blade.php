@extends('adminlte::page')

@section('title', 'Pelaporan')

@section('content_header')

@stop

@section('content')  
                <div class="box box-info">
                    <div class="box-header with-border"><h3 class="box-title" style="margin-left: 15px;margin-bottom: 5px;" >APBDesa Tahun {{$data->tahun_apbd}}</h3>
                        <td><a href="/admin/menupelaporan/{{$data->id}}/apbdesa/pendapatan" class="btn btn-xs btn-success fa fa-plus"  title="tambah" style="position:absolute;right:20px;"></a></td>
                      </div>
                          <div class="box-body">
                              <div class="container" style="width: auto;">
                                  <div class="form-group">
                                    {!! Form::model($data,['route'=>['admin.pendapatan.update', $data->id_pelaporan,$data->id],'method'=>'POST']) !!}
                                    <div class="form-group">
                                            {{ Form::label('name', 'Name') }}
                                            <select class="form-control" name="nama" id="nama" data-url="{{ url('api/dropdown')}}">
                                                @foreach($dropdown as $key=>$drop)
                                                <option value = "<?php echo $data->nama; ?>" 
                                                    <?php
                                                        if ($drop == $data->nama){
                                                            echo 'selected="selected"';
                                                        } 
                                                    ?> >
                                                    <?php echo $drop; ?> 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            {{ Form::label('Pendapatan', 'Pendapatan') }}
                                            <div class="input-group margin-bottom-sm">
                                                <span class="input-group-addon">Rp.</span>
                                    <input type="text" id="pendapatan" name="pendapatan" value="{{$data->pendapatan}}" class="form-control perencanaan_list" required></td>
                                        </div>
                                        </div>
                            </div>
                            {!! Form::close() !!}
                            
                            <h3>Lampiran</h3>
                            <a href="#tambahmodal" class="btn btn-success" title="tambah" data-toggle="modal" data-target="#tambahmodal">Tambah Data Pendapatan</a>
                            <br>
                            <br>
                            <table id="pelaporan"  class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th width="10">No</th>
                                        <th>File</th>
                                        <th>Deskripsi</th>
                                        <th></th>
                                        <th></th>
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
                        <td><a href="#editdetail" class="btn btn-xs btn-success fa fa-edit" title="edit" data-toggle="modal" data-target="#editdetail{{$detail->id}}"></a></td></td>
                        <td>
                            {!! Form::model($detail,['route'=>['admin.pendapatan.delete2', $data->id_pelaporan, $detail->id_pendapatan, $detail->id],'method'=>'DELETE', 'id'=>'form']) !!}
                           {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type'=>'submit','class'=>'btn btn-xs btn-danger', 'rel'=>'tooltip', 'title'=>'Hapus')) !!}
                           {!! Form::close() !!}
                     </td>       
                    </tr>
                      
                    
                         <div class="modal fade" id="editdetail{{$detail->id}}" data-id="{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="editdetailLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 class="modal-title" id="editdetailLabel">Edit Data Perencanaan</h2>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::model($detail,['route'=>['admin.pendapatan.update2', $data->id_pelaporan,$data->id,$detail->id],'files'=>true]) !!} 

                                  {{ Form::label('title','Deskripsi') }}
                                  {{ Form::text('deskripsi', NULL, array('class'=>'form-control'))}}
 
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
                                <tfoot>
                            
                                </tfoot>
                                </table>
                                            </div>
                                        </div>
                                  </div>
                              </div>
  


                              <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="tambahmodalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h2 class="modal-title" id="tambahmodalLabel">Tambah File Pendapatan</h2>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(array('route'=>['admin.pendapatan.store2','id' => $data->id_pelaporan,'id_pendapatan'=>$data->id],'data-parsley-validate'=>'','files'=>true)) !!}

                                                                                          <table class="table table-bordered" id="dynamic_field">  
                                                                                              <td>File</td>
                                                                                              <td>Deskripsi</>
                                                                                              <td>Aksi</td>
                                                                                              <tr>  
                                                                                                  <td><input type="file" name="file[]" placeholder="file" class="form-control file_list" required></td>  
                                                                                                  <td><input type="text" name="deskripsi[]" placeholder="Deskripsi" class="form-control deskripsi_list"/></td>  
                                                                                                  <td><button type="button" name="add" id="add" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span> </button></td>  
                                                                                              </tr>  
                                                              
                                                                                          </table>  
                                                           <br>
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
<script src="{{ asset('js/jquery.mask.js') }}"></script>
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
<script>
$(document).ready(function(){
    $('#pendapatan').mask('000.000.000.000.000.000.000.000', {reverse: true});
})
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

      <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  <!-- Include this after the sweet alert js file -->
@include('sweet::alert')
@stop