@extends('layout.master')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{$title}}</h1>
    @include('components.validationErrorMessage')
    <table border="1">
        <tr>
            <th>名稱</th>
            <td>{{ $merchandise->name }}</td>
        </tr>
        <tr>
            <th>照片</th>
            <td>
                <img src="{{$merchandise->photo or '/images/merchandise/default-merchandise.png'}}">
            </td>
        </tr>
        <tr>
            <th>價格</th>
            <td>
                {{$merchandise->price}}
            </td>
        </tr>
        <tr>
            <th>剩餘數量</th>
            <td>{{$merchandise->remain_count}}</td>
        </tr>
        <tr>
            <th>介紹</th>
            <td>
                {{$merchandise->introduction}}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                <form action="/shopLaravelBook/public/merchandise/{{ $merchandise->id }}/buy" method="post">
                    {{csrf_field()}}
                    <select name="buyCount">
                        @for ($i = 1; $i <= $merchandise->remain_count ; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit">購買</button>
                </form>
                </center>
            </td>
        </tr>
    </table>
</div>
@endsection