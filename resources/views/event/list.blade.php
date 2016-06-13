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

  {!! Form::open() !!}
    <table class="table table-responsive table-bordered">
      <tr>
        <th>
          <input type="radio" name="searchContents" value="startDay" id="startDay"><label for="startDay">開始日</label> &nbsp;
          <input type="radio" name="searchContents" value="endDay" id="endDay"><label for="endDay">終了日</label> &nbsp;
          <input type="radio" name="searchContents" value="name" id="name"><label for="name">イベント名</label> &nbsp;
          <input type="radio" name="searchContents" value="host" id="host"><label for="host">主催者</label>
        </th>
        <td>
          <input type="text" name="searchText">
        </td>
        <td>
          <input type="submit" value="検索">
        </td>
      </tr>
    </table>
  {!! Form::close() !!}

  <div class="pull-right">
    {!! $events->render() !!}
  </div>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        @foreach ($eventContents as $contents => $content)
          <th><div class="text-center">{{ $content }}</div></th>
        @endforeach
        <th><div class="text-center">データの編集</div></th>
        <th><div class="text-center">データの削除</div></th>
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
