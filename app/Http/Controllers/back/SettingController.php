<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')){
            $settings = Setting::orderBy('id','DESC')->paginate(10);
            return view('back.settings.settings',compact('settings'));
        }else{
            $msg = 'فقط مدیر به این بخش دسترسی دارد' ;
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
        if (Gate::allows('isAdmin')){
            return view('back.settings.create');
        }else{
            $msg = 'فقط مدیر به این بخش دسترسی دارد' ;
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
        $messages = [

        ];
        $validateData = $request->validate([

        ],$messages);


        $setting = new Setting();

        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();
            $files= $file->move(public_path('images'),$name);
            $photo = new Photo();
            $photo->name =$files;
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo ->save();
            $setting->photo_id = $photo->id;
        }


        $setting->copyright = $request->input('copyright');
        $setting->sitename = $request->input('sitename');
//dd($post);

        try{
            $setting->save();
        }catch (Exception $exception){
            return redirect(route('back.settings.create'))->with('warning',$exception->getCode());
        }
        $msg = 'تنظیمات با موفقیت ایجاد شد :)' ;
        return redirect(route('back.settings'))->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        if (Gate::allows('isAdmin')){
            return view('back.settings.edit',compact('setting'));
        }else{
            $msg = 'فقط مدیر اجازه حذف دارد' ;
            return back()->with('info',$msg);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $messages = [


        ];
        $validateData = $request->validate([

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
            $setting->photo_id = $photo->id;
        }


        $setting->copyright = $request->input('copyright');
        $setting->sitename = $request->input('sitename');
//dd($post);

        try{
            $setting->update();
        }catch (Exception $exception){
            return redirect(route('back.settings.edit'))->with('warning',$exception->getCode());
        }
        $msg = 'تنظیمات با موفقیت ویرایش شد :)' ;
        return redirect(route('back.settings'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        try{
            $setting->delete();
        }catch (Exception $exception){
            return redirect(route('back.settings'))->with('warning',$exception->getCode());
        }
        $msg = 'آیتم مورد نظر حذف گردید :)' ;
        return redirect(route('back.settings'))->with('success',$msg);
    }
}
