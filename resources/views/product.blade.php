@extends('layouts.main')
@section('title', $product->ad_title)
@if($product->image->isNotEmpty())
    @section('image',  url('storage/' . $product->image[0]->im_url) )
@else
    @section('image',  url('empty.jpeg') )
@endif
@section('description', $product->ad_title . ' ('. $product->category['cat_name'] .')')
@section('content')
<div class="row">
    <div class="col-md-12" style="font-size: small;">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('listing') . '?category=' . $product->cat_id }}">{{ $product->category['cat_name']}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->ad_title, 30) }}</li>
        </ol>
        </nav>
    </div>
    <div class="col-md-8">
    <h2>{{ $product->ad_title }} </h2>
    <p>
    <small>
        @if($product->created_at->isToday())
            {{ 'Today, ' . Carbon\Carbon::parse($product->created_at)->format('h:iA')}}
        @else
            Listed on {{ Carbon\Carbon::parse($product->created_at)->format('M d, h:iA / Y') }}
        @endif
        | <span style="font-size:small"><i class="far fa-heart"></i> {{$totallike}} likes</span>
    </small>
    </p>
    @if($product->image->isNotEmpty())
    <div id="carouselSouq" class="carousel slide" data-bs-ride="carousel" style="position:relative">
    
        <div class="carousel-indicators" style="background-color: #00000063;">
        @foreach($product->image as $image)
            <button type="button" data-bs-target="#carouselSouq" data-bs-slide-to="{{$loop->index}}" class="{{ $loop->first ? 'active':'' }}" aria-current="{{ $loop->first ? 'true':'' }}"></button>
        @endforeach
        </div>
        <div class="carousel-inner" style="height: 450px;object-fit:contain; background-color:#efefef" media="slider">
        @foreach($product->image as $image)
            <div class="carousel-item {{ $loop->first ? 'active':'' }}">
            
            <img src="{{ url('storage/' . $image->im_url) }}" class="d-block w-100" alt="..." style="height:450px;object-fit:contain;">
            
            </div>
        @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSouq" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselSouq" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @if($product->stat_id != 1)
        <div style="position: absolute;top: 0px;background-color: red; color:white; padding:10px;width:100%; text-align:center">
            <h4>{{$product->status['stat_name']}}</h4>
        </div>
        @endif
        @if($product->likes == null)
        <form action="{{ route('likes') }}" method="post">
        @csrf
                    <input type="hidden" value="{{$product->ad_id}}" name="id">
        <button type="submit" class="likebtn like-bigger" style="left: 30px; top:20px">
            <i class="far fa-heart" style="vertical-align: text-top;"></i>
        </button>
        </form>
        @else
        <form action="{{ route('unlikes') }}" method="post">
             @csrf
            <input type="hidden" value="{{ $product->likes['like_id'] }}" name="likeid">
            <button type="submit" class="likebtn like-bigger liked" style="left: 30px; top:20px">
                <i class="far fa-heart" style="vertical-align: text-top;"></i>
            </button>
        </form>
        @endif
    </div>
    @else
        <div style="position:relative">
            <img src="{{ url('empty.jpeg') }}" class="rounded float-left" style="height:500px;width:100%;object-fit:contain;"
                alt="...">
            @if($product->stat_id != 1)
            <div style="position: absolute;top: 0px;background-color:red;color:white;padding:10px;width:100%; text-align:center">
                <h4>{{$product->status['stat_name']}}</h4>
            </div>
            @endif
            @if($product->likes == null)
            <form action="{{ route('likes') }}" method="post">
            @csrf
                        <input type="hidden" value="{{$product->ad_id}}" name="id">
            <button type="submit" class="likebtn like-bigger" style="left: 30px; top:20px">
                <i class="far fa-heart" style="vertical-align: text-top;"></i>
            </button>
            </form>
            @else
            <form action="{{ route('unlikes') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $product->likes['like_id'] }}" name="likeid">
                <button type="submit" class="likebtn like-bigger liked" style="left: 30px; top:20px">
                    <i class="far fa-heart" style="vertical-align: text-top;"></i>
                </button>
            </form>
            @endif
        </div>
    @endif

    <div style="margin-top:10px">
    <h5>Description</h5>
    <p>{!! nl2br($product->ad_description) !!}</p>
    </div>
    
    </div>
    <div class="col-md-4">
       <table class="table table-bordered text-center align-middle">
       <tr>
        <td>Price</td>
        <td><h3 style="color:red"><b>RM 
        {{ fmod($product->ad_price,1) !== 0.00 ? number_format($product->ad_price, 2): number_format($product->ad_price) }}
        </b></h3></td>
       </tr>
       <tr>
        <td colspan="2">
        {{ $product->poster['name']}} <br>
        <small>{{ $product->poster['email']}}</small>
        </td>
       </tr>
       <tr>
       <td>Category</td>
       <td>{{ $product->category['cat_name'] }}</td>
       </tr>
       <tr>
       <td>Sub-Category</td>
       <td>{{ $product->subcategory['sub_name'] }}</td>
       </tr>
       <tr>
        <td>Location</td>
        <td>{{ $product->location['loc_name']}}</td>
       </tr>
       <tr>
           <td colspan="2">
               <p>Share this ad </p>
               <div class="sharethis-inline-share-buttons" style="text-align: center;" 
               data-title="Souq - {{$product->ad_title}}"
               data-image="{{ $product->image->isNotEmpty() ? url('storage/' . $product->image[0]->im_url) :url('empty.jpeg')}}"
               ></div>
               <br>
           </td>
       </tr>
       </table>
    </div>

    <div class="col-md-12">
        <div class="row">
        @if($others->isNotEmpty())
        <div class="col-md-12" style="margin-top: 20px;"><h5>You may also like</h5></div>
        @endif
        @foreach($others as $ad)
            <div class="col-md-3" style="margin-bottom: 20px;">
                <a href="{{ route('product', ['id'=>$ad->ad_id]) }}" style="text-decoration: none;">
                <div class="card">
                    <div style="position:relative">
                        @if($ad->image->isNotEmpty())
                        <img src="{{ url('storage/' . $ad->image[0]['im_url']) }}" class="card-img-top" 
                            alt="..." style="height: 150px;object-fit:cover; width:100%">
                        @else
                        <img src="{{ url('empty.jpeg') }}" class="rcard-img-top"
                            alt="..." style="height: 150px;object-fit:contain;width:100%">
                        @endif
                        <div style="position: absolute;top: 8px;left: 16px;background-color:black;color:white;padding:5px">RM 
                        {{ fmod($product->ad_price,1) !== 0.00 ? number_format($product->ad_price, 2): number_format($ad->ad_price) }}</div>
                    </div>
                    
                    <div class="card-body hoverline">
                        <p class="card-text" style="color:black;">{{  Str::limit($ad->ad_title,20)}}</p>
                    </div>
                </div>
                </a>
            </div>
        @endforeach
        </div>
    </div>
</div>

@endsection