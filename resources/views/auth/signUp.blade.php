 @extends('layout.master') @section('title', $title) @section('content')
<div class="container">
    <h1>{{$title}}</h1>

    @include('components.validationErrorMessage')
    <form action="sign-up" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p>
            <label>
                暱稱:
                <input type="text" name="nickname" placeholder="請輸入暱稱" value="{{ old('nickname') }}">
            </label>
        </p>
        <p>
            <label>
                Email:
                <input type="text" name="email" placeholder="請輸入信箱" value="{{ old('email') }}">
            </label>
        </p>
        <p>
            <label>
                密碼:
                <input type="password" name="password" placeholder="請輸入密碼" value="{{ old('password') }}">
            </label>
        </p>
        <p>
            <label>
                確認密碼:
                <input type="password" name="password_confirmation" placeholder="請再次確認密碼" value="{{ old('password_confirmation') }}">
            </label>
        </p>
        <p>
            <label>
                帳號類型:
                <input type="radio" name="type" value="G" checked>一般會員
                <input type="radio" name="type" value="A">管理者
            </label>
        </p>
        <button type="submit">註冊</button>
    </form>
</div>
@endsection