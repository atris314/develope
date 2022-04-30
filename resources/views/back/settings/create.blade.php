@extends('back.index')
@section('content')
    <div class="container">
        <div class="row">
    <div class="col-md-10 offset-md-1 justify-content-md-center">
        <div class="box box-warning col-md-10 offset-md-1">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد مطلب جدید</h3>
            </div>
            @include('back.massages')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('back.settings.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">نام سایت :</label>
                        <input type="text" class="form-control @error('sitename') is-invalid @enderror" id="exampleInputEmail1" name="sitename" value="{{old('sitename')}}" placeholder="نام سایت ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">کپی رایت:</label>
                        <input type="text" class="form-control @error('copyright') is-invalid @enderror" id="exampleInputEmail1" name="copyright" value="{{old('copyright')}}" placeholder="کپی رایت">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">لوگو :</label>
                        <input type="file" name="photo_id" id="exampleInputFile">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">ذخيره</button>
                    <a href="{{route('back.settings')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    @endsection
