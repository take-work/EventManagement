@extends('layout')

@section('title')
サークル登録
@endsection

@section('content')

@section('subTitle')
  <h3>サークル情報入力</h3>
@endsection

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        @foreach ($circleContents as $contents => $content)
          <th><div class="text-center">{{ $content }}</div></th>
        @endforeach
        <th><div class="text-center">データの登録</div></th>
      </tr>
    </thead>

  {!! Form::open() !!}
    <tbody>
      <tr>
        <td align="center">
          <input name="number" type="text" id="number" value="{{ Input::old('number') }}" />
        </td>

        <td align="center">
          <input name="space" type="text" id="space" value="{{ Input::old('space') }}" />
        </td>

        <td align="center">
          <input name="circleName" type="text" id="circleName" value="{{ Input::old('circleName') }}" />
        </td>

        <td align="center">
          <input name="circleLeader" type="text" id="circleLeader" value="{{ Input::old('circleLeader') }}" />
        </td>

        <td align="center">
          <input name="staff" type="text" id="staff" maxlength="10" size="6" value="{{ Input::old('staff') }}" />人
        </td>

        <td align="center">
          <input name="desk" type="text" id="desk" maxlength="10" size="6" value="{{ Input::old('desk') }}" />個
        </td>

        <td align="center">
          <input name="chair" type="text" id="chair" maxlength="10" size="6" value="{{ Input::old('chair') }}" />個
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
  <a href="{!! url('circleList', [$id]) !!}">サークル一覧に戻る</a><br>
  <a href="{!! url('/list') !!}">イベント一覧に戻る</a>
@endsection
