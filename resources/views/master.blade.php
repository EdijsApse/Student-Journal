<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta  name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
        <title>@yield('title')</title>
        <link href="{{ url('/') }}/css/reset.css" rel="stylesheet">
        <link href = "{{ url('/') }}/libs/bootstrap/css/bootstrap.css" rel ="stylesheet">
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
        <script src="{{ url('/') }}/libs/jQuery/jquery2.1.4.min.js"></script>
        <script src="{{ url('/') }}/libs/bootstrap/js/bootstrap.js"></script>
        <script src="{{ url('/') }}/libs/angularJS/angular.min.js"></script>
        <script src="{{ url('/')}}/calendar/js/cal_object.js"></script>
        <script src="{{url('/')}}/js/drag_drop.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        @yield('additional_head')
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0 left">
                    @include('left_sidebar')
                </div>
                <div class="col-md-5 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 main">
                    @yield('main_content')
                </div>
                <div class="col-md-3 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 right">
                    @include('right_sidebar')
                </div>
            </div>
        </div>
        @yield('modals')
    </body>
</html>
