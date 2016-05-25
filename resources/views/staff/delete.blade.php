@extends('layout')

@section('title')
イベント削除確認
@endsection

@section('content')

  <h3>イベント一覧</h3>
  <p>下記のデータを削除しますか?<br>
  よろしければ「データの削除」から「削除する」ボタンをクリックしてください</p>

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
      <th>データの削除</th>
    </tr>

    {!! Form::open() !!}
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
            @if ( $staff->experience == 1 )
              <p>経験有</p>
            @else
              <p>経験無</p>
            @endif
          </td>

          <td align="center">
            @if ( $staff->rank == 1 )
              <p>主催</p>
            @elseif ( $staff->rank == 2 )
              <p>副主催</p>
            @elseif ( $staff->rank == 3 )
              <p>その他</p>
            @endif
          </td>

          <td align="center">
            <input type="hidden" name="id" value="{{ $staff->id }}">
            <input type="submit" value="削除する" />
          </td>
        </tr>
      @endforeach
    {!! Form::close() !!}
  </table>

  <br><hr><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection
