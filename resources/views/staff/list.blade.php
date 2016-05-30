@extends('layout')

@section('title')
スタッフ一覧
@endsection

@section('content')

@section('subTitle')
  <h3>スタッフ一覧</h3>
@endsection

  <a href="{!! url('staffCreate', [$id]) !!}"><button type="button" class="btn btn-primary">新規作成</button></a><br>

  <hr>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
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
    </thead>

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

        <td align="center" class="col-md-1">
          <a href="{!! url('/staffUpdate', [$staff->id]) !!}"><input type="button" value="編集する"></a>
        </td>

        <td align="center" class="col-md-1">
          <a href="{!! url('/staffDelete', [$staff->id]) !!}"><input type="button" value="削除する"></a>
        </td>
      </tr>
    </tbody>
  @endforeach
  </table>

  <hr>

  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection
