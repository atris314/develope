                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @extends('back.index')
@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{$user->photo->path}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center" dir="ltr">{{$user->code}}</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                </div>
            <div class="col-lg-8">
                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> اطلاعات شخصی</strong>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="text-muted pt-5">
                                    <br><br>
                                    نام و نام خانوادگی : {{$user->lastname}} <br><br><br>
                                    نام کاربری :   {{$user->name}} <br><br><br>
                                    شماره موبایل: {{$user->mobile}} <br><br><br>
                                    شماره تلفن  :   {{$user->phone}} <br><br><br>
                                    نشانی ایمیل : {{$user->email}} <br><br><br>

                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-muted pt-5">
                                    <br><br>
                                    شناسه کاربری :<span dir="ltr">{{$user->code}} </span><br><br><br>
                                    آدرس  : {{$user->address}} <br><br><br>
                                    کدپستی  :<span dir="ltr">{{$user->postcode}} </span><br><br><br>
                                    نام شرکت :<span dir="ltr">{{$user->companyname}} </span><br><br><br>
                                    حیطه کاری  :<span dir="ltr">{{$user->jobs}} </span><br><br><br>
                                    امتیاز   :<span dir="ltr">{{$user->rate}} </span><br><br><br>

                                </p>
                            </div>
                        </div>
                        <hr>
                        <a href="{{route('back.users.edit',$user->id)}}" class="btn btn-sm btn-warning">ویرایش اطلاعات</a>
                </div>
            </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
