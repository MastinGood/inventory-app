<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['gender', 'birthdate', 'marital_status', 'address', 'mobile_number', 'facebook', 'skype', 'website'];
    public function users(){
    	return $this->belongsTo('App\User', 'id', 'userid');
    }
    public function getName($id){
    	return User::findOrFail($id);
    }
    public function getDate($date){
    	return Carbon::parse($date)->format("M d, Y");
    }
}
