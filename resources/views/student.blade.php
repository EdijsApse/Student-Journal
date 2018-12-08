@extends('master')

@section('title')
    {{$student->name}} {{$student->surname}}
@stop

@section('menu')
    <div class="navbar">
        <ul>
            <li>
                <a href="{{url('/')}}/lectures">Lekcijas</a>
            </li>
            <li>
                <a class="active" href="{{url('/')}}/students">Studenti</a>
            </li>
        </ul>
    </div>
@stop

@section('main_content')
    <div class="student">
        <div class="student_image">
            <img class="img-circle" src="{{url('/')}}/{{$student->image}}" />
        </div>
        <div class="student_info">
            <ul>
                <li>Vārds:<span>{{$student->name}}</span></li>
                <li>Uzvārds:<span>{{$student->surname}}</span></li>
                <li>Epasts:<span>{{$student->email}}</span></li>
                <li>Mobila numurs:
                    @if(empty($student->number))
                        <span>Nav norādīts</span>
                    @else
                        <span>{{$student->number}}
                    @endif    
                </li>
                <li>Apmeklējuma procents:<span>{{$attendance}}%</span></li>
                <li>Profila skatījumi:<span>{{$student->views}}</span></li>
            </ul>
        </div>
    </div>
@stop