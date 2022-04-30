<?php

namespace App\Http\Controllers\front;


use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Exception;


class PortfolioController extends Controller
{

    public function index()
    {

    }


    public function show(Portfolio $portfolio)
    {
        return view('front.portfolios',compact('portfolio'));
    }


}
