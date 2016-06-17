@extends('layout')

@section('title')
スタッフ削除確認
@endsection

@section('content')

@section('subTitle')
  <h3>スタッフ削除確認</h3>
  <p>下記のデータを削除しますか?<br>
  よろしければ「データの削除」から「削除する」ボタンをクリックしてください</p>
@endsection

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        @foreach ($staffContents as $contents => $content)
          <th><div class="text-center">{{ $content }}</div></th>
        @endforeach
        <th><div class="text-center">データの削除</div></th>
      </tr>
    </thead>

  {!! Form::open() !!}
  @foreach($staffs as $staff)
    <tbody>
      @if ( $staff->experience == 1 )
        <tr class="something info">
      @else
        <tr class="something warning">
      @endif
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
    </tbody>
  @endforeach
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('/staffList', [$staffs[0]->event_id]) !!}">スタッフ一覧に戻る</a><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection
