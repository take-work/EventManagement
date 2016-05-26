@extends('layout')

@section('title')
スタッフ登録
@endsection

@section('content')

  <h3>スタッフ情報入力</h3>

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
        <th>データの登録</th>
      </tr>
    </thead>

  {!! Form::open() !!}
    <tbody>
      <tr>
        <td align="center">
          <input name="staffName" type="text" id="staffName" />
        </td>

        <td align="center">
          <input name="position" type="text" id="position" />
        </td>

        <td align="center">
          <input name="mail" type="text" id="mail" maxlength="255" />
        </td>

        <td align="center">
          <input name="tel" type="text" id="tel" maxlength="255" />
        </td>

        <td align="center">
          <input name="twitter" type="text" id="twitter" maxlength="10" />
        </td>

        <td align="center">
          <input name="experience" type="radio" id="experience1" value="1" /><label for="experience1">経験有</label><br>
          <input name="experience" type="radio" id="experience2" value="2" /><label for="experience2">経験無</label>
        </td>

        <td align="center">
          <input name="rank" type="radio" id="rank1" value="1" /><label for="rank1">主催</label><br>
          <input name="rank" type="radio" id="rank2" value="2" /><label for="rank2">副主催</label><br>
          <input name="rank" type="radio" id="rank3" value="3" /><label for="rank3">なし</label>
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $id }}">
          <input type="submit" value="登録する" />
        </td>
      </tr>
    </tbody>
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('/staffList', [$id]) !!}">スタッフ一覧に戻る</a><br>
  <a href="{!! url('/list') !!}">イベント一覧に戻る</a>
@endsection
