@extends('back.index')
@section('content')
    <div class="row">
        <div class="col-md-3">
            @if($user->photo_id)
                <td><img src="{{$user->photo->path}}" class="img-fluid" style=" margin-right: 60px; border-radius: 50%; width:250px; height: 250px;" ></td>
            @else
                <td><img src="{{url('back/dist/img/avatar-default.png')}}" class="img-fluid" style=" margin-right: 60px; border-radius: 50%; width:250px; height: 250px;"></td>
            @endif
        </div>
        <div class="col-md-9 justify-content-md-center">

            <div class="box box-success col-md-9  justify-content-md-center">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش کاربر: {{$user->name}} </h3>
                </div>
            @include('back.massages')
            <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{route('back.users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نام کاربری: </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" name="name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">ايميل:</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" value="{{$user->email}}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">وضعيت:</label>
                            <select class="form-control" name="status" style="height: 50px;" >
                                <option value="0">غير فعال</option>
                                <option value="1"  <?php if($user->status==1) echo 'selected' ; ?>>فعال</option>
                            </select>
                        </div>

                        @can('isAdmin')
                        <div class="form-group">
                            <label for="exampleInputEmail1">نقش:</label>
                            <div id="output"></div>
                            <select class="chosen-select form-control" name="roles[]" multiple style="width:400px;">
                                @foreach($roles as $roles_id => $roles_name)
                                    <option value="{{$roles_id}}"
                                        <?php
                                        if (
                                        in_array($roles_id,$user->roles()->pluck('id','name')->toArray())
                                        )
                                            echo 'selected';
                                        ?>

                                        >{{$roles_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endcan

                        <div class="form-group">
                            <label for="exampleInputPassword1">رمز عبور:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="رمز عبور">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">تغییر عکس پروفایل:</label>
                            <input type="file" name="photo_id" id="exampleInputFile">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">بروزرسانی</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".chosen-select").chosen()
    </script>
@endsection
