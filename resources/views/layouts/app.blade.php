<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.layout.head')
    @yield('header-styles')
</head>
<body class="hold-transition skin-green sidebar-mini">
    <div id="app" class="wrapper">
        <!-- Main Header -->
        @if (Auth::guest())
            @include('partials.layout.logged-out-nav')
        @else
            @include('partials.layout.logged-in-nav')
        @endif
        @include('partials.layout.left-sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) 
            <section class="content-header">
                <h1>
                    Page Header
                    <small>Optional description</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                    <li class="active">Here</li>
                </ol>
            </section>-->

            <!-- Main content -->
            <section class="content container-fluid">

                <!--------------------------
                  | Your Page Content Here |
                  -------------------------->
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
               {{__('footer.line2')}}
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2017 <a href="{{url('/')}}">Wordify</a>.</strong> All rights reserved.
        </footer>
    </div>
    @include('partials.layout.footer-scripts')
</body>
</html>