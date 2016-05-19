
@extends('layout')

{!! Form::open() !!}
  <div class="form-group">
    {!! Form::label('startDay', '開始日:') !!}
    {!! Form::input('date', 'startDay', date('Y-m-d'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('endDay', '終了日:') !!}
    {!! Form::input('date', 'endDay', date('Y-m-d'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('eventName', 'イベント名:') !!}
    {!! Form::text('eventName', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('host', '主催者:') !!}
    {!! Form::text('host', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('price', '準備費用:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
  </div><br/>
  <div class="form-group">
    {!! Form::submit('登録する', ['class' => 'btn btn-primary form-control']) !!}
  </div>
{!! Form::close() !!}
