@extends('layout')

@section('title')
スタッフ一覧
@endsection

@if (Session::has('flash_message'))
  <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
@endif

@section('content')

  <h3>スタッフ一覧</h3>
  <a href="{!! url('staffCreate', [$id]) !!}"><button type="button" class="btn btn-primary">新規作成</button></a><br><br>

  <table class="table table-responsive table-bordered">
    <tr>
      <th><div class="text-center">氏名(HN)</div></th>
      <th><div class="text-center">担当 / 持ち場</div></th>
      <th><div class="text-center">メールアドレス</div></th>
      <th><div class="text-center">電話番号</div></th>
      <th><div class="text-center">Twitter</div></th>
      <th><div class="text-center">経験</div></th>
      <th><div class="text-center">役職</div></th>
      <th><div class="text-center">データの編集</div></th>
      <th><div class="text-center">データの削除</div></th>
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
          <a href="{!! url('/staffUpdate', [$staff->id]) !!}"><input type="button" value="編集する"></a>
        </td>

        <td align="center">
          <a href="{!! url('/staffDelete', [$staff->id]) !!}"><input type="button" value="削除する"></a>
        </td>
      </tr>
    @endforeach
  </table>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>
@endsection