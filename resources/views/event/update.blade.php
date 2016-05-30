@extends('layout')

@section('title')
イベント編集
@endsection

@section('content')

@section('subTitle')
  <h3>イベント編集</h3>
@endsection

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
          <?php $start = str_replace("/", "", "$event->startDay"); ?>
          <input name="startDay" type="text" id="startYear" size="16"
            value="{{ $start }}" />
        </td>

        <td align="center">
          <?php $end = str_replace("/", "", "$event->endDay"); ?>
          <input name="endDay" type="text" id="endDay" size="16"
            value="{{ $end }}" />
        </td>

        <td align="center">
          <input name="eventName" type="text" id="eventName"
            value="{{ $event->name }}" />
        </td>

        <td align="center">
          <input name="host" type="text" id="host"
            value="{{ $event->host }}" />
        </td>

        <td align="center">
          <input name="price" type="text" id="price" size="10"
            value="{{ $event->price }}" />円
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
