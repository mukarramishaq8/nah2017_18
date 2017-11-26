@extends('layouts.app')

@section('content')


<div class="modal fade" id="modal-chalan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-red">
                
                <h4 class="modal-title">Upload Receipt Copy/Screenshot</h4>
              </div>
              {!! Form::open(['route'=>'ajax.upload-chalan','files'=>'true']) !!}
              <div class="modal-body">
                
                  <span class="label label-danger error-msg" style="display:none">
                      
                  </span>
                  <div class="row">
                    <div class="preview-uploaded-image col-md-4 col-md-offset-4" >
                    </div>
                  </div>
                  <div class="form-group input-picture">
                    <label>Receipt Image:</label>
                    <input type="file" name="image" class="form-control">
                  </div>
                  
                
              </div>
              <div class="modal-footer">
              
                <div class="form-group form-footer">
                <button class="btn bg-red upload-image" type="submit">Upload Chalan Image</button>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


<div class="row">        
      <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Chalan | Payment Decision</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            
              <div class="box-body">
                <div class="row">
                    <!-- general form elements -->
                    <div class="box box-default col-md-10 col-md-offset-1">
                        <div class="box-header with-border">
                        <h3 class="box-title">For Online Payment</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        
                        
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                <!-- <button class="btn btn-flat bg-red">Download Chalan Form</button> -->
                                </div>
                            </div>
                                    
                        </div>
                       
                    </div>
                    <!-- /.box -->
                </div>

                <div class="row">
                    <!-- general form elements -->
                    <div class="box box-default col-md-10 col-md-offset-1">
                        <div class="box-header with-border">
                        <h3 class="box-title">After Online Payment</h3>
                        </div>
                        <!-- /.box-header -->
                        <div>
                            <span class=" ajax-info label col-md-12"></span>
                        </div>
                        <!-- form start -->
                        
                        <form role="form" id="onlineMethodForm" action="{{route('onlineMethodSubmit')}}" method="POST" >
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-1">
                                    <label for="amount">Amount</label>
                                    <input type="number" required="true" name="amount" class="form-control" id="amount" placeholder="Enter paid amount">
                                </div>
                                <div class="form-group col-md-4 col-md-offset-1">
                                    <label for="account-no">Your Account No</label>
                                    <input type="text" required="true" name="account-no" class="form-control" id="account-no" placeholder="Enter Your Account No">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <input type="text" style="display:none;" id="id-is-chalan-uploaded" value="{{$payment->paid_chalan_path}}" required>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="class-preview col-md-10 col-md-offset1">
                                    @if($payment->paid_chalan_path)
                                        <img src="{{asset('chalan_images/'.$payment->user_id.'.png')}}"  width="100%"/>
                                    @endif
                                </div>
                            </div>
                            <br> <br>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                <button type="button" class="btn btn-flat bg-red" data-toggle="modal" data-target="#modal-chalan"><span class="fa fa-cloud-upload"></span> Upload Copy of Receipt</button>
                                </div>
                            </div>

                            
                                    
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button class="btn btn-flat bg-red" type="submit" onclick="pivf();">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                           
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-right">
                
              </div>
          </div>
          <!-- /.box -->
          
        </div>
        <div class="col-md-3">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Instructions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul>
                    <li>instruction1</li>
                </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
@endsection
@section('header-styles')
<link rel="stylesheet" href="{{asset('theme/lte/plugins/iCheck/all.css')}}">
@endsection

@section('footer-scripts')
<!-- jQuery 3 -->
<script src="{{asset('theme/lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('theme/lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('theme/lte/plugins/iCheck/icheck.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
</script>
<script>
    // $(document).ready(function(){
    //     var ci = "{{$payment->paid_chalan_path}}";
    //     var i = "{{$payment->user_id}}";
    //     var u = "route('')"
    //     if(ci != ""){
    //         $('.class-preview').html('<img class="imgPicker" id="imgViewer" src="'+response.responseJSON.url+'?'+d.getTime()+'" alt="your image"  width="100%"/>');
    //     }
    // });
    function pivf(){
        $('.ajax-info').hide();
        if(document.getElementById('id-is-chalan-uploaded').value.indexOf('.png') !== -1 || document.getElementById('id-is-chalan-uploaded').value != ""){
            //out= confirm('Once submitted, you cannot access this section anymore! Do you want to submit?');	
            //return out;
            return true;
        }
        else{
            $('.ajax-info').addClass('label-info').text('Upload copy of online payment receipt please!');
            $('.ajax-info').show();
            return false;
        }
    }
	
    $("body").on("click",".upload-image",function(e){
        $.ajaxSetup({ cache: false });
        $(this).parents("form").ajaxForm({ 
          complete: function(response) 
          {
            
            if($.isEmptyObject(response.responseJSON.image)){
              $('.error-msg').css('display','none');
              d = new Date();
              $('.preview-uploaded-image').html('<img src="'+response.responseJSON.url+'?'+d.getTime()+'" height="100px" width="100px">');
              $('#modal-pic .modal-footer .form-footer').html('<button class="btn bg-red upload-image" type="submit">Upload Image</button><button class="btn bg-red" data-dismiss="modal">Close</button>');
              $('.class-preview').html('<img class="imgPicker" id="imgViewer" src="'+response.responseJSON.url+'?'+d.getTime()+'" alt="your image"  width="100%"/>');
              $('#id-is-chalan-uploaded').val(response.responseJSON.url+"");
                      
            }else{
              var msg=response.responseJSON.image;
              $(".error-msg").find("ul").html('');
              $(".error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".error-msg").html(value);
              });
            }
          }
        });
      });
</script>
@endsection