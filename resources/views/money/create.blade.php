@extends('layout')

@section('title')
金額情報入力
@endsection

@section('content')

  <h3>金額情報入力</h3>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>100円玉</th>
        <th>500円玉</th>
        <th>1000円札</th>
        <th>5000円札</th>
        <th>10000円札</th>
        <th>データの登録</th>
      </tr>
    </thead>

  {!! Form::open() !!}
    <tbody>
      <tr>
        <td align="center">
          <input name="hundred" type="text" id="hundred" size="6" align="center" />
        </td>

        <td align="center">
          <input name="five_hundred" type="text" id="five_hundred" size="6" align="center" />
        </td>

        <td align="center">
          <input name="thousand" type="text" id="thousand" size="6" align="center" />
        </td>

        <td align="center">
          <input name="five_thousand" type="text" id="five_thousand" size="6" align="center" />
        </td>

        <td align="center">
          <input name="million" type="text" id="million" size="6" align="center" />
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $id }}">
          <input type="submit" value="登録する" />
        </td>
    </tr>
  </tbody>
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('/list') !!}">イベント一覧に戻る</a>
@endsection
