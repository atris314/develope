@extends('back.index')
@section('content')
    <div class="row">
        <div class="col-md-3">
            @if($portfolio->photos->pluck('path')->first())
                <td class="text-center">
                    <img src="{{$portfolio->photos->pluck('path')->first()}}" style="border-radius: 10px; width:300px;     height: 200px;" >
                </td>
            @else
                <td class="text-center">
                    <i class="fa fa-window-close" style="color: #f39c12;"></i>
                </td>
            @endif
        </div>
        <div class="col-md-9 justify-content-md-center">

            <div class="box box-success col-md-9  justify-content-md-center">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش نمونه پروژه: {{$portfolio->title}} </h3>
                </div>
            @include('back.massages')
            <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{route('back.portfolios.update',$portfolio->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان: </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" name="title" value="{{$portfolio->title}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاریخ انجام پروژه:</label>
                            <input type="text" class="form-control @error('date') is-invalid @enderror" id="exampleInputEmail1" name="date" value="{{$portfolio->date}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">توضیحات: </label>
                            <textarea id="full-featured" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  >{{$portfolio->description}}</textarea>
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
                        <button type="submit" onclick="productGallery()" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">بروزرسانی</button>
                        <a href="{{route('back.portfolios')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
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
