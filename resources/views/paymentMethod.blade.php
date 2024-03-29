@extends('layouts.app')

@section('content')
<div class="row">        
      <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Method | Payment Decision</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form role="form" id="paymentMethodForm" action="{{route('paymentMethodSubmit')}}" method="POST" >
                {{csrf_field()}}
              <div class="box-body">
                <div class="row">
                    
                    <div class="form-group">
                        
                        @if($payment->payment_method == 'online')
                            <div class="col-md-4 col-md-offset-1  form-group">
                                <label>
                                    <input type="radio" value="chalan" name="payment-method" class="minimal minimal-red form-control">
                                    Chalan <sup><span class="label label-success">Recommended</span></sup>
                                </label>
                            </div>
                            <div class="col-md-4 col-md-offset-1  form-group">
                                <label>
                                    <input type="radio" value="online" name="payment-method" class="minimal minimal-red form-control" checked>
                                    Online Payment
                                </label>
                            </div>
                            
                        @else
                            <div class="col-md-4 col-md-offset-1  form-group">
                                <label>
                                    <input type="radio" value="chalan" name="payment-method" class="minimal minimal-red form-control" checked>
                                    Chalan <sup><span class="label label-success">Recommended</span></sup>
                                </label>
                            </div>
                            <div class="col-md-4 col-md-offset-1  form-group">
                                <label>
                                    <input type="radio" value="online" name="payment-method" class="minimal minimal-red form-control">
                                    Online Payment
                                </label>
                            </div>
                            
                        @endif
                    </div>
                </div>
                           
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-right">
                <button type="submit" class="btn btn-flat bg-red">Next</button>
              </div>
              
            </form>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Guidelines</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul>
                    <li><sup><span class="label label-success">Recommended</span></sup> Chalan: Upon selecting this method of payment, a challan form will be generated and forwarded to you. You may, then, pay this challan at any HBL branch across Pakistan.</li>
                    <li>Online: Upon choosing this method of payment, you will be provided with our account details and your total registration dues. You may, then, proceed to pay your dues online and forward us a proof of your receipt.</li>
                </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="row">
        <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Contact Us</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row"><div class="col-md-12">
            <p>In case of any query contact us on</p>
            <p><b>Email:</b></p>
            <p><span class="label label-info" style="font-size: 14px;">registrations@homecoming.nust.edu.pk</span></p>
            <p><span class="label label-info" style="font-size: 14px;">support@alumni.nust.edu.pk</span></p>
            <p><b>Phone Number:</b></p>
            <p><span class="label label-info" style="font-size: 14px;">+923343631447</span></p>
            <p><span class="label label-info" style="font-size: 14px;">051-90856838</span></p>
            </div></div>
            </div>
            <!-- /.box-body -->
           
        </div>
        </div>
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
<!-- iCheck 1.0.1 -->
<script src="{{asset('theme/lte/plugins/iCheck/icheck.min.js')}}"></script>
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
@endsection