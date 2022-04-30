<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Listmenu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Listmenu::orderBy('created_at','desc')->paginate(10);
        return view('back.lists.lists',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.lists.create');
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
        ];
        $validateData = $request->validate([
            'title' => 'required',
        ],$messages);


        $list = new Listmenu();
        $list->title = $request->input('title');

        try{
            $list->save();
        }catch (Exception $exception){
            return redirect(route('back.lists.create'))->with('warning',$exception->getCode());
        }
        $msg = ' با موفقیت ایجاد شد ' ;
        return redirect(route('back.lists'))->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listmenu  $listmenu
     * @return \Illuminate\Http\Response
     */
    public function show(Listmenu $listmenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listmenu  $listmenu
     * @return \Illuminate\Http\Response
     */
    public function edit(Listmenu $listmenu)
    {
        return view('back.lists.edit',compact('listmenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listmenu  $listmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listmenu $listmenu)
    {
        $messages = [
            'title.required' => ' لطفا فیلد عنوان را وارد نمایید',
        ];
        $validateData = $request->validate([
            'title' => 'required',
        ],$messages);

        $listmenu->title = $request->input('title');

        try{
            $listmenu->update();
        }catch (Exception $exception){
            return redirect(route('back.lists.edit'))->with('warning',$exception->getCode());
        }
        $msg = ' با موفقیت ایجاد شد ' ;
        return redirect(route('back.lists'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listmenu  $listmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listmenu $listmenu)
    {
        try{
            $listmenu->delete();
        }catch (Exception $exception){
            return redirect(route('back.lists'))->with('warning',$exception->getCode());
        }
        $msg = 'آیتم مورد نظر حذف گردید :)' ;
        return redirect(route('back.lists'))->with('success',$msg);
    }
}
