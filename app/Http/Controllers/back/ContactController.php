<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id','DESC')->with('photo')->paginate(10);
        return view('back.contacts.contacts',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.contacts.create');
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
            'title.required' => ' لطفا فیلد عنوان را وارد نمایید',
            'gmail.required' => ' لطفا فیلد ایمیل را وارد نمایید',
            'linkedin.required' => ' لطفا فیلد linkedin را وارد نمایید',
            'behance.required' => ' لطفا فیلد behance را وارد نمایید',
            'instagram.required' => ' لطفا فیلد instagram را وارد نمایید',
            'btn.required' => ' لطفا فیلد متن دکمه را وارد نمایید',
            'photo_id.required' => ' لطفا فایل مورد نظر را آپلود کنید',

        ];
        $validateData = $request->validate([
            'title' => 'required',
            'gmail' => 'required',
            'linkedin' => 'required',
            'behance' => 'required',
            'instagram' => 'required',
            'btn' => 'required',
            'photo_id' => 'required',
        ],$messages);


        $contact = new Contact();

        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();
            $files= $file->move(public_path('images'),$name);
            $photo = new Photo();
            $photo->name =$files;
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo ->save();
            $contact->photo_id = $photo->id;
        }

        $contact->title = $request->input('title');
        $contact->gmail = $request->input('gmail');
        $contact->linkedin = $request->input('linkedin');
        $contact->behance = $request->input('behance');
        $contact->instagram = $request->input('instagram');
        $contact->btn = $request->input('btn');
        //dd($photos);

        try{

            $contact->save();
        }catch (Exception $exception){
            return redirect(route('back.contacts.create'))->with('warning',$exception->getCode());
        }
        $msg = ' با موفقیت ایجاد شد :)' ;
        return redirect(route('back.contacts'))->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('back.contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $messages = [
            'title.required' => ' لطفا فیلد عنوان را وارد نمایید',
            'gmail.required' => ' لطفا فیلد ایمیل را وارد نمایید',
            'linkedin.required' => ' لطفا فیلد linkedin را وارد نمایید',
            'behance.required' => ' لطفا فیلد behance را وارد نمایید',
            'instagram.required' => ' لطفا فیلد instagram را وارد نمایید',
            'btn.required' => ' لطفا فیلد متن دکمه را وارد نمایید',
            'photo_id.required' => ' لطفا فایل مورد نظر را آپلود کنید',

        ];
        $validateData = $request->validate([
            'title' => 'required',
            'gmail' => 'required',
            'linkedin' => 'required',
            'behance' => 'required',
            'instagram' => 'required',
            'btn' => 'required',
            'photo_id' => 'required',
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
            $contact->photo_id = $photo->id;
        }

        $contact->title = $request->input('title');
        $contact->gmail = $request->input('gmail');
        $contact->linkedin = $request->input('linkedin');
        $contact->behance = $request->input('behance');
        $contact->instagram = $request->input('instagram');
        $contact->btn = $request->input('btn');
        //dd($photos);

        try{

            $contact->save();
        }catch (Exception $exception){
            return redirect(route('back.contacts.edit'))->with('warning',$exception->getCode());
        }
        $msg = ' با موفقیت ویرایش شد :)' ;
        return redirect(route('back.contacts'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        try{
            $contact->delete();
        }catch (Exception $exception){
            return redirect(route('back.contacts'))->with('warning',$exception->getCode());
        }
        $msg = 'تماس كاربر مورد نظر حذف گردید :)' ;
        return redirect(route('back.contacts'))->with('success',$msg);
    }

    public function updatestatus(Contact $contact)
    {
        if ($contact->status==1)
        {
            $contact->status = 0;
        }else
        {
            $contact->status = 1;
        }
        $contact->save();
        $msg = "بروزرسانی با موفقیت انجام شد :)";
        return redirect(route('back.contacts'))->with('success',$msg);
    }
}
