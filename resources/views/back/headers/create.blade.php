@extends('back.index')
@section('content')
    <div class="container">
        <div class="row">
    <div class="col-md-10 offset-md-1 justify-content-md-center">
        <div class="box box-warning col-md-10 offset-md-1">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد</h3>
            </div>
            @include('back.massages')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('back.headers.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان بالا: </label>
                        <input type="text" class="form-control @error('titletop') is-invalid @enderror" id="exampleInputEmail1"name="titletop" value="{{old('titletop')}}" placeholder="عنوان بالا">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان: </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"name="title" value="{{old('title')}}" placeholder="عنوان">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان پایین: </label>
                        <input type="text" class="form-control @error('titlebottom') is-invalid @enderror" id="exampleInputEmail1"name="titlebottom" value="{{old('titlebottom')}}" placeholder="عنوان پایین">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">کانتنت چپ: </label>
                        <input type="text" class="form-control @error('content') is-invalid @enderror" id="exampleInputEmail1"name="content" value="{{old('content')}}" placeholder="content">
                    </div>

                    <div class="form-group">
                        <lable for="exampleInputEmail1">متن  about:</lable>
                        <textarea id="full-featured" type="text" class="form-control @error('description') is-invalid @enderror" name="description" style="font-family: 'vazir';" >{{old('description')}}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">تصویر  :</label>
                        <input type="file" name="photo_id" id="exampleInputFile">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">ذخيره</button>
                    <a href="{{route('back.headers')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    @endsection

