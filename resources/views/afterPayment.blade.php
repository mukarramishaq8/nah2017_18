@extends('layouts.app')

@section('content')
<div class="row">        
      <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-danger">
                <div class="box-header with-border">
                <h3 class="box-title">Payment Verification</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
            
            
                <div class="box-body">
                    <div class="row">
                        
                        <p class="col-md-10 col-md-offset-1">Thank You for registering for this worderful event. We'll inform you about your payment verification through email or call within 24-48 hours.</p>
                    </div>
                            
                </div>
                <!-- /.box-body -->
              
              
            </div>
            <!-- /.box -->
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

@endsection