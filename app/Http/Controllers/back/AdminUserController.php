<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Role;
use App\Models\Teammate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')){
            //        $users = User::with('roles')->get();
            $roles = Role::all()->pluck('name','id');
            $users = User::Orderby('created_at','ASC')->paginate(20);
            //dd($users);
            return view('back.users.users',compact('users','roles'));
        }else{
            $msg = 'فقط مدیر به این بخش دسترسی دارد.' ;
            return back()->with('info',$msg);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name','id');
        if(Gate::allows('isAdmin',$roles)){
            return view('back.users.create',compact('roles'));
        }else{
            $msg = 'فقط مدیر به این بخش دسترسی دارد.' ;
            return back()->with('info',$msg);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $messages = [
            'name.required' => 'فیلد نام را وارد نمایید',
            'email.required' => 'فیلد ایمیل را وارد نمایید',
            'email.email' => 'ايميل وارد شده معتبر نيست',
            'email.unique' => 'ايميل وارد شده تكراري است',
            'password.required' => 'فيلد رمز عبور را وارد نماييد',
            'password.min' => 'رمز عبور بايد بيشتر از 6 كاراكتر باشد',
            'status.required' => 'فيلد وضعيت را وارد نماييد',
            'roles.required' => 'نقش كاربر را  تعيين كنيد',
        ];
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'status' => 'required',
            'roles' => 'required',
        ],$messages);

        $user = new User();

        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();
            $files= $file->move(public_path('images'),$name);
            $photo = new Photo();
            $photo->name =$files;
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo ->save();
            $user->photo_id = $photo->id;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');
        $user->password = bcrypt($request->input('password'));


        try{
            $user->save();
            $user->roles()->attach($request->roles);
        }catch (Exception $exception){
            return redirect(route('back.users.create'))->with('warning',$exception->getCode());
        }
        $msg = 'ذخيره كاربر جديد با موفقیت انجام شد :)' ;
        return redirect(route('back.users'))->with('success',$msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $notifications = auth()->user()->notifications;
        $notifications ->markAsread();
        //dd($notifications);
        return view('back.notifications',compact('notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name','id');
        return view('back.users.edit',compact('user','roles'));
//        if (Gate::allows('isAdmin')){
//
//        }else{
//            $msg = 'فقط مدیر به این بخش دسترسی دارد.' ;
//            return back()->with('info',$msg);
//        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        $user = User::findOrFail($user);
        $messages = [
            'email.required' => 'فیلد ایمیل را وارد نمایید',
            'status.required' => 'فيلد وضعيت را وارد نماييد',
            'password.min' => 'رمز عبور بايد بيشتر از 6 كاراكتر باشد',
        ];
        $validateData = $request->validate([
            'email' => 'required',
            'status' => 'required',
            'password' => 'nullable|min:6',
        ],$messages);


        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();
            $files= $file->move(public_path('images'),$name);
            $photo = new Photo();
            $photo->name =$files;
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo ->save();
            $user->photo_id = $photo->id;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');

        if ($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }
        //dd($user);
        try{
            $user->update();
            $user->roles()->sync($request->roles);
        }catch (Exception $exception){
            return redirect(route('back.users.edit'))->with('warning',$exception->getCode());
        }
        $msg = 'ویرایش با موفقیت انجام شد' ;
        return redirect(route('back.users'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user)
    {
        if (Gate::allows('isAdmin')){
            if ($user->photo_id){
                $photo = Photo::findOrFail($user->photo_id);
                unlink(public_path(). $user->photo->path);
                $photo->delete();
            }
            $user -> delete();
            $msg = "كاربر مورد نظر حذف شد";
            return redirect(route('back.users'))->with('success',$msg);
        }else{
            $msg = 'فقط مدیر می  تواند کاربری را حذف کند.' ;
            return route('back.users')->with('info',$msg);
        }
    }

    public function updatestatus(User $user)
    {
        if (Gate::allows('isAdmin')){
            if ($user->status==1)
            {
                $user->status = 0;
            }else
            {
                $user->status = 1;
            }
            $user->save();
            $msg = "بروزرسانی با موفقیت انجام شد :)";
            return redirect(route('back.users'))->with('success',$msg);
        }else{
            $msg = 'فقط مدیر می  تواند وضعیت کاربر را تغییر دهد.' ;
            return back()->with('info',$msg);
        }

    }
    public function profile(User $user)
    {
        $teammate = Teammate::where('user_id',$user->id)->first();
        //dd($teammate);
        return view('back.users.profile',compact('user','teammate'));
    }

    public function userSearch(Request $request)
    {
        $query = $request->input('roles');

        $users = User::whereHas('roles' , function($q) use ($query) {
            $q->where('role_id', 'like' , '%'.$query.'%');
        })->paginate(20);


        $roles = Role::all()->pluck('name','id');
        return view('back.users.search',compact('users','query','roles'));
    }

}
