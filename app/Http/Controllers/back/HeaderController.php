<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Header;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = Header::orderBy('created_at','desc')->paginate('20');
        return view('back.headers.headers',compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.headers.create');
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
            'titletop.required' => ' لطفا فیلد عنوان بالا را وارد نمایید',
            'title.required' => ' لطفا فیلد عنوان را وارد نمایید',
            'titlebottom.required' => ' لطفا فیلد عنوان پایین را وارد نمایید',
            'content.required' => ' لطفا content را وارد کنید',
            'description.required' => ' لطفا فیلد متن  درباره ما را وارد نمایید',
            'photo_id.required' => ' لطفا تصویر شاخص را وارد نماييد',

        ];
        $validateData = $request->validate([
            'titletop' => 'required',
            'title' => 'required',
            'titlebottom' => 'required',
            'content' => 'required',
            'description' => 'required',
            'photo_id' => 'required',
        ],$messages);


        $header = new Header();

        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();
            $files= $file->move(public_path('images'),$name);
            $photo = new Photo();
            $photo->name =$files;
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo ->save();
            $header->photo_id = $photo->id;
        }


        $header->titletop = $request->input('titletop');
        $header->title = $request->input('title');
        $header->titlebottom = $request->input('titlebottom');
        $header->content = $request->input('content');
        $header->description = $request->input('description');

        try{
            $header->save();
        }catch (Exception $exception){
            return redirect(route('back.headers.create'))->with('warning',$exception->getCode());
        }
        $msg = 'با موفقیت ایجاد شد :)' ;
        return redirect(route('back.headers'))->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function show(Header $header)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function edit(Header $header)
    {
        return view('back.headers.edit',compact('header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Header $header)
    {
        $messages = [
            'titletop.required' => ' لطفا فیلد عنوان بالا را وارد نمایید',
            'title.required' => ' لطفا فیلد عنوان را وارد نمایید',
            'titlebottom.required' => ' لطفا فیلد عنوان پایین را وارد نمایید',
            'content.required' => ' لطفا content را وارد کنید',
            'description.required' => ' لطفا فیلد متن  درباره ما را وارد نمایید',
            'photo_id.required' => ' لطفا تصویر شاخص را وارد نماييد',

        ];
        $validateData = $request->validate([
            'titletop' => 'required',
            'title' => 'required',
            'titlebottom' => 'required',
            'content' => 'required',
            'description' => 'required',
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
            $header->photo_id = $photo->id;
        }


        $header->titletop = $request->input('titletop');
        $header->title = $request->input('title');
        $header->titlebottom = $request->input('titlebottom');
        $header->content = $request->input('content');
        $header->description = $request->input('description');

        try{
            $header->update();
        }catch (Exception $exception){
            return redirect(route('back.headers.create'))->with('warning',$exception->getCode());
        }
        $msg = 'با موفقیت ایجاد شد :)' ;
        return redirect(route('back.headers'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function destroy(Header $header)
    {
        try{
            $header->delete();
        }catch (Exception $exception){
            return redirect(route('back.headers'))->with('warning',$exception->getCode());
        }
        $msg = 'آیتم مورد نظر حذف گردید :)' ;
        return redirect(route('back.headers'))->with('success',$msg);
    }
}
