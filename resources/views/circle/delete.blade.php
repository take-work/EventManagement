@extends('layout')

@section('title')
サークル削除確認
@endsection

@section('content')

@section('subTitle')
  <h3>サークル削除確認</h3>
  <p>下記のデータを削除しますか?<br>
  よろしければ「データの削除」から「削除する」ボタンをクリックしてください</p>
@endsection

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        @foreach ($circleContents as $contents => $content)
          <th><div class="text-center">{{ $content }}</div></th>
        @endforeach
        <th><div class="text-center">データの削除</div></th>
      </tr>
    </thead>

  {!! Form::open() !!}
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

        <td align="center">
          <input type="hidden" name="id" value="{{ $circle->id }}">
          <input type="submit" value="削除する">
        </td>
      </tr>
    </tbody>
  @endforeach
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('circleList', [$circles[0]->event_id]) !!}">サークル一覧に戻る</a><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection
