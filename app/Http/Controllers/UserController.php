<?php

namespace App\Http\Controllers;

use App\frontmodels\Photo;
use App\frontmodels\Product;
use App\frontmodels\Coupon;
use App\frontmodels\Protranslate;
use App\Mail\ContactSent;
use App\Mail\ProfileEdit;
use App\frontmodels\Banneruser;
use App\frontmodels\Ad;
use App\Models\Message;
use App\Notifications\Couponsent;
use Ghasedak\GhasedakApi;
use Illuminate\Http\Request;
use App\frontmodels\User;
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
        $coupon = Coupon::where('status' , 1)->first();
        return view('front.dashboard.dashboard',compact('user','coupon'));
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

    public function rateToCoupon(Request $request)
    {
        $messages = [
            'rate.required' => ' لطفا اگر کوپن تخفیف دارید وارد نمایید',
        ];
        $validateData = $request->validate([
            'rate' => 'required',
        ], $messages);

        $coupon = new Coupon();
        if (Auth::user()->rate>=50) {
            $user = Auth::user();
            $rate = $user->rate;
            $coupon->code = $rate+rand();
            $coupon->price = $rate*1000;
            $coupon->title = $user->name;
            $coupon->status = 1;

            //$coupon->user()->attach($coupon);
            //dd($coupon);
            try{
                $coupon->save();
            }catch (Exception $exception){
                return back()->with('warning',$exception->getCode());
            }
            $msg ='امتیاز شما با موفقیت به کد تخفیف تبدیل شد' ;
            return back()->with('success',$msg);
        }
        else{
            $msg = 'امتیاز شما برای تبدیل به کد تخفیف کم است' ;
            return back()->with('warning',$msg);
        }

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

//        $site = 'yabane.ir';
//        if ($user->mobile){
//            try{
//                $receptor = $user->mobile;
//                $type = 1;
//                $template = "Couponsent";
//                $param1 = $user->name;
//                $param2 = $coupon->code;
//
//                $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
//                $api->Verify($receptor, $type, $template, $param1,$param2);
//            }
//            catch(\Ghasedak\Exceptions\ApiException $e){
//                echo $e->errorMessage();
//            }
//            catch(\Ghasedak\Exceptions\HttpException $e){
//                echo $e->errorMessage();
//            }
//        }
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

    public function dashboard()
    {
        $user = Auth::user();
        $coupon = Coupon::where('status' , 1)->orderBy('created_at','DESC')->first();
        $bannerusers = Banneruser::first();
        $ads = Ad::orderBy('id','DESC')->paginate(2);
        $adset = Ad::first();

//        if ($user) {
//            for($i=0; $i<count($products); $i++) {
//                $messages = Message::with('product')->where('product_id', $products[$i]->id)->where('read', 0)->get();
//                $messageset = Message::with('product')->where('product_id', $products[$i]->id)->where('read', 0)->first();
//
//            }
//
//        }
        if ($user){
            $messages = Message::with('product')->where('read', 0)->get();
            $messageset = Message::where('read', 0)->first();
        }


//            $product = Product::whereIn('id', $messages)->where('user_id', $user->id)
//                ->where('status', 12)
//                ->where('status', '<>', 7)
//                ->where('status', '<>', 11)
//                ->where('status', '<>', 10)
//                ->where('status', '<>', 9)
//                ->where('status', '<>', 8)
//                ->where('status', '<>', 5)
//                ->where('status', '<>', 4)
//                ->where('status', '<>', 3)->get();
//        dd($product);
        return view('front.dashboard.dashboard',compact('user','coupon','bannerusers','ads','adset','messages','messageset'));

    }
    public function notification()
    {
        $user = Auth::user();
        $notifications = auth()->user()->notifications;
        $notifications ->markAsread();
       // dd($notifications);
        return view('front.dashboard.notifications',compact('notifications','user'));
    }





//    public function userNotifications()
//    {
//        return response()->json(\auth()->user()->unreadNotification(), Response::HTTP_OK);
//    }

    public function wallet()
    {
        $user = Auth::user();
        return view('front.dashboard.wallets',compact('user'));
    }
    public function walletform()
    {
        $user = Auth::user();
        return view('front.dashboard.wallets',compact('user'));
    }

}
