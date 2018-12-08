@extends('master')

@section('title')
    {{$year}} Gada {{$date}}.{{$url_month}}
@stop

@section('menu')
    <div class="navbar">
        <ul>
            <li>
                <a class="active" href="{{url('/')}}/lectures">Lekcijas</a>
            </li>
            <li>
                <a href="{{url('/')}}/students">Studenti</a>
            </li>
        </ul>
    </div>
@stop

@section('main_content')
    <div class="sections">
        <ul>
            <li>
                <a href="{{url('/')}}/calendar/{{$year}}">{{$year}}</a>
            </li>
            <li>
                <span>/</span>
            </li>
            <li>
                <a href="{{url('/')}}/calendar/{{$year}}-{{$month}}">{{$url_month}}</a>
            </li>
            <li>
                <span>/</span>
            </li>
            <li>
                <a class="active" href="{{url('/')}}/calendar/{{$year}}-{{$month}}-{{$date}}">{{$date}}</a>
            </li>
            <li>
            </li>
        </ul>
    </div>
    <div class="lectures">
        @if(count($lectures) == 0)
            <p>Patreiz neviena lekcija nav pievienota.</p>
        @else
            @foreach($lectures as $lecture)
                <div class="lecture">
                    <h3>{{$lecture->title}}</h3>
                    <div class="lecture_description">
                        <p>{{$lecture->description}}</p>
                    </div>
                    <div class="lecture_attendance">
                        @if(count($lecture->lecture_attendance) == 0)
                            <p>Šo lekciju neviens nav apmeklējis</p>
                        @else
                            <h4 class="show_attendance">Lekcijas apmeklējums<span class="glyphicon glyphicon-option-horizontal"></span></h4>
                            <div class="attendance">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Vārds</th>
                                            <th>Uzvārds</th>
                                            <th>Epasts</th>
                                            <th>Statuss</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lecture->lecture_attendance as $attendance)
                                        <tr>
                                            <td>{{$attendance->student_data->name}}</td>
                                            <td>{{$attendance->student_data->surname}}</td>
                                            <td>{{$attendance->student_data->email}}</td>
                                            <td>
                                                @if($attendance->value == 1)
                                                    Apmeklēja
                                                @else
                                                    Neapmeklēja
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <button type="button" class="btn btn-default add" data-toggle="modal" data-target="#lecture_modal">Pievienot lekciju</button>
    <div class="pages text-center">
        {{$lectures->links()}}
    </div>
@stop

@section('modals')
    <div id="lecture_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="my-form">
                        <div class="form-group">
                            <label for="title">Lekcijas nosaukums:</label>
                            <input type="text" class="form-control" name="title" placeholder="Piem: Ievads PHP. Max garums - 40">
                            <span class="required glyphicon glyphicon-asterisk"><span>Obligāts<span></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Lekcijas apraksts:</label>
                            <textarea id="description" placeholder="Apraksts par lekciju. Piem:Ievads PHP funkcijās, mainīgo delarēšana ... Max garums - 300" id="description" maxlength="1000"></textarea>
                            <span class="required glyphicon glyphicon-asterisk"><span>Obligāts</span></span>
                        </div>
                        <div class="students">
                            <label for="description">Lekcijas apmeklējums:</label>
                            <span class="optional glyphicon glyphicon-asterisk"><span>Izvēles</span></span>
                            <div class="attendance">
                                <div class="visit attended">
                                    <h3>Ieradās</h3>
                                </div>
                                <div class="visit skiped">
                                    <h3>Neieradās</h3>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default my-btn modal_close" data-dismiss="modal">Atcelt</button>
                    <button id="add_lecture" type="button" class="btn btn-default my-btn add">Pievienot</button>
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
@stop