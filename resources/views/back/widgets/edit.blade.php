@extends('back.index')
@section('content')
    <div class="row">
        <div class="col-md-9 justify-content-md-center">

            <div class="box box-success col-md-9  justify-content-md-center">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش: </h3>
                </div>
            @include('back.massages')
            <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{route('back.widgets.update',$widget->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">بالا: </label>
                            <input type="text" class="form-control @error('top') is-invalid @enderror" id="exampleInputEmail1" name="top" value="{{$widget->top}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">پایین: </label>
                            <input type="text" class="form-control @error('bottom') is-invalid @enderror" id="exampleInputEmail1" name="bottom" value="{{$widget->bottom}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">لیست مهارت ها : </label>
                            <textarea type="text" class="form-control @error('list') is-invalid @enderror" name="list" style="font-family: 'vazir';" >{{$widget->list}}</textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">بروزرسانی</button>
                        <a href="{{route('back.widgets')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
