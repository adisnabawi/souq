@extends('layouts.main')
@section('title', 'Profile on ' . $poster->name)

@section('content')
<div class="row">
    <div class="col-md-4">
    <h1>Profile</h1>
    <h4>{{ $poster->name}}</h4>
    <p>{{ $poster->email }}</p>
    </div>
    <div class="col-md-8">
       <div class="row">
       @foreach($ads as $ad)
            <div class="col-lg-3">
                <div style="position: relative;">
                <a href="{{route('product', ['id'=>$ad->ad_id])}}">
                    @if($ad->image->isNotEmpty())
                    <img src="{{ url('storage/' . $ad->image[0]['im_url']) }}" class="rounded float-left" style="width: 100%; height:150px;object-fit:cover;object-position: top;"
                        alt="...">
                    @else
                    <img src="{{ url('empty.jpeg') }}" class="rounded float-left" style="width: 100%; height:150px;object-fit:cover;"
                        alt="...">
                    @endif
                </a>
                    @if(count($ad->image) > 0)
                    <div style="position: absolute;bottom: 8px;left: 16px;background-color:#4c4c4cd1;color:white;padding:5px">
                        <small><i class="far fa-images"></i> {{ count($ad->image) }}</small>
                    </div>
                    @endif
                    @if($ad->stat_id != 1)
                    <div style="position: absolute;top: 0px;right: 0;background-color:red;color:white;padding:5px">
                        {{ $ad->status['stat_name']}}
                    </div>
                    @endif
                
                    @if($ad->likes == null)
                        <form action="{{ route('likes') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{$ad->ad_id}}" name="id">
                        <button type="submit" class="likebtn" style="height:30px;width:30px;">
                            <i class="far fa-heart" style="vertical-align: text-top;"></i>
                        </button>
                        </form>
                    @else
                        <form action="{{ route('unlikes') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $ad->likes['like_id'] }}" name="likeid">
                        <button type="submit" class="likebtn liked" style="height:30px;width:30px;">
                            <i class="far fa-heart" style="vertical-align: text-top;"></i>
                        </button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <a href="{{route('product', ['id'=>$ad->ad_id])}}" class="listing-title"><h5>{{$ad->ad_title}}</h5></a>
                <p style="color:red;font-weight: bold;">RM 
                {{ fmod($ad->ad_price,1) !== 0.00 ? number_format($ad->ad_price, 2): number_format($ad->ad_price) }}
                </p>
                <small>{{$ad->category['cat_name']}} > {{$ad->subcategory['sub_name']}}</small>
            </div>
            <div class="col-lg-3">
                @if($ad->created_at->isToday())
                <small><i class="far fa-clock"></i> {{ 'Today, ' . Carbon\Carbon::parse($ad->created_at)->format('h:iA')}}</small>
                @else
                <small><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($ad->created_at)->format('M d, h:iA / Y')}}</small>
                @endif
                <br>
                <small><i class="fas fa-map-marker"></i> {{ $ad->location['loc_name'] }}</small>
            </div>
            <div class="col-lg-12">
            <hr>
            </div>
            @endforeach
       </div>
       <div class="col-md-12">
       {{ $ads->appends(request()->input())->links() }}
       </div>
    </div>
</div>

@endsection