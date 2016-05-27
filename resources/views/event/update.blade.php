@extends('layout')

@section('title')
イベント編集
@endsection

@section('content')

  <h3>イベント編集</h3>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>開始年月日</th>
        <th>終了年月日</th>
        <th>イベント名</th>
        <th>主催者</th>
        <th>準備費用</th>
        <th>データの変更</th>
      </tr>
    </thead>

  {!! Form::open() !!}
  @foreach($events as $event)
    <tbody>
      <tr>
        <td align="center">
          <input name="startDay" type="text" id="startYear" size="16"
            value="@if(!empty($errors)){{ Input::old('startDay') }}@else{{ $event->startDay }}@endif" />
        </td>

        <td align="center">
          <input name="endDay" type="text" id="endDay" size="16"
            value="@if(!empty($errors)){{ Input::old('endDay') }}@else{{ $event->endDay }}@endif" />
        </td>

        <td align="center">
          <input name="eventName" type="text" id="eventName"
            value="@if(!empty($errors)){{ Input::old('eventName') }}@else{{ $event->name }}@endif" />
        </td>

        <td align="center">
          <input name="host" type="text" id="host"
            value="@if(!empty($errors)){{ Input::old('host') }}@else{{ $event->host }}@endif" />
        </td>

        <td align="center">
          <input name="price" type="text" id="price" size="10"
            value="@if(!empty($errors)){{ Input::old('price') }}@else{{ $event->price }}@endif" />円
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $event->id }}">
          <input type="submit" value="変更する" />
        </td>
      </tr>
    </tbody>
  @endforeach
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection
