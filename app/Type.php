<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Type extends Model
{
    protected $table = 'types';
    protected $fillable = ['branchid','type','status','userid'];

    public function getName($id){
        return User::where('id', $id)->first();
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function getBranch($id){

        return Branch::where('id', $id)->first();
    }
}
