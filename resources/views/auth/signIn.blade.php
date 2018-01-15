@extends('layout.master') @section('title', $title) @section('content')
<h1>{{$title}}</h1>

@include('components.socialButtons')


@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    @include('components.validationErrorMessage')
    <form action="sign-in" method="post">
        <p>
            <label for="">
                Email:
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            </label>
        </p>
        
        <p>
            <label for="">
                密碼:
                <input type="password" name="password" placeholder="密碼" value="{{ old('password') }}">
            </label>
        </p>
        
        <button type="submit">登入</button>

        {!! csrf_field() !!}
    </form>

</div>

@endsection