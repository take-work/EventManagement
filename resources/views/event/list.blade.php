@extends('layout')

@section('title')
イベント一覧
@endsection

@section('content')

  <h3>イベント一覧</h3>
  <a href="{!! url('create') !!}">新規作成</a><br><br>

  <hr><br>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tbody>
      <tr>
        <th>開始日</th>
        <th>終了日</th>
        <th>イベント名</th>
        <th>主催者</th>
        <th>スタッフ数</th>
        <th>サークル数</th>
        <th>準備費用</th>
        <th>合計売上</th>
        <th>純利益</th>
        <th>データの編集</th>
        <th>データの削除</th>
      </tr>

      @foreach($events as $event)
        <tr>
          <td align="center">
            {{ $event->startDay }}
          </td>

          <td align="center">
            {{ $event->endDay }}
          </td>

          <td align="center">
            {{ $event->name }}
          </td>

          <td align="center">
            {{ $event->host }}
          </td>

          <td align="center">
            <a href="{!! url('/staffList', [$event->id]) !!}">{{ $staffCounter[$event->id][0]->counter }}</a>
          </td>

          <td align="center">
            <a href="{!! url('/circleList', [$event->id]) !!}">{{ $circleCounter[$event->id][0]->counter }}</a>
          </td>

          <td align="center">
            {{ $event->price }}
          </td>

          <td align="center">
            <a href="{!! url('/moneyCreate', [$event->id]) !!}">金額管理</a>
          </td>

          <td align="center">
            <p>未実装</p>
          </td>

          <td align="center">
            <p>未実装</p>
          </td>

          <td align="center">
            <p>未実装</p>
          </td>
  @endforeach
@endsection