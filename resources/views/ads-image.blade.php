@extends('layouts.main')
@section('title', 'Post your advertisements')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>SOUQ: Upload product images</h1>
        <h4>A marketplace for IIUM Community</h4>
        <p>Students and staff can post their ads free of charge. No more paying for advertisements</p>
    </div>
    <div class="col-md-8">
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

        @if(!empty($imgs))
        <div class="row" style="margin-bottom: 20px;">
        <h3>{{ $ad->ad_title }}</h3>
            @foreach($imgs as $img)
                <div class="col-md-4">
                    <div style="position: relative;">
                        <img src="{{  url('storage/' .$img->im_url) }}" alt="" style="width: 100%;object-fit:cover">
                        <div style="position: absolute;bottom: 0px;background-color:#efefefb3;padding:5px;width:100%; text-align:center;">
                            <a href="{{ route('ads.image.delete', ['id'=>$img->im_id]) }}" style="color:red"><i class="far fa-trash-alt"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
        @endif
    
        <form action="{{ route('ads.submit.image', ['id'=> request()->route('id')]) }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Upload images (.png/.jpeg/.jpg only)</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="mb-3">   
                <input type="submit" class="btn btn-primary" value="Upload Image">
            </div>
            
        </form>
    </div>
    <div class="col-md-12 text-end">
    <a href="{{route('index')}}" class="btn btn-success"><i class="far fa-save"></i> Complete</a>
    </div>
</div>

@endsection