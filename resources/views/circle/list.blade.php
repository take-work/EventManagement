@extends('layout')

@section('title')
サークル一覧
@endsection

@section('content')

  <h3>サークル一覧</h3>
  <a href="{!! url('circleCreate', [$id]) !!}">新規作成</a><br><br>

  <hr><br>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>ナンバー</th>
      <th>スペース</th>
      <th>サークル名</th>
      <th>代表者</th>
      <th>参加人数</th>
      <th>机の数</th>
      <th>椅子の数</th>
      <th>データの編集</th>
      <th>データの削除</th>
    </tr>

    @foreach($circles as $circle)
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

        <td align="center">
          <a href="{!! url('/circleUpdate', [$circle->id]) !!}"><input type="button" value="編集する"></a>
        </td>

        <td align="center">
          <a href="{!! url('/circleDelete', [$circle->id]) !!}"><input type="button" value="削除する"></a>
        </td>
      </tr>
    @endforeach
  </table>

  <br><hr><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection
