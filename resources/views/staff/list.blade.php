@extends('layout')

@section('title')
スタッフ一覧
@endsection

@section('content')

@section('subTitle')
  <h3>スタッフ一覧</h3>
@endsection

  <a href="{!! url('staffCreate', [$id]) !!}"><button type="button" class="btn btn-primary">新規作成</button></a> &nbsp;
  <a href="{!! url('staffPdf', [$id]) !!}"><button type="button" class="btn btn-primary">PDFで保存</button></a>

  <hr>

  {!! Form::open() !!}
    <table class="table table-responsive table-bordered">
      <thead>
        <tr>
          <td align="center">検索項目</td>
          <td align="center">検索ワード</td>
          <td align="center">検索</td>
          <td align="center">リセット</td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td align="center">
            <input type="radio" name="searchContents" value="name" id="name"><label for="name">スタッフ名</label> &nbsp;
            <input type="radio" name="searchContents" value="position" id="position"><label for="position">担当 / 持ち場</label> &nbsp;
            <input type="radio" name="searchContents" value="twitter" id="twitter"><label for="twitter">Twitter</label>
          </td>
          <td align="center">
            <input type="text" name="searchText">
          </td>
          <td align="center">
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="submit" value="検索する">
          </td>
          <td align="center">
            <a href="{!! url('staffList', $id) !!}"><input type="button" value="検索をリセットする"></a>
          </td>
        </tr>
      </tbody>
    </table>
  {!! Form::close() !!}

  <hr>

  <div class="pull-right">
    {!! $staffs->render() !!}
  </div>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        @foreach ($staffContents as $contents => $content)
          <th><div class="text-center">{{ $content }}</div></th>
        @endforeach
        <th><div class="text-center">データの編集</div></th>
        <th><div class="text-center">データの削除</div></th>
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
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>

@endsection
