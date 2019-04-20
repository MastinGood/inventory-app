<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['name','price','description','status','item_code','photo','type','branchid','addedby','addedat'];
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
