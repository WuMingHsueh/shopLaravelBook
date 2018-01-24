
@extends('layout.master')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{$title}}</h1>
    @include('components.validationErrorMessage')

    <table border="1">
        <thead>
            <tr>
                <th>名稱</th>
                <th>照片</th>
                <th>價格</th>
                <th>剩餘數量</th>
            </tr>
        </thead>
        <tbody>
            @foreach($MerchandisePaginate as $merchandise)
            <tr>
                <td>
                    <a href="/shopLaravelBook/public/merchandise/{{ $merchandise->id }}">{{$merchandise->name}}</a>
                </td>
                <td>
                    <a href="/shopLaravelBook/public/merchandise/{{ $merchandise->id }}">
                        <img src="{{ $merchandise->photo or '/images/merchandise/default-merchandise.png' }}">
                    </a>
                </td>
                <td>
                    {{ $merchandise->price }}
                </td>
                <td>
                    {{ $merchandise->remain_count }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$MerchandisePaginate->links()}}
</div>
@endsection
