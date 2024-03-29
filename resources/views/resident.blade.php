@extends('layouts.app')

@section('content')
<div class="row">        
      <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Residence | Payment Decision</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form role="form" id="residentForm" action="{{route('residentSubmit')}}" method="POST" >
                {{csrf_field()}}
              <div class="box-body">
                <div class="row">
                    
                    <div class="form-group">
                        @if($payment->resident == 'pakistani')
                            <div class="col-md-4 col-md-offset-1 form-group">
                                <label>
                                    <input type="radio" value="pakistani" name="resident" class="minimal minimal-red form-control" checked>
                                    In Pakistan
                                </label>
                            </div>
                            <div class="col-md-4 col-md-offset-1 form-group">
                                <label>
                                    <input type="radio" value="overseas" name="resident" class="minimal minimal-red form-control">
                                    Overseas Alumni
                                </label>
                            </div>
                        @else
                            <div class="col-md-4 col-md-offset-1 form-group">
                                <label>
                                    <input type="radio" value="pakistani" name="resident" class="minimal minimal-red form-control">
                                    In Pakistan
                                </label>
                            </div>
                            <div class="col-md-4 col-md-offset-1 form-group">
                                <label>
                                    <input type="radio" value="overseas" name="resident" class="minimal minimal-red form-control" checked>
                                    Overseas Alumni
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
                    <li>If you are currently residing inside Pakistan, select “In Pakistan”.</li>
                    <li>Alternately, if you are currently residing outside Pakistan but your relative/acquaintance can pay your dues in Pakistan on your behalf, click “In Pakistan”.</li>
                    <li>However, if you are residing abroad and are unable to access the second option, simply click “Overseas Alumni”.</li>
                    <li><b>RESPECTED OVERSEAS ALUMNI: </b>Your payment will be received once you have reached Pakistan.</li>

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