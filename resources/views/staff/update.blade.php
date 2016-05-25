@extends('layout')

@section('title')
スタッフ情報編集
@endsection

@section('content')

  <h3>スタッフ情報編集</h3>

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
      <th>データの更新</th>
    </tr>

    <tr>
      {!! Form::open() !!}
        <td align="center">
          <input name="name" type="text" id="name" value="{{ $staffs[0]->name }}" />
        </td>

        <td align="center">
          <input name="position" type="text" id="position" value="{{ $staffs[0]->position }}" />
        </td>

        <td align="center">
          <input name="mail" type="text" id="mail" value="{{ $staffs[0]->mail }}" />
        </td>

        <td align="center">
          <input name="tel" type="text" id="tel" value="{{ $staffs[0]->tel }}" />
        </td>

        <td align="center">
          <input name="mail" type="text" id="mail" value="{{ $staffs[0]->twitter }}" />
        </td>

        <td align="center">
          <input name="experience" type="radio" id="experience1" value="1" <?php if ($staffs[0]->experience == 1) { ?> checked="checked" <?php } ?> /><label for="experience1">経験有</label><br>
          <input name="experience" type="radio" id="experience2" value="2" <?php if ($staffs[0]->experience == 2) { ?> checked="checked" <?php } ?> /><label for="experience2">経験無</label>
        </td>

        <td align="center">
          <input name="rank" type="radio" id="rank1" value="1" <?php if ($staffs[0]->rank == 1) { ?> checked="checked" <?php } ?>/><label for="rank1">主催</label><br>
          <input name="rank" type="radio" id="rank2" value="2" <?php if ($staffs[0]->rank == 2) { ?> checked="checked" <?php } ?>/><label for="rank2">副主催</label><br>
          <input name="rank" type="radio" id="rank3" value="3" <?php if ($staffs[0]->rank == 3) { ?> checked="checked" <?php } ?>/><label for="rank3">なし</label>
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $staffs[0]->id }}">
          <input type="submit" value="変更する" />
        </td>

      </tr>
    {!! Form::close() !!}
  </table>

  <br><hr><br>
  <a href="{!! url('/staffList', [$staffs[0]->event_id]) !!}">スタッフ一覧に戻る</a><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br>
@endsection