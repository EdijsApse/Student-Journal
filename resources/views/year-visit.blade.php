@extends('master')

@section('title')
    {{$year}} Gads
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
                <a class="active" href="{{url('/')}}/calendar/{{$year}}">{{$year}}</a>
            </li>
        </ul>
    </div>
    <div class="lectures">
        @if(count($lectures) == 0)
            <p>Patreiz neviena lekcija nav pievienota.</p>
            <p>Izvēlies kalendārā datumu, lai pievienotu lekciju.</p>
        @else
            @foreach($lectures as $lecture)
                <div class="lecture">
                    <h3>{{$lecture->title}}</h3>
                    <div class="lecture_description">
                        <p>{{$lecture->description}}</p>
                        <span>Datums:{{$lecture->date}}</span>
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
    <div class="pages text-center">
        {{$lectures->links()}}
    </div>
@stop