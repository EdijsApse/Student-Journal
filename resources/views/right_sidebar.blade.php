<div class="student_list" draggable="false">
    <h3 draggable="false">Studentu saraksts</h3>
    @if(count($all_students) == 0)
        <p>Nav pievienots neviens students</p>
    @else
        @foreach($all_students as $student)
            <div class="student" draggable="true" value="{{$student->id}}" surname="{{$student->surname}}"><!--Nav labākā prakse gluži-->
                <h4>{{$student->name}} {{$student->surname}}<span class="glyphicon glyphicon-option-horizontal"></span>
                </h4>
                <div class="details">
                    <div class="image">
                        <img src="{{url('/')}}/{{$student->image}}"/>
                    </div>
                    <ul>
                        <li>E-pasts:{{$student->email}}</li>
                        <li>Telefona numurs:
                            @if($student->number == null)
                            -
                            @else
                            {{$student->number}}
                            @endif
                        </li>
                    </ul>
                    <a href="{{url('/')}}/students/{{$student->id}}" class="student_profile">Apskatīt profilu</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
<button class="btn btn-default add_student" data-toggle="modal" data-target="#student_modal">Pievienot studentu</button>