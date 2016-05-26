@extends('layout')

@section('title')
サークル編集
@endsection

@section('content')

  <h3>サークル編集</h3>

  <table class="table table-responsive table-bordered">
    <tr>
      <th>ナンバー</th>
      <th>スペース</th>
      <th>サークル名</th>
      <th>代表者</th>
      <th>スタッフ数</th>
      <th>机の数</th>
      <th>椅子の数</th>
      <th>データの更新</th>
    </tr>

  {!! Form::open() !!}
  @foreach($circles as $circle)
    <tbody>
      <tr>
        <td align="center">
          <input name="number" type="text" id="number" value="{{ $circle->number }}" />
        </td>

        <td align="center">
          <input name="space" type="text" id="space" value="{{ $circle->space }}" />
        </td>

        <td align="center">
          <input name="circleName" type="text" id="circleName" maxlength="255" value="{{ $circle->circle_name }}" />
        </td>

        <td align="center">
          <input name="circleLeader" type="text" id="circleLeader" maxlength="255" value="{{ $circle->host }}" />
        </td>

        <td align="center">
          <input name="staff" type="text" id="staff" maxlength="10" size="6" value="{{ $circle->staff }}" />人
        </td>

        <td align="center">
          <input name="desk" type="text" id="desk" maxlength="10" size="6" value="{{ $circle->desk }}" />個
        </td>

        <td align="center">
          <input name="chair" type="text" id="chair" maxlength="10" size="6" value="{{ $circle->chair }}" />個
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $circle->id }}">
          <input type="submit" value="更新する" />
        </td>
      </tr>
    </tbody>
  @endforeach
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('circleList', [$circles[0]->event_id]) !!}">サークル一覧に戻る</a><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection
