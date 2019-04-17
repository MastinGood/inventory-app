<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    protected $dates = ['created_at'];
    protected $table = 'items';
    protected $fillable = ['name','price','description','status','photo','type','branchid','addedby','addedat'];
     public function getBranch($id){
        return Branch::where('id', $id)->first();
    }
    public function getType($id){
        return Type::where('id', $id)->first();
    }
    public function getUser($id){
        return User::where('id', $id)->first();
    }

}
