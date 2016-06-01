@extends('layout')

@section('title')
イベント一覧
@endsection

@section('content')

@section('subTitle')
  <h3>イベント一覧</h3>
@endsection

  <a href="{!! url('create') !!}"><button type="button" class="btn btn-primary">新規作成</button></a><br>

  <hr>

  <div class="pull-right">
    {!! $events->render() !!}
  </div>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>開始年月日</th>
        <th>終了年月日</th>
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
    </thead>

  @foreach($events as $event)
    <tbody>
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
          ￥{{ number_format($event->price) }}
        </td>

        <td align="center">
          @if (! $moneyCounter[$event->id] == null )
            <a href="{!! url('/moneyUpdate', [$event->id]) !!}">￥{{ number_format($moneyCounter[$event->id]) }}</a>
          @else 
            <a href="{!! url('/moneyCreate', [$event->id]) !!}">￥0</a>
          @endif
        </td>

        <td align="center">
          @if ( $moneyList[$event->id] < 0 )
            <font color="red"><b>￥{{ number_format($moneyList[$event->id]) }}</b></font>
          @elseif ( $moneyList[$event->id] > 0 )
            ￥{{ number_format($moneyList[$event->id]) }}
          @else
            <font color="#1f90ff">￥0</font>
          @endif
        </td>

        <td align="center" class="col-md-1">
          <a href="{!! url('/update', [$event->id]) !!}"><input type="button" value="編集する"></a>
        </td>

        <td align="center" class="col-md-1">
          <a href="{!! url('/delete', [$event->id]) !!}"><input type="button" value="削除する"></a>
        </td>
      </tr>
    </tbody>
  @endforeach
  </table>

  <div class="pull-right">
    {!! $events->render() !!}
  </div>

  <hr>

  <p>※ スタッフの管理は「スタッフ数」から、サークルの管理は「サークル数」から、金額の管理は「合計売上」から行えます。</p>
@endsection
