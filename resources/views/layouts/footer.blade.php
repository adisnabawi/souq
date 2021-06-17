<footer style="background-color: #efefef; padding:20px">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-4">
        <img src="{{ url('logo.png') }}" alt="logo" style="width:180px; height:auto" /> <br><br>
        <p>A free marketplace designed for community. Post your ads for free now!</p>
    </div>
    <div class="col-md-8">
        <div class="row">
        <div class="com-md-12" style="margin-bottom: 20px;"><h4>Browse All Categories</h4></div>
            @foreach($category as $cats)
            <div class="col-md-4" style="font-size:small">
                @foreach($cats as $cat)
                    <h6>{{$cat->cat_name}}</h6>
                    <ul style="list-style-type:none; padding: 0;margin: 0;">
                    @foreach($cat->subcategory as $sub)
                        <li><a href="{{ route('listing') . '?category='.$cat->cat_id.'&subcategory='. $sub->sub_id }}" style="color:#000;text-decoration:none"><span class="hoverline">{{$sub->sub_name}}</span></a></li>
                    @endforeach
                    </ul>
                    <br>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
    
    </div>
</footer>
<div style="background-color: #d4d4d4;">
<div class="container-fluid" style="padding: 20px;">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-md-6">
                    <small>
                        <a href="" style="margin-right: 10px; color:#000;text-decoration:none">
                            <span class="hoverline">About Souq</span>
                        </a>
                    </small>
                </div>
                <div class="col-md-6">
                    <small>
                        <a href="" style="margin-right: 10px; color:#000;text-decoration:none">
                            <span class="hoverline">Privacy Policy</span>
                        </a>
                    </small>
                </div>
            </div>
            
        </div>
        <div class="col-6 text-end">
        <small>Developed by <a href="https://adisazizan.xyz" target="_blank">Adis Nabawi</a> for IIUM Community &copy; 2021</small>
        </div>
    </div>
    </div>
</div>