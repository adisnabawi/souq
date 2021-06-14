@extends('layouts.main')
@section('title', 'Post your advertisements')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>SOUQ: Post your advertisements</h1>
        <h4>A marketplace for IIUM Community</h4>
        <p>Students and staff can post their ads free of charge. No more paying for advertisements</p>
    </div>
    <div class="col-md-8" ng-app="myApp" ng-controller="myCtrl">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
        <form action="{{ route('ads.submit') }}" method="post">
        @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Product name" name="title" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price (RM)</label>
                <input type="text" class="form-control" placeholder="100.00" name="price" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="category" ng-model="selectedItem" ng-change="update()" name="category" required>
                    @foreach($cats as $cat)
                    <option value="{{ $cat->cat_id}}">{{ $cat->cat_name }}</option>                    
                    @endforeach
                </select>
            </div>
            <div class="mb-3" ng-if="subcat != null">
                <label for="subcategory" class="form-label">Sub-Category</label>
                <select class="form-select" aria-label="subcategory" name="subcategory">
                    <option ng-repeat="sub in subcat" value="@{{sub['sub_id'] }}">@{{sub['sub_name'] }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <select class="form-select" name="location" required>
                    @foreach($locations as $loc)
                    <option value="{{ $loc->loc_id}}">{{ $loc->loc_name }}</option>                    
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="" rows="3" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Post Advertisement">
            </div>
        </form>
    </div>
</div>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
    $scope.update = function() {
        $http.post("{{route('subcategory')}}", { 'id' : $scope.selectedItem })
        .then(function(response) {
            $scope.subcat = response.data;
        });
  
    }
});
</script>

@endsection