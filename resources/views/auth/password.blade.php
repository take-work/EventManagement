@extends('layout')

@section('title')
パスワード変更画面
@endsection

@section('content')

@section('subTitle')
  <h3>パスワードの再設定</h3>
@endsection

{!! Form::open() !!}
    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit">
            パスワードリセットリンクの送信
        </button>
    </div>
{!! Form::close() !!}
@endsection
