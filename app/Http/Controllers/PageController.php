<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.auth.home');
    }

    public function books()
    {
        $products = Product::where('status', 1)->all();
        return view('pages.public.books');
    }

    
}
