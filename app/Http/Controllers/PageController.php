<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function books(Request $request)
    {
        $products = Product::where('status', 1)->get();
        $categories = DB::table('categories')->pluck('name', 'id');
        $subcategories = DB::table('sub_categories')->pluck('name', 'id');

        if ($request) {
            $products = Product::where('status', '=', '1')
                        ->where([
                            ['name', 'LIKE', '%'.$request->get('q').'%'],
                            $request->get('category_id') ? ['category_id', $request->get('category_id')] : ['category_id', 'LIKE', '%%'],
                            $request->get('subcategory_id') ? ['subcategory_id', $request->get('subcategory_id')] : ['subcategory_id', 'LIKE', '%%'],
                        ])->get();
            $request->flash();
        }

        return view('pages.public.books', [
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    
}
