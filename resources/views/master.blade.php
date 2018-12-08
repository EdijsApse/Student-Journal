<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta  name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link href="{{ url('/') }}/css/reset.css" rel="stylesheet">
        <link href = "{{ url('/') }}/libs/bootstrap/css/bootstrap.css" rel ="stylesheet">
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
        <script src="{{ url('/') }}/libs/jQuery/jquery2.1.4.min.js"></script>
        <script src="{{ url('/') }}/libs/bootstrap/js/bootstrap.js"></script>
        <script src="{{ url('/') }}/libs/angularJS/angular.min.js"></script>
        <script src="{{ url('/')}}/calendar/js/cal_object.js"></script>
        <script src="{{url('/')}}/js/drag_drop.js"></script>
        <script src="{{url('/')}}/js/ajax.js"></script>
        <script src="{{url('/')}}/js/additional_effects.js"></script>
        @yield('additional_head')
    </head>
    <body>
        <div class="container-fluid">
            @yield('menu')
            <div class="row">
                <div class="col-md-3 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0 left">
                    @include('left_sidebar')
                </div>
                <div class="col-md-6 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 main">
                    @yield('main_content')
                </div>
                <div class="col-md-3 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 right">
                    @include('right_sidebar')
                </div>
            </div>
        </div>
        @yield('modals')
        <div id="student_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="student_form" class="my-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Studenta vārds:</label>
                                <input type="text" class="form-control" name="name" placeholder="Studenta vārds. Max garums - 20" required>
                                <span class="required glyphicon glyphicon-asterisk"><span>Obligāts<span></span>
                            </div>
                            <div class="form-group">
                                <label for="surname">Studenta uzvārds:</label>
                                <input type="text" class="form-control" name="surname" placeholder="Studenta uzvārds. Max garums - 20" required>
                                <span class="required glyphicon glyphicon-asterisk"><span>Obligāts<span></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Studenta e-pasts:</label>
                                <input type="text" class="form-control" name="email" placeholder="Studenta e-pasta adrese. Max garums - 30" required>
                                <span class="required glyphicon glyphicon-asterisk"><span>Obligāts<span></span>
                            </div>
                            <div class="form-group">
                                <label for="number">Studenta mobila numurs:</label>
                                <input type="text" class="form-control" name="number" placeholder="Studenta mobila numurs. Garums - 8">
                                <span class="optional glyphicon glyphicon-asterisk"><span>Izvēles<span></span>
                            </div>
                            <div class="students">
                                <label>Studenta attēls:</label>
                                <span class="optional glyphicon glyphicon-asterisk"><span>Izvēles</span></span>
                                <div id='student_image' class="student_image">
                                    <img src=""/>
                                </div>​
                                <label id="upload_image" for="file_upload">
                                    <span class="choose">Ievelc attēlu paredzētajā vietā</span>
                                    <span>vai</span>
                                    <p>Izvēlēties attēlu</p>
                                </label>
                                <input id="file_upload" name="image" type="file" accept=".jpg, .jpeg, .png" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default my-btn modal_close" data-dismiss="modal">Atcelt</button>
                        <button id="add_student" type="button" class="btn btn-default my-btn add">Pievienot</button>
                        <div class="alert alert-danger notification">
                            <span class="glyphicon glyphicon-remove close"></span>
                            <ul>
                                <li class="message"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
