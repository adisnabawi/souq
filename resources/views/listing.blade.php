@extends('layouts.main')
@section('title', 'List of ads')
@section('content')
<div class="row justify-content-center" ng-app="myApp" ng-controller="myCtrl">
    <div class="col-md-8">
        <div class="card" style="margin-bottom:20px">
        <div class="card-body">
        <form action="{{ route('listing') }}" method="get">
            <div class="form-row" style="display: inline-block; width:100%">
                <div class="col form-group" style="margin:2%; float:left; width:46%;">
                <input type="text" class="form-control" placeholder="What are you looking for?" name="q">
                </div>

                <div class="col form-group" style="margin:2%; float:left; width:46%">
                <select name="location" class="form-select">
                    @foreach($locations as $loc)
                    <option value="{{ $loc->loc_id}}" {{ Request::get("location") == $loc->loc_id ? 'selected' :''}}>
                        {{ $loc->loc_name }}
                    </option>                    
                    @endforeach
                </select>
                </div>

                <div class="col form-group" style="margin:2%; float:left;width:46%">
                <select name="category" class="form-select" ng-model="selectedCat" ng-change="update()" >
                    <option value="">Select categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->cat_id}}">{{ $cat->cat_name }}</option>                    
                    @endforeach
                </select>
                </div>
                <div class="col form-group" ng-if="selectedCat !== ''" style="margin:2%; float:left; width:46%">
                    <select class="form-select" name="subcategory" ng-model="selectedSub">
                        <option value="">Select subcategories</option>
                        <option ng-repeat="sub in subcat" value="@{{sub['sub_id'] }}">@{{sub['sub_name'] }}</option>
                    </select>
                </div>
                
                <div class="col form-group" style="margin:2%; clear:both">
                 <p style="color:#828282">PRICE</p>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 5px;">
                        <div class="row">
                            <div class="col-2 text-center"><b>RM</b></div>
                            <div class="col-10">
                                <input type="number" class="form-control" placeholder="Minimum price" name="minprice" min="0" value="{{ Request::get("minprice") }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 5px;">
                        <div class="row">
                            <div class="col-2 text-center"><b>RM</b></div>
                            <div class="col-10">
                                <input type="number" class="form-control" placeholder="Maximum price" name="maxprice" min="1" value="{{ Request::get("maxprice") }}">
                            </div>
                        </div>
                    </div>
                </div>
                    
                </div>
                <div class="col form-group" style="margin:5px;clear:both">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search Now</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-lg-12" style="margin-bottom: 30px;">
                <div class="row">
                    <div class="col-8">
                        <h6>
                        Found <b>{{$ads->total()}}</b> 
                        {{ $catname != null ?  $catname->cat_name : 'All Categories' }} in
                        {{ $locname != null ?  $locname->loc_name : 'All Campus' }} 
                        </h6>
                    </div>
                    <div class="col-4 text-end">
                        <div class="dropdown">
                        <a class="btn btn-secondary" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                         Sort <i class="fas fa-sort"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item {{ Request::get('sort') == 'pricehightolow' ? 'active':''}}" href="{{ request()->fullUrlWithQuery(['sort' => 'pricehightolow']) }}">Price - High to Low</a></li>
                            <li><a class="dropdown-item {{ Request::get('sort') == 'pricelowtohigh' ? 'active':''}}" href="{{ request()->fullUrlWithQuery(['sort' => 'pricelowtohigh']) }}">Price - Low to High</a></li>
                            <li><a class="dropdown-item {{ Request::get('sort') == 'newest' || Request::get('sort') == null ? 'active':''}}" href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"> Newest</a></li>
                            <li><a class="dropdown-item {{ Request::get('sort') == 'oldest' ? 'active':''}}" href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Older first</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            
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
        
    </div>
    <div class="col-md-8" style="margin-top: 20px;">{{ $ads->appends(request()->input())->links() }}</div>
</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
    $scope.selectedCat = '{{ Request::get("category") }}';
    
    $http.post("{{route('subcategory')}}", { 'id' : $scope.selectedCat })
    .then(function(response) {
        $scope.subcat = response.data;
        $scope.selectedSub = '{{ Request::get("subcategory") }}';
    });

    $scope.update = function() {
        $http.post("{{route('subcategory')}}", { 'id' : $scope.selectedCat })
        .then(function(response) {
            $scope.subcat = response.data;
            $scope.selectedSub = '{{ Request::get("subcategory") }}';
        });
  
    }
});
</script>

@endsection