<?php

namespace App\Http\Controllers;

use App\Mail\ContactSent;
use App\Mail\ProfileEdit;
use App\Notifications\Couponsent;
use Ghasedak\GhasedakApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Trez\RayganSms\Facades\RayganSms;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('front.dashboard.dashboard',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $pagetitle = 'ویرایش اطلاعات شخصی';
        return view('front.dashboard.profile',compact('pagetitle','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        //dd($request);
        $messages = [
            'postcode.required' => 'برای ویرایش پروفایل لطفا کدپستی خود را وارد نمایید',
            'address.required' => 'برای ویرایش پروفایل لطفا آدرس خود را وارد نمایید',
            'phone.required' => 'برای ویرایش پروفایل لطفا شماره تلفن ثابت خود را برای ارائه خدمات بهتر وارد نمایید',

        ];


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
        if ($user->name = $request->name){
            $user->name = $request->name;
        }

        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->jobs = $request->jobs;
        $user->companyname = $request->companyname;
        $user->postcode = $request->postcode;
        $user->address = $request->address;
        $user->code = $request->code;

//        if (trim($request->input('password') != "")){
//            $user->password = bcrypt($request->input('password'));
//        }
        if ($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }


        $roles = $user->roles()->pluck('id')->all();
        $roles = 5 ;
        $user->roles()->attach($roles);


        Mail::to($request->email)
            ->send(new ProfileEdit($request));

        $users = \App\Models\User::whereHas('roles' , function($q){
            $q->where('role_id', '1' );
        })->get();
        $coupon = Coupon::where('title','تخفیف منبع یابی')->first();
        Notification::send($users , new Couponsent($coupon));


        try{
            $user->update();
        }catch (Exception $exception){
            return redirect(route('profileedite'))->with('warning',$exception->getCode());
        }

        $msg = 'ویرایش با موفقیت انجام شد :)' ;
        return redirect(route('profilecheck'))->with('success',$msg);

    }

    public function profile()
    {
        $user = Auth::user();
        $msg = 'ویرایش با موفقیت انجام شد' ;
        return view('front.dashboard.profilecheck',compact('user'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
