<!-- right side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                @if(isset(Auth::user()->photo_id))
                <img src="{{Auth::user()->photo->path}}" class="img-circle" alt="User Image">
                @else
                    <i class="fa fa-user"></i>
                @endif
            </div>
            <div class="pull-right info">
                <p>{{Auth::user()->lastname}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::user()->roles()->pluck('name')->first()}}</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="جستجو">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">منو</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>سایت اختصاصی</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a target="_blank" href="{{route('home')}}"><i class="fa fa-circle-o"></i>مشاهده وب سایت</a></li>
                    <li><a href="{{route('admin')}}"><i class="fa fa-circle-o"></i>پنل مدیریت</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-users"></i>
                    <span>مدیریت کاربران</span>
                    <span class="pull-left-container">

              <span class="pull-left">
                  <i class="fa fa-angle-left pull-left"></i>
              </span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.users')}}"><i class="fa fa-list"></i>لیست کاربران</a></li>
                    <li><a href="{{route('back.users.create')}}"><i class="fa fa-plus"></i>ثبت کاربر</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments"></i> <span>Header </span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.headers')}}"><i class="fa fa-list"></i>نمایش</a></li>
                    <li><a href="{{route('back.headers.create')}}"><i class="fa fa-plus"></i>ثبت کاربر</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments"></i> <span>ویجت recent works </span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.widgets')}}"><i class="fa fa-list"></i>نمایش</a></li>
                    <li><a href="{{route('back.widgets.create')}}"><i class="fa fa-plus"></i>ثبت کاربر</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-open-o"></i> <span>پروژه ها </span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.portfolios')}}"><i class="fa fa-list"></i>لیست پروژه ها</a></li>
                    <li><a href="{{route('back.portfolios.create')}}"><i class="fa fa-plus"></i> ایجاد پروژه</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-open-o"></i> <span> اطلاعات تماس </span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.contacts')}}"><i class="fa fa-list"></i>مشاهده اطلاعات تماس</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-open-o"></i> <span> لیست منو </span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.lists')}}"><i class="fa fa-list"></i>مشاهده</a></li>
                    <li><a href="{{route('back.lists.create')}}"><i class="fa fa-plus"></i> ایجاد پروژه</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>رسانه ها</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.photos')}}"><i class="fa fa-list"></i> لیست فایل ها</a></li>
                    <li><a href="{{route('back.photos.create')}}"><i class="fa fa-plus"></i> آپلود فایل</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>تنظیمات</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('back.settings')}}"><i class="fa fa-list"></i> لیست تنظیمات</a></li>
                    <li><a href="{{route('back.settings.create')}}"><i class="fa fa-plus"></i> ایجاد</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
