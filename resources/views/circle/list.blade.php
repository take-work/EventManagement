@extends('layout')

@section('title')
サークル一覧
@endsection

@section('content')

  <h3>サークル一覧</h3>

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
          <p>未実装</p>
        </td>

        <td align="center">
          <p>未実装</p>
        </td>
      </tr>
    @endforeach
  </table>
@endsection