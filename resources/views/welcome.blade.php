@extends('layouts.main')
@section('title', 'Welcome to SOUQ')

@section('content')
<div class="row">
    <div class="col-md-4">
    <h1>SOUQ</h1>
    <h4>A marketplace for IIUM Community</h4>
    <p>Students and staff can post their ads free of charge. No more paying for advertisements</p>
    </div>
    <div class="col-md-8">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="https://eshop.iium.edu.my/product/iium-mask-black-557-2/">
                    <img src="https://eshop.iium.edu.my/wp-content/uploads/slider2/slider-mask.jpeg" class="d-block w-100" alt="...">
                    </a>
                
                </div>
                <div class="carousel-item">
                <img src="https://eshop.iium.edu.my/wp-content/uploads/2021/05/Sampul-Duit-Raya-Available.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
    </div>
</div>


<div class="row" style="margin-top: 20px;">
    <h2>Browse Categories</h2>
    <p>From books, stationaries to laptop and beyonds</p>
    <div class="horizontal-scrollable row flex-row flex-nowrap mt-4 pb-4 pt-2">
    @foreach($cats as $cat)
        <div class="col-5 text-center" style="padding: 5px;width:200px">
            <a href="{{ route('listing') . '?category=' . $cat->cat_id }}">
            <img src="{{ url($cat->cat_image) }}" class="card-img-top" alt="{{ $cat->cat_sname}}" style="height: 50px;width:50px;">
            </a>
            <p class="card-text">{{ $cat->cat_name }}</p>
        </div>
    @endforeach
        <div class="col-5 text-center" style="padding: 5px;width:200px">
            <a href="{{ route('listing') }}">
            <img src="{{ url('more.png') }}" class="card-img-top" alt="More" style="height: 50px;width:50px;">
            </a>
            <p class="card-text">All Categories</p>
        </div>
    </div>
</div>

<div style="margin-top: 30px;margin-bottom:20px">
    <h2>New Ads</h2>
    <p>Get the latest listing</p>
    <div class="horizontal-scrollable row flex-row flex-nowrap mt-4 pb-4 pt-2">
            @foreach($products as $product)
                <div class="col-5" style="padding: 5px;width:200px">
                    <div style="position:relative">
                    <a href="{{ route('product', ['id'=>$product->ad_id]) }}">
                    @if($product->image->isNotEmpty())
                    <img src="{{ url('storage/' . $product->image[0]['im_url']) }}" class="rounded float-left" style="width: 100%; height:150px;object-fit:cover;"
                        alt="...">
                    @else
                    <img src="{{ url('empty.jpeg') }}" class="rounded float-left" style="width: 100%; height:150px;object-fit:cover;"
                        alt="...">
                    @endif
                    </a>
                    @if($product->sold == true)
                    <div style="position: absolute;top: 0px;right: 0px;background-color:red;color:white;padding:5px">Sold</div>
                    @endif
                    <div style="position: absolute;top: 8px;left: 16px;background-color:black;color:white;padding:5px">RM 
                    {{ fmod($product->ad_price,1) !== 0.00 ? number_format($product->ad_price, 2): number_format($product->ad_price) }}</div>
                    <div style="position: absolute;bottom: 0px;left:0px;background-color:#efefefb3;padding:5px; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;width:100%">{{$product->ad_title}}</div>
                    </div>
                </div>
            @endforeach
    </div>
    
</div>
@endsection