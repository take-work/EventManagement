<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        メールアドレス
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        パスワード
        <input type="password" name="password">
    </div>

    <div>
        パスワード確認
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">
            パスワードリセット
        </button>
    </div>
</form>
