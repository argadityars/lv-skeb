<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
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
        //Retrieve data of user profile
        $profile = Profile::where('user_id', Auth::user()->id)->first();

        //If user not exist go to create page
        if (!$profile) {
            return $this->create();
        }

        return view('profiles.index', [
            'profile' => $profile,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = new Profile;
        $provinces = DB::table('provinces')->pluck('name', 'id');
        $cities = DB::table('regencies')->pluck('name', 'id');

        return view('profiles.create', [
            'profile' => $profile,
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
    public function store(\App\Http\Requests\ProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            # Saving User
            $user = Auth::user();
            $user->update(['name' => $request->input('name')]);

            # Saving Profile
            $profile = new Profile($request->all());
            $user->profile()->save($profile);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return abort(500);
        }
        return redirect()->route('profile.index')->with('message', trans('messages.create success', ['object' => 'Profile']));
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
        $profile = Profile::where('user_id', Auth::user()->id)->firstOrFail();
        $provinces = DB::table('provinces')->pluck('name', 'id');
        $cities = DB::table('regencies')->where('province_id', $profile->province_id)->pluck('name', 'id');

        return view('profiles.edit', [
            'profile' => $profile,
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
    public function update(\App\Http\Requests\ProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            # Saving User
            $user = Auth::user();
            $user->update(['name' => $request->input('name')]);

            # Saving Profile
            $user->profile()->update($request->except(['_token', 'name']));

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return abort(500);
        }
        return redirect()->route('profile.index')->with('message', trans('messages.update success', ['object' => 'Profile']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('profiles.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        //Check current password
        if (!\Hash::check($request->input('password'), Auth::user()->password)){
            $error = array('password' => trans('messages.password is different'));
            return redirect()->back()->withErrors($error)->withInput();
        }

        //Validate data
        $validator = $this->validate($request, [
            'password' => 'required|min:6',
            'password-new' => 'required|min:6|confirmed',
        ]);

        //Save new password
        $request->user()->fill([
            'password' => \Hash::make($request->input('password-new'))
        ])->save();

        return redirect()->route('profile.index')->with('message', trans('messages.update success', ['object' => 'Password']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCustomization()
    {
        return view('profiles.customization');
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
            'avatar' => 'image|mimes:jpeg,png',
            'banner' => 'image|mimes:jpeg,png|dimensions:max_width=800,max_height=500'
        ]);

        try {
            # Set
            $profile = Profile::where('user_id', Auth::user()->id)->first();
            $avatar = $request->file('avatar');
            $banner = $request->file('banner');

            //Save to database
            if ($avatar) {
                $avatar_path = $avatar->store('public/images/profile/avatar');
                $profile->avatar = $avatar_path;
                $profile->save();
            }
            if ($banner) {
                $banner_path = $banner->store('public/images/profile/banner');
                $profile->banner = $banner_path;
                $profile->save();    
            }
        } catch (Exception $e) {
            return abort(500);
        }
        
        return redirect()->route('profile.index')->with('message', trans('messages.update success', ['object' => 'Profile']));
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
