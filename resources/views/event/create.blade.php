@extends('layout')

@section('title')
イベント追加
@endsection

@section('content')

  <h3>イベント情報入力</h3>

  <hr>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>開始年月日</th>
        <th>終了年月日</th>
        <th>イベント名</th>
        <th>主催者</th>
        <th>準備費用</th>
        <th>データの登録</th>
      </tr>
    </thead>

  {!! Form::open() !!}
    <tbody>
      <tr>
        <td align="center">
          <input name="startDay" type="text" id="startDay" value="{{ Input::old('startDay') }}" />
        </td>

        <td align="center">
          <input name="endDay" type="text" id="endDay" value="{{ Input::old('endDay') }}" />
        </td>

        <td align="center">
          <input name="eventName" type="text" id="eventName" size="20" value="{{ Input::old('eventName') }}" />
        </td>

        <td align="center">
          <input name="host" type="text" id="host" size="20" value="{{ Input::old('host') }}" />
        </td>

        <td align="center">
          <input name="price" type="text" id="price" size="10" value="{{ Input::old('price') }}" />円
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" value="登録する" />
        </td>
      </tr>
    </tbody>
  {!! Form::close() !!}

  </table>

  <p>※ 開始日・終了日は8桁の半角数字で入力してください。<br>
  例：2016年1月1日 → 20160101</p>

  <hr>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection
