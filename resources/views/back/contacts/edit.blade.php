@extends('back.index')
@section('content')
    <div class="row">
        <div class="col-md-9 justify-content-md-center">

            <div class="box box-success col-md-9  justify-content-md-center">
                <div class="box-header with-border">
                    <h3 class="box-title"> ویرایش اطلاعات تماس:<br><br>  {!! mb_substr($contact->title,0,30)!!}</h3>
                </div>
            @include('back.massages')
            <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{route('back.contacts.update',$contact->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> عنوان: </label>
                            <textarea id="editor"  type="text" class="form-control @error('title') is-invalid @enderror" name="title" >{{$contact->title}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">gmail: </label>
                            <input type="text" class="form-control @error('gmail') is-invalid @enderror" id="exampleInputEmail1"name="gmail" value="{{$contact->gmail}}" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">linkedin:</label>
                            <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="exampleInputEmail1" name="linkedin" value="{{$contact->linkedin}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">behance:</label>
                            <input type="text" class="form-control @error('behance') is-invalid @enderror" id="exampleInputEmail1" name="behance" value="{{$contact->behance}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">instagram:</label>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="exampleInputEmail1" name="instagram" value="{{$contact->instagram}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">متن دکمه:</label>
                            <input type="text" class="form-control @error('btn') is-invalid @enderror" id="exampleInputEmail1" name="btn" value="{{$contact->btn}}">
                        </div>
                        <div class="form-group">
                            {{route('home')}}{{$contact->photo->path}}
                            <br>
                            <label for="exampleInputFile">آپلود فایل  :  </label>
                            <input type="file" name="photo_id" id="exampleInputFile">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-lg btn-primary label pull-center bg-green" style="padding: 10px;">بروزرسانی</button>
                        <a href="{{route('back.contacts')}}"  class="btn btn-lg btn-primary label pull-center bg-yellow" style="padding: 6px;">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
