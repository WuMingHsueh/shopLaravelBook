@extends('layout.master')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{$title}}</h1>
    @include('components.validationErrorMessage')
    <form action="../{{ $Merchandise->id }}" method="post" enctype="multipart/form-data">
        
        {{ method_field('PUT') }}
        <input type="hidden" name="_method" value="PUT">
        <p>
            <label>
                商品狀態:
                <select name="status">
                    <option value="C" @if(old('status', $Merchandise->status) == 'C') selected @endif>
                        建立中
                    </option>
                    <option value="S" @if(old('status', $Merchandise->status) == 'S') selected @endif>
                        可販售
                    </option>
                </select>
            </label>
        </p>
        <p>
            <label>
                商品名稱:
                <input type="text" name="name" placeholder="商品名稱" value="{{ old('name', $Merchandise->name)}}">
            </label>
        </p>
        <p>
            <label>
                商品英文名稱:
                <input type="text" name="name_en" placeholder="商品英文名稱" value="{{ old('name_en', $Merchandise->name_en)}}">
            </label>
        </p>
        <p>
            <label>
                商品介紹:
                <input type="text" name="introduction" placeholder="商品介紹" value="{{ old('introduction', $Merchandise->introduction)}}">
            </label>
        </p>
        <p>
            <label>
                商品英文介紹:
                <input type="text" name="introduction_en" placeholder="商品英文介紹" value="{{ old('introduction_en', $Merchandise->introduction_en)}}">
            </label>
        </p>
        <p>
            <label>
                商品照片:
                <input type="file" name="photo" placeholder="商品照片">
                <img src="{{ $Merchandise->photo or '/assets/images/default-merchandise.png' }}" alt="">
            </label>
        </p>
        <p>
            <label>
                商品價格:
                <input type="text" name="price" placeholder="商品價格" value="{{ old('price', $Merchandise->price) }}">
            </label>
        </p>
        <p>
            <label>
                商品剩餘數量:
                <input type="text" name="remain_count" placeholder="商品剩餘數量" value="{{ old('remain_count', $Merchandise->remain_count) }}">
            </label>
        </p>
        

        <button type="submit" class="btn btn-default">更新商品資訊</button>
        
        {{ csrf_field() }}
    </form>
</div>
@endsection