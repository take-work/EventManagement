@extends('layout')

@section('title')
スタッフ編集
@endsection

@section('content')

@section('subTitle')
  <h3>スタッフ編集</h3>
@endsection

  <table class="table table-responsive table-bordered">
    <tr class="active">
      @foreach ($staffContents as $contents => $content)
        <th><div class="text-center">{{ $content }}</div></th>
      @endforeach
      <th><div class="text-center">データの更新</div></th>
    </tr>

  {!! Form::open() !!}
  @foreach($staffs as $staff)
    <tbody>
      <tr>
        <td align="center">
          <input name="staffName" type="text" id="staffName"
            value="{{ $staff->name }}" />
        </td>

        <td align="center">
          <input name="position" type="text" id="position"
            value="{{ $staff->position }}" />
        </td>

        <td align="center">
          <input name="mail" type="text" id="mail"
            value="{{ $staff->mail }}" />
        </td>

        <td align="center">
          <input name="tel" type="text" id="tel"
            value="{{ $staff->tel }}" />
        </td>

        <td align="center">
          <input name="twitter" type="text" id="twitter"
            value="{{ $staff->twitter }}" />
        </td>

        <td align="center">
          <input name="experience" type="radio" id="experience1" value="1"
            @if ($staff->experience == "1") checked="checked" @endif />
            <label for="experience1">経験有</label><br>
          <input name="experience" type="radio" id="experience2" value="2" 
            @if ($staff->experience == "2") checked="checked" @endif />
            <label for="experience2">経験無</label>
        </td>

        <td align="center">
          <input name="rank" type="radio" id="rank1" value="1"
            @if ($staff->rank == "1") checked="checked" @endif />
            <label for="rank1">主催</label><br>
          <input name="rank" type="radio" id="rank2" value="2"
            @if ($staff->rank == "2") checked="checked" @endif />
            <label for="rank2">副主催</label><br>
          <input name="rank" type="radio" id="rank3" value="3" 
            @if ($staff->rank == "3") checked="checked" @endif />
            <label for="rank3">なし</label>
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $staff->id }}">
          <input type="submit" value="変更する" />
        </td>
      </tr>
    </tbody>
  @endforeach
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('/staffList', [$staffs[0]->event_id]) !!}">スタッフ一覧に戻る</a><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a><br>
@endsection
