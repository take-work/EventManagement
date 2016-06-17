@extends('layout')

@section('title')
サークル一覧
@endsection

@section('content')

@section('subTitle')
  <h3>サークル一覧</h3>
@endsection

  <a href="{!! url('circleCreate', [$id]) !!}"><button type="button" class="btn btn-primary">新規作成</button></a> &nbsp;
  <a href="{!! url('circlePdf', [$id]) !!}"><button type="button" class="btn btn-primary">PDFで保存</button></a>

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
            <input type="radio" name="searchContents" value="number" id="number"><label for="number">ナンバー</label> &nbsp;
            <input type="radio" name="searchContents" value="space" id="space"><label for="space">スペース</label> &nbsp;
            <input type="radio" name="searchContents" value="circle_name" id="circle_name"><label for="circle_name">サークル名</label> &nbsp;
            <input type="radio" name="searchContents" value="host" id="host"><label for="host">代表者</label>
          </td>
          <td align="center">
            <input type="text" name="searchText">
          </td>
          <td align="center">
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="submit" value="検索する">
          </td>
          <td align="center">
            <a href="{!! url('circleList', $id) !!}"><input type="button" value="検索をリセットする"></a>
          </td>
        </tr>
      </tbody>
    </table>
  {!! Form::close() !!}

  <hr>

  <div class="pull-right">
    {!! $circles->render() !!}
  </div>

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th><div class="text-center">ナンバー</th>
        <th><div class="text-center">スペース</th>
        <th><div class="text-center">サークル名</th>
        <th><div class="text-center">代表者</th>
        <th><div class="text-center">参加人数</th>
        <th><div class="text-center">机の数(総数：{{ $desk }}個)</th>
        <th><div class="text-center">椅子の数(総数：{{ $chair }}個)</th>
        <th><div class="text-center">データの編集</th>
        <th><div class="text-center">データの削除</th>
      </tr>
    </thead>

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

        <td align="center" class="col-md-1">
          <a href="{!! url('/circleUpdate', [$circle->id]) !!}"><input type="button" value="編集する"></a>
        </td>

        <td align="center" class="col-md-1">
          <a href="{!! url('/circleDelete', [$circle->id]) !!}"><input type="button" value="削除する"></a>
        </td>
      </tr>
    </tbody>
  @endforeach
  </table>

  <hr>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br><br>

@endsection
