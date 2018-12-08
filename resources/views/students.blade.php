@extends('master')

@section('title','Studneti')

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
    <div class="students">
        @if(count($students) == 0)
            <p>Nav pievienoti nevieni studenti</p>
        @else
            @foreach($students as $student)
                <div class="student">
                    <img src="{{url('/')}}/{{$student->image}}" />
                    <ul>
                        <li>Vārds:<span>{{$student->name}}</span></li>
                        <li>Uzvārds:<span>{{$student->surname}}</span></li>
                        <li>Epasts:<span>{{$student->email}}</span></li>
                    </ul>
                    <a class="visit_profile" href="{{url('/')}}/students/{{$student->id}}">Apskatīt</a>
                </div>
            @endforeach
        @endif
    </div>
    <div class="pages text-center">
        {{$students->links()}}
    </div>
@stop