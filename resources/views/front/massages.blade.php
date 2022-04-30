@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<!--نمایش پیغام دسته بندی جدید -->
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-danger">
        یک خطا رخ داده است  {{session('warning')}}
    </div>
@endif
@if(session('info'))
    <div class="alert alert-danger">
        ثبت سفارش با خطا مواجه شد! لطفا دوباره تلاش کنید  {{session('info')}}
    </div>
@endif

@if(session('status'))
    <div class="alert alert-warning">
        یک خطا رخ داده است  {{session('status')}}
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-warning">
         {{session('danger')}}
    </div>
@endif
