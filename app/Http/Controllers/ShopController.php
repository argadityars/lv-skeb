<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Shop::where('user_id', Auth::user()->id)->first();

        if (!$shop) {
            return $this->create();
        }

        return view('shops.index', [
            'shop' => $shop,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = new Shop;
        $provinces = DB::table('provinces')->pluck('name', 'id');
        $cities = DB::table('regencies')->pluck('name', 'id');

        return view('shops.create', [
            'shop' => $shop,
            'provinces' => $provinces,
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ShopRequest $request)
    {
        # Saving Shop
        $shop = new Shop($request->all());
        Auth::user()->shop()->save($shop);

        return redirect()->route('shop.index')->with('message', trans('messages.create success', ['object' => 'Shop']));
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
    public function edit()
    {
        //Retrieve data for edit form 
        $shop = Shop::where('user_id', Auth::user()->id)->firstOrFail();
        $provinces = DB::table('provinces')->pluck('name', 'id');
        $cities = DB::table('regencies')->where('province_id', $shop->province_id)->pluck('name', 'id');

        return view('shops.edit', [
            'shop' => $shop,
            'provinces' => $provinces,
            'cities' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ShopRequest $request)
    {
        //Validate data
        $validator = $this->validate($request, [
            'start_day' => 'required_with:end_day|numeric',
            'end_day' => 'required_with:start_day|numeric',
            'start_hour' => 'required_with:start_day',
            'end_hour' => 'required_with:start_hour',
            'note' => 'max:255'
        ]);

        //Update Shop
        $user = Auth::user();
        $user->shop()->update($request->except('_token'));

        return redirect()->route('shop.index')->with('message', trans('messages.update success', ['object' => 'Shop']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCustomization()
    {
        return view('shops.customization');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCustomization(Request $request)
    {
        //Validate request
        $this->validate($request, [
            'photo' => 'image|mimes:jpeg,png',
            'banner' => 'image|mimes:jpeg,png|dimensions:max_width=800,max_height=500'
        ]);

        try {
            # Set
            $shop = Shop::where('user_id', Auth::user()->id)->first();
            $photo = $request->file('photo');
            $banner = $request->file('banner');

            //Save to database
            if ($photo) {
                $photo_path = $photo->store('public/images/shop/photo');
                $shop->photo = $photo_path;
                $shop->save();
            }
            if ($banner) {
                $banner_path = $banner->store('public/images/shop/banner');
                $shop->banner = $banner_path;
                $shop->save();    
            }
        } catch (Exception $e) {
            return abort(500);
        }
        
        return redirect()->route('shop.index')->with('message', trans('messages.update success', ['object' => 'Profile']));
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
