@extends('back.index')
@section('content')
    <div class="container">
        <div class="row">
    <div class="col-md-10 offset-md-1 justify-content-md-center">
        <div class="box box-warning col-md-10 offset-md-1">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد نمونه پروژه</h3>
            </div>
            @include('back.massages')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  action="{{route('back.portfolios.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان: </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"name="title" value="{{old('title')}}" placeholder="عنوان">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">تاریخ انجام پروژه:</label>
                        <input type="text" class="form-control @error('date') is-invalid @enderror" id="exampleInputEmail1" name="date" value="{{old('date')}}" placeholder="تاریخ انجام پروژه ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> توضیحات: </label>
                        <textarea id="full-featured"  type="text" class="form-control @error('description') is-invalid @enderror" name="description" >{{old('description')}}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="pro-photo">تصاویر پروژه :</label>
                        <div class="col-sm-12">
                            <input type="hidden" name="photos[]" id="pro-photo">
                            <div id="photo" class="dropzone"></div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" onclick="productGallery()" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">ذخيره</button>
                    <a href="{{route('back.portfolios')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    @endsection
@section('js')
    <script>
        $(".chosen-select").chosen()
    </script>
@endsection
