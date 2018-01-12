@extends('layout.master') @section('title', $title) @section('content')
<h1>{{$title}}</h1>

@include('components.socialButtons')

Email:
<input type="text" name="email" placeholder="Email">

密碼:
<input type="password" name="password" placeholder="密碼">
@endsection