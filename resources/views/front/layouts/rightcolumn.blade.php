<div class="rightcolumn">
    <div class="cardblog">
        <form action="{{route('search')}}" method="get">
            @csrf
            <lable> جستجوی مطالب</lable>
            <div class="input-group">
                <input type="text" class="form-control inputform" id="exampleInputEmail1" name="title" value="{{old('title')}}" placeholder="عبارت مورد جستجو ...">
                <span class="input-group-btn">
                      <button type="submit" class=" search"><img class="searchicon" src="{{asset('front/assets/img/search--v2.png')}}"></button>
                 </span>
            </div>
        </form>
    </div>
    <div class="cardblog">
        <h3>دسته بندی مطالب</h3>
        @foreach($categories as $category)
        <div class="fakeimg"><a href="{{route('postcat',$category->slug)}}">{{$category->title}}</a> </div><br>
        @endforeach
    </div>
    <div class="cardblog">
        <h3>مقالات مرتبط</h3>
        @foreach($posts as $itempost)
        <div class="fakeimg">
            <div class="row">
                <div class="col-lg-8"> <a href="{{route('postdetail',$itempost->slug)}}">{{$itempost->title}}</a> <span>{{\Hekmatinasser\Verta\Verta::instance($itempost->created_at)}}</span> </div>
                <div class="col-lg-4"> <img src="{{$itempost->photo->path}}" class="sidebar-img"> </div>
            </div>


        </div>
            <br>
        @endforeach
    </div>
    <div class="cardblog">
        <h6>یابانه را در شبکه های اجتماعی دنبال کنید</h6>
        <div class="social-links align-items-center">
            <a href="{{$settings->twitter}}" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="{{$settings->facebook}}" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="{{$settings->instagram}}" class="instagram"><i class="icofont-instagram"></i></a>
            <a href="{{$settings->skype}}" class="skype"><i class="icofont-skype"></i></a>
            <a href="{{$settings->linkedin}}" class="linkedin"><i class="icofont-linkedin"></i></a>
            <a href="{{$settings->telegram}}" class="telegram"><i class="bx bxl-telegram"></i></a>
            <a href="{{$settings->whatsapp}}" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
        </div>
    </div>
</div>
