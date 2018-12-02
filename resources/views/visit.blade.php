@extends('master')

@section('title', 'Apmeklējums')

@section('main_content')
    <h2 class="visit_title">{{$year}}.Gada {{$date}}.{{$months_name}}</h2>
    <div class="lectures">
        <p>Patreiz neviena lekcija nav pievienota</p>
    </div>
    <button type="button" class="btn btn-default add" data-toggle="modal" data-target="#lecture_modal">Pievienot lekciju</button>
@stop

@section('modals')
    <div id="lecture_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="my-form">
                        <div class="form-group">
                            <label for="title">Lekcijas nosaukums:</label>
                            <input type="text" class="form-control" name="title" placeholder="Piem: Ievads PHP. Max garums - 20">
                            <span class="required glyphicon glyphicon-asterisk"><span>Obligāts<span></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Lekcijas apraksts:</label>
                            <textarea placeholder="Apraksts par lekciju. Piem:Ievads PHP funkcijās, mainīgo delarēšana ... Max garums - 300" id="description" maxlength="1000"></textarea>
                            <span class="required glyphicon glyphicon-asterisk"><span>Obligāts</span></span>
                        </div>
                        <div class="students">
                            <label for="description">Lekcijas apmeklējums:</label>
                            <span class="required glyphicon glyphicon-asterisk"><span>Obligāts</span></span>
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
                    <button type="button" class="btn btn-default my-btn add">Pievienot</button>
                </div>
            </div>
        </div>
    </div>
@stop