@extends('layout')

@section('title')
スタッフ情報編集
@endsection

@section('content')

  <h3>スタッフ情報編集</h3>
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
    </tr>

    <tr>
      {!! Form::open() !!}
        <td align="center">
          {{ $staffs[0]->name }}
        </td>

        <td align="center">
          {{ $staffs[0]->position }}
        </td>

        <td align="center">
          {{ $staffs[0]->mail }}
        </td>

        <td align="center">
          {{ $staffs[0]->tel }}
        </td>

        <td align="center">
          {{ $staffs[0]->twitter }}
        </td>

        <td align="center">
          @if ( $staffs[0]->experience == 1 )
            <p>経験有</p>
          @else
            <p>経験無</p>
          @endif
        </td>

        <td align="center">
          @if ( $staffs[0]->rank == 1 )
            <p>主催</p>
          @elseif ( $staffs[0]->rank == 2 )
            <p>副主催</p>
          @elseif ( $staffs[0]->rank == 3 )
            <p>その他</p>
          @endif
        </td>

        <td align="center">
          <p>未実装</p>
        </td>

      </tr>
    {!! Form::close() !!}
  </table>

  <br><hr><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection