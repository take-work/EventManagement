@extends('layout')

@section('title')
スタッフ一覧
@endsection

@section('content')

  <h3>スタッフ一覧</h3>
  <a href="{!! url('staffCreate') !!}">新規作成</a><br><br>

  <hr><br>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>氏名(HN)</th>
      <th>担当 / 持ち場</th>
      <th>メールアドレス</th>
      <th>電話番号</th>
      <th>Twitter</th>
      <th>経験</th>
      <th>役職</th>
      <th>データの編集</th>
      <th>データの削除</th>
    </tr>

    @foreach($staffs as $staff)
      <tr>
        <td align="center">
          {{ $staff->name }}
        </td>

        <td align="center">
          {{ $staff->position }}
        </td>

        <td align="center">
          {{ $staff->mail }}
        </td>

        <td align="center">
          {{ $staff->tel }}
        </td>

        <td align="center">
          {{ $staff->twitter }}
        </td>

        <td align="center">
          {{ $staff->experience }}
        </td>

        <td align="center">
          {{ $staff->rank }}
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