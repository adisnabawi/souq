@extends('layouts.main')
@section('title', 'My Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>SOUQ: Welcome!</h1>
        <h4>{{ Auth()->user()->name }}</h4>
        <p>{{ Auth()->user()->email }}</p>
    </div>
    <div class="col-md-8">
       @foreach($products as $product)
       <div class="card mb-3" style="width:100%">
        <div class="row g-0">
            <div class="col-md-4">
                <div style="position: relative;">
                    <a href="{{ route('product', ['id'=>$product->ad_id])}}">
                    @if($product->image->isNotEmpty())
                    <img src="{{ url('storage/' . $product->image[0]['im_url']) }}" style="width: 100%; object-fit:cover;"
                        alt="...">
                    @else
                    <img src="{{ url('empty.jpeg') }}"  style="width: 100%; object-fit:cover;"
                        alt="...">
                    @endif
                    </a>
                    @if($product->stat_id != 1)
                    <div style="position: absolute;bottom: 0px;left:0px;background-color:red;color:#fff;padding:5px; text-align:center; width:100%">
                        {{$product->status['stat_name']}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $product->ad_title }}</h5>
                <p style="color:red;font-weight: bold;">RM 
                {{ fmod($product->ad_price,1) !== 0.00 ? number_format($product->ad_price, 2): number_format($product->ad_price) }}
                </p>
                <p>
                    <span class="badge rounded-pill bg-primary">{{ $product->category['cat_name'] }}</span>  
                </p>
                <p class="text-end">
                <a href="{{route('ads.edit', ['id'=> $product->ad_id])}}" class="btn btn-outline-success"><i class="far fa-edit"></i>  Edit</a>
                <a href="{{route('ads.image', ['id'=> $product->ad_id])}}" class="btn btn-outline-info"><i class="far fa-images"></i>  Upload</a>
                </p>
                <p class="card-text"><small class="text-muted">{{ $product->created_at}}</small></p>
            </div>
            </div>
        </div>
        </div>
       @endforeach
       {{ $products->links() }}
    </div>
</div>

@endsection