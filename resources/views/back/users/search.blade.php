@extends('back.index')
@section('content')
    <section class="content-header">
        <h1>
            کاربران

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li><a href="#">کاربران</a></li>

        </ol>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="padding: 30px ">
                <form action="{{route('userSearch')}}" method="get" style="display: inline-block;">
                    @csrf
                    <label style="display: inline-flex !important; ">مرتب سازی براساس نقش کاربری </label>
                    <div class="input-group input-group-sm col-lg-4">
                        <select  aria-controls="example1" class="form-control input-sm" name="roles">
                            @foreach($roles as $roles_id => $roles_name)
                                <option value="{{$roles_id}}">{{$roles_name}}</option>
                            @endforeach
                        </select>
                        {{--                            <input type="text" class="form-control" placeholder="عبارت مورد جستجو ..." name="title" value="{{old('title')}}" >--}}
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat">مرتب سازی</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="box-header">
                            <h3 class="box-title">لیست کاربران</h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route('back.users.create')}}" type="button" class="btn btn-block btn-default btn-lg">ایجاد<i class="fa fa-plus-square"></i></a>
                    </div>
                </div>
                <hr>

        <!-- /.box-header -->
        <div class="box-body">
            @include('back.massages')
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    ID
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    شناسه کاربر
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">

                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    نام کاربری
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    نام و نام خانوادگی
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="مرورگر: activate to sort column ascending">
                                    ایمیل
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  نقش کاربر
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  امتیاز کاربر
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                    تاریخ ثبت نام
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                   وضعیت کاربر
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  مديريت
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr role="row" class="odd">
                                    <td  class="text-center">{{$user->id}}</td>
                                    <td dir="ltr">{{$user->code}}</td>
                                    @if($user->photo_id)
                                        <td class="text-center"><img src="{{$user->photo->path}}" style="border-radius: 50%; width:50px;     height: 50px;" ></td>
                                    @else
                                        <td class="text-center"><img src="{{url('back/dist/img/avatar-default.png')}}" style="border-radius: 50%; width:50px;     height: 50px;"></td>
                                    @endif
                                    <td class="sorting_1"><a href="{{route('back.users.edit',$user->id)}}">{{$user->name}} </a></td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">
                                            @foreach($user->roles()->get() as $role)
                                                <a class="karma">{{$role->name}}</a><br>
                                            @endforeach
                                    </td>
                                        <td>{{$user->rate}}</td>
{{--                                    <td>{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today($user->created_at))}}</td>--}}
                                    <td>{{\Hekmatinasser\Verta\Verta::instance($user->created_at)}}</td>
                                    <td>
{{--                                        @if($user['status']==1)--}}
{{--                                            <a class="label pull-center bg-green">فعال </a>--}}

{{--                                            @elseif($user['status']==2)--}}
{{--                                            <a class="label pull-center bg-aqua">همکار </a>--}}
{{--                                            @else--}}
{{--                                            <a class="label pull-center bg-yellow">غیرفعال </a>--}}
{{--                                        @endif--}}


                                        <?php
                                        $url = route('back.users.status',$user->id);
                                        if ($user['status']==1){
                                            echo '<a href="'.$url.'" class="label pull-center bg-green">فعال </a>';
                                        }
                                        else{
                                            echo '<a href="'.$url.'" class=" label pull-center bg-yellow">غيرفعال </a>';
                                        }
                                           ?>
                                    </td>
                                    <td>
                                        <a class=" label pull-center bg-aqua" href="{{route('back.users.edit',$user->id)}}">ويرايش</a>
                                        <a class=" label pull-center bg-red" href="{{route('back.users.delete',$user->id)}}" onclick="return confirm('آیتم مورد نظر حذف شود؟');">حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                           </tbody>

                        </table>
                    </div>
                </div>
                {{$users->links()}}
        </div>
        <!-- /.box-body -->
    </div>
        </div>
    </div>
@endsection
