@extends('layout.master')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{$title}}</h1>
    @include('components.validationErrorMessage')
    <table class="table" border="1">
        <tr>
            <th>商品名稱</th>
            <th>圖片</th>
            <th>單價</th>
            <th>數量</th>
            <th>總金額</th>
            <th>購買時間</th>
        </tr>
        @foreach($transactionPaginate as $transaction)
        <tr>
            <td>
                <a href="/shopLaravelBook/public/merchandise/{{ $transaction->Merchandise->id }}">
                    {{$transaction->Merchandise->name}}
                </a>
            </td>
            <td>
                <a href="/shopLaravelBook/public/merchandise/{{ $transaction->Merchandise->id }}">
                    <img src="{{ $transaction->Merchandise->photo or '/images/merchandise/default-merchandise.png' }}">
                </a>
            </td>
            <td>{{$transaction->Merchandise->price}}</td>
            <td>{{$transaction->buy_count}}</td>
            <td>{{$transaction->total_price}}</td>
            <td>{{$transaction->created_at}}</td>
        </tr>
        @endforeach
    </table>
    {{ $transactionPaginate->links() }}
</div>
@endsection