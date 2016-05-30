@extends('layout')

@section('title')
サークル一覧
@endsection

@section('content')

@section('subTitle')
  <h3>サークル一覧</h3>
@endsection

  <a href="{!! url('circleCreate', [$id]) !!}"><button type="button" class="btn btn-primary">新規作成</button></a><br>

  <hr>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>ナンバー</th>
        <th>スペース</th>
        <th>サークル名</th>
        <th>代表者</th>
        <th>参加人数</th>
        <th>机の数(総数：{{ $desk }}個)</th>
        <th>椅子の数(総数：{{ $chair }}個)</th>
        <th>データの編集</th>
        <th>データの削除</th>
      </tr>
    </thead>

  @foreach($circles as $circle)
    <tbody>
      <tr>
        <td align="center">
          {{ $circle->number }}
        </td>

        <td align="center">
          {{ $circle->space }}
        </td>

        <td align="center">
          {{ $circle->circle_name }}
        </td>

        <td align="center">
          {{ $circle->host }}
        </td>

        <td align="center">
          {{ $circle->staff }}
        </td>

        <td align="center">
          {{ $circle->desk }}
        </td>

        <td align="center">
          {{ $circle->chair }}
        </td>

        <td align="center" class="col-md-1">
          <a href="{!! url('/circleUpdate', [$circle->id]) !!}"><input type="button" value="編集する"></a>
        </td>

        <td align="center" class="col-md-1">
          <a href="{!! url('/circleDelete', [$circle->id]) !!}"><input type="button" value="削除する"></a>
        </td>
      </tr>
    </tbody>
  @endforeach
  </table>

  <hr>

  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection
