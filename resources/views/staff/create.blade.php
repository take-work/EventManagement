@extends('layout')

@section('title')
スタッフ追加
@endsection

@section('content')
  <h3>スタッフ情報入力</h3>

  <hr><br>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>氏名(HN)</th>
      <th>担当 / 持ち場</th>
      <th>メールアドレス</th>
      <th>電話番号</th>
      <th>Twitter</th>
      <th>経験</th>
      <th>役職</th>
      <th>データの登録</th>
    </tr>

    <tr>
      {!! Form::open() !!}
        <td align="center">
          <input name="name" type="text" id="name"/>
        </td>

        <td align="center">
          <input name="position" type="text" id="position"/>
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
          <input type="submit" value="登録する" />
        </td>
      {!! Form::close() !!}
    </tr>
  </table>
@endsection