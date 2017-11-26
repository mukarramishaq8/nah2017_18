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
                        @if($payment->payment_method == 'cod')
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="chalan" name="payment-method" class="minimal minimal-red form-control">
                                    Chalan
                                </label>
                            </div>
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="online" name="payment-method" class="minimal minimal-red form-control">
                                    Online Payment
                                </label>
                            </div>
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="cod" name="payment-method" class="minimal minimal-red form-control"  checked>
                                    Cash on Delivery
                                </label>
                            </div>
                        @elseif($payment->payment_method == 'online')
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="chalan" name="payment-method" class="minimal minimal-red form-control">
                                    Chalan
                                </label>
                            </div>
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="online" name="payment-method" class="minimal minimal-red form-control" checked>
                                    Online Payment
                                </label>
                            </div>
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="cod" name="payment-method" class="minimal minimal-red form-control">
                                    Cash on Delivery
                                </label>
                            </div>
                        @else
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="chalan" name="payment-method" class="minimal minimal-red form-control" checked>
                                    Chalan
                                </label>
                            </div>
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="online" name="payment-method" class="minimal minimal-red form-control">
                                    Online Payment
                                </label>
                            </div>
                            <div class="col-md-4  form-group">
                                <label>
                                    <input type="radio" value="cod" name="payment-method" class="minimal minimal-red form-control">
                                    Cash on Delivery
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