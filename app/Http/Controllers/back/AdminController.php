<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
//        $notifications = auth()->user()->unreadnotifications;
//        $notifications ->markAsread();
//        $countnotif =$notifications->count();
        //dd($notifications);

//        $postcount = Post::count();
//        $photocount = Photo::count();
//        $usercount = User::count();
//        $categoriescount = Category::count();
//        $contactscount = Contact::count();
//        $posts = Post::orderBy('created_at', 'DESC')->limit(5)->get();
//        $users = User::orderBy('created_at' , 'DESC')->limit(5)->get();
//        $comments = Comment::orderBy('created_at' , 'DESC')->limit(5)->get();
//        $contacts = Contact::orderBy('created_at' , 'DESC')->limit(5)->get();
//        $products = Product::orderBy('created_at','DESC')->limit(5)->get();
        return view('back.main');
    }
}
