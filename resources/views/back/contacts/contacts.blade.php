@extends('back.index')
@section('content')
    <section class="content-header">
        <h1>
            اطلاعات تماس

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li><a href="#">اطلاعات تماس</a></li>

        </ol>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="box-header">
                            <h3 class="box-title">اطلاعات تماس</h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route('back.contacts.create')}}" type="button" class="btn btn-block btn-default btn-lg">ایجاد<i class="fa fa-plus-square"></i></a>
                    </div>
                </div>
                <hr>

        <!-- /.box-header -->
        <div class="box-body">
            @include('back.massages')
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    عنوان
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    gmail
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="مرورگر: activate to sort column ascending">
                                    linkedin
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="مرورگر: activate to sort column ascending">
                                    behance
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="مرورگر: activate to sort column ascending">
                                    instagram
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="مرورگر: activate to sort column ascending">
                                    متن دکمه
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="مرورگر: activate to sort column ascending">
                                    لینک دکمه
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  تاريخ ایجاد
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  مديريت
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><a href="{{route('back.contacts.edit',$contact->id)}}">{!! mb_substr($contact->title,0,40).'..'!!} </a></td>
                                    <td>{!! mb_substr($contact->gmail,0,10).'..'!!}</td>
                                    <td>{!! mb_substr($contact->linkedin,0,10).'..'!!}</td>
                                    <td>{!! mb_substr($contact->behance,0,10).'..'!!}</td>
                                    <td>{!! mb_substr($contact->instagram,0,10).'..'!!}</td>
                                    <td>{{$contact->btn}}</td>
                                    @if($contact->photo_id)
                                        <td> {{route('home')}}{{$contact->photo->path}} </td>
                                    @endif

                                    <td>{{\Hekmatinasser\Verta\Verta::instance($contact->created_at)}}</td>
                                    <td>
                                        <a class=" label pull-center bg-aqua" href="{{route('back.contacts.edit',$contact->id)}}">ويرايش</a>
                                        <a class=" label pull-center bg-red" href="{{route('back.contacts.destroy',$contact->id)}}" onclick="return confirm('تماس كاربر حذف شود؟');">حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                           </tbody>

                        </table>
                    </div>
                </div>
                {{$contacts->links()}}
        </div>
        <!-- /.box-body -->
    </div>
        </div>
    </div>
@endsection
