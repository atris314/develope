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
            <form role="form" action="{{route('back.widgets.store')}}" method="post">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">بالا: </label>
                        <input type="text" class="form-control @error('top') is-invalid @enderror" id="exampleInputEmail1"name="top" value="{{old('top')}}" placeholder="بالا">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">پایین: </label>
                        <input type="text" class="form-control @error('bottom') is-invalid @enderror" id="exampleInputEmail1"name="bottom" value="{{old('bottom')}}" placeholder="پایین">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">لیست مهارت ها: </label>
                        <textarea type="text" class="form-control @error('list') is-invalid @enderror" name="list" style="font-family: 'vazir';" >{{old('list')}}</textarea>

                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">ذخيره</button>
                    <a href="{{route('back.widgets')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    @endsection
