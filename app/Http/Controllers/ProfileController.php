<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
use Carbon\Carbon;
class ProfileController extends Controller
{
    public function updateProfile(Profile $profile,Request $request){
    	$this->validate($request, [
        'name' => 'required|string',
        'gender' => 'required|string',
        'birthdate' => 'required|string',
        'marital_status' => 'required|string',
        'address' => 'required|string',
        'mobile_number' => 'required|numeric',
        'facebook' => 'required|string',
        'skype' => 'required|string',
        'website' => 'required|string',
        'email' => 'required|unique:users,email,'.auth()->user()->id
      ]);
    	User::where('id', auth()->user()->id)->update(['name' => $request['name'], 'email' => $request['email']]);
    	$profile->gender = $request['gender'];
    	$profile->birthdate = $request['birthdate'];
    	$profile->marital_status = $request['marital_status'];
    	$profile->address = $request['address'];
    	$profile->mobile_number = $request['mobile_number'];
    	$profile->facebook = $request['facebook'];
    	$profile->skype = $request['skype'];
    	$profile->website = $request['website'];
    	$profile->save();

    	$notification = array(
            'message' => 'Your profile successfully updated.',
            'alert-type' => 'success'
        );
            return redirect()->back()->with($notification);

    }
    public function changePic(Profile $profile, Request $request){
    	 $request->validate([
    	 	'photo' => ['required']
    	 ]);

    	 	if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $ph = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('profile');
            $image->move($destinationPath, $ph);
            $profile->photo= $ph;
            $profile->save();
            $notification = array(
                'message'    => 'Profile picture successfully updated!!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

          }

    }

}
