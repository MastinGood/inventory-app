<?php
use Carbon\Carbon;
use App\User;
use App\Profile;
       function ParseDate($date)
      {
             return Carbon::parse($date)->format("M d, Y");
      }
      function nameUser($id)
      {
            return User::find($id);
      }
      function getimage(){
        $pro = Profile::where('userid', auth()->user()->id)->first();

        if(!empty($pro) && $pro !==null){
        	return $pro->photo;
        }
        else{
        	return null;
        }

    }

