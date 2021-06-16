@extends('layouts.main')
@section('title', 'My Likes')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>SOUQ: My Likes!</h1>
        <h4>{{ Auth()->user()->name }}</h4>
        <p>{{ Auth()->user()->email }}</p>
    </div>
    <div class="col-md-8">
        <div class="row">
        @foreach($ads as $product)
        <div class="col-4" style="margin-bottom: 20px;">
        <a href="{{ route('product', ['id'=>$product->ads['ad_id']]) }}" style="color:black;text-decoration:none">
        <div class="card">
            <div style="position: relative;">
                @if($product->ads->image->isNotEmpty())
                    <img src="{{ url('storage/' . $product->ads->image[0]['im_url']) }}" class="card-img-top"
                    style="width: 100%; height:150px;object-fit:cover;"
                        alt="...">
                 @else
                    <img src="{{ url('empty.jpeg') }}"  style="width: 100%; height:150px;object-fit:cover;"
                        alt="...">
                @endif
                <div style="position: absolute;top: 10px;right: 16px;background-color:black;color:white;padding:5px">RM 
                    {{ fmod($product->ads['ad_price'],1) !== 0.00 ? Str::limit(number_format($product->ads['ad_price'], 2),8): number_format($product->ads['ad_price']) }}</div>
                <form action="{{ route('unlikes') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $product->like_id }}" name="likeid">
                    <button type="submit" class="likebtn like-bigger liked" style="left: 30px; top:20px">
                        <i class="far fa-heart" style="vertical-align: text-top;"></i>
                    </button>
                </form>
            </div>  
            
            <div class="card-body">
                <p class="card-text hoverline">{{ Str::limit($product->ads['ad_title'], 25) }}</p>
            </div>
        </div>
        </a>
        </div>
        @endforeach
        {{ $ads->links() }}

        </div>
       
    </div>
</div>

@endsection