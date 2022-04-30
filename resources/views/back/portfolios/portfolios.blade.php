@extends('back.index')
@section('content')
    <section class="content-header">
        <h1>
           پروژه ها

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li><a href="#"> پروژه ها </a></li>

        </ol>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="box-header">
                            <h3 class="box-title">لیست  پروژه ها</h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route('back.portfolios.create')}}" type="button" class="btn btn-block btn-default btn-lg">ایجاد<i class="fa fa-plus-square"></i></a>
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
                                    تصویر
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">
                                    عنوان
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  تاریخ انجام
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                   توضیحات
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                    تاریخ ایجاد
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                    تاریخ بروزرسانی
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="سیستم عامل: activate to sort column ascending">
                                  مديريت
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($portfolios as $prtfolio)
                                <tr role="row" class="odd">
                                    @if($prtfolio->photos->pluck('path')->first())
                                        <td class="text-center">
                                            <img src="{{$prtfolio->photos->pluck('path')->first()}}" style="border-radius: 10px; width:50px;     height: 50px;" >
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <i class="fa fa-window-close" style="color: #f39c12;"></i>
                                        </td>
                                    @endif
                                    <td class="sorting_1"><a href="{{route('back.portfolios.edit',$prtfolio->id)}}">{{$prtfolio->title}} </a></td>
                                    <td>{{$prtfolio->date}}</td>
                                    <td>{!! mb_substr($prtfolio->description,0,80).'..'!!}</td>

                                        <td style="font-size:10px;">{{\Hekmatinasser\Verta\Verta::instance($prtfolio->created_at)}}</td>
                                        <td style="font-size:10px;">{{\Hekmatinasser\Verta\Verta::instance($prtfolio->updated_at)}}</td>
                                        <td>
                                        <a class=" label pull-center bg-aqua" href="{{route('back.portfolios.edit',$prtfolio->id)}}">ويرايش</a>
                                        <a class=" label pull-center bg-red" href="{{route('back.portfolios.destroy',$prtfolio->id)}}" onclick="return confirm('آیتم مورد نظر حذف شود؟');">حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                           </tbody>

                        </table>
                    </div>
                </div>
                {{$portfolios->links()}}
        </div>
        <!-- /.box-body -->
    </div>
        </div>
    </div>
@endsection
