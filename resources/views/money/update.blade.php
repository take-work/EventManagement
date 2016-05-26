@extends('layout')

@section('title')
金額情報編集
@endsection

@section('content')

  <h3>金額情報編集</h3>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr>
        <th>100円玉</th>
        <th>500円玉</th>
        <th>1000円札</th>
        <th>5000円札</th>
        <th>10000円札</th>
        <th>データの更新</th>
      </tr>
    </thead>

  {!! Form::open() !!}
    <tbody>
      <tr>
        <td align="center">
          <input name="hundred" type="text" id="hundred" size="6" value="{{ $moneyList[0]->hundred }}" align="center" />
        </td>

        <td align="center">
          <input name="five_hundred" type="text" id="five_hundred" size="6" value="{{ $moneyList[0]->five_hundred }}" align="center" />
        </td>

        <td align="center">
          <input name="thousand" type="text" id="thousand" size="6" value="{{ $moneyList[0]->thousand }}" align="center" />
        </td>

        <td align="center">
          <input name="five_thousand" type="text" id="five_thousand" size="6" value="{{ $moneyList[0]->five_thousand }}" align="center" />
        </td>

        <td align="center">
          <input name="million" type="text" id="million" size="6" value="{{ $moneyList[0]->million }}" align="center" />
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $moneyList[0]->id }}">
          <input type="submit" value="更新する" />
        </td>
      </tr>
    </tbody>
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('/list') !!}">イベント一覧に戻る</a>
@endsection
