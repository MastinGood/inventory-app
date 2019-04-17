<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Branch;
use DB;
use Carbon\Carbon;
class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = ['branchname', 'status'];
    public function type(){
        return $this->hasMany(Type::class);
    }
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function getAsset($id){
    	$br = Branch::whereStatus(1)->get();
    	foreach($br as $b){
    		$ass = DB::table('items')->whereBranchid($id)->select('id', 'price', DB::raw('SUM(price) as totalassets'))
	    	->groupBy('id','price')->orderBy('id', 'DESC')->get();
	    	$tots = 0;
	    	foreach($ass as $as){
	    		$tots += $as->totalassets;

	    	}
    	}


    	return $tots;
    }
     public function getItem($id){
    	$br = Branch::whereStatus(1)->get();
    	foreach($br as $b){
    		$ass = DB::table('items')->whereBranchid($id)->select('id', 'price', DB::raw('COUNT(price) as totalitems'))
	    	->groupBy('id','price')->orderBy('id', 'DESC')->get();
	    	$totz = 0;
	    	foreach($ass as $as){
	    		$totz += $as->totalitems;

	    	}
    	}


    	return $totz;
    }
    public function getTodayAsset($id){
      $br = Branch::whereStatus(1)->get();

      foreach($br as $b){
        $ass = DB::table('items')->whereAddedat(Carbon::now()->format('m/d/Y'))->whereBranchid($id)->select('id', 'price', DB::raw('SUM(price) as totalassets'))
        ->groupBy('id','price')->orderBy('id', 'DESC')->get();
        $tots = 0;
        foreach($ass as $as){
          $tots += $as->totalassets;

        }
      }


      return $tots;
    }
    public function getTodayItem($id){
     $br = Branch::where('status', 1)->get();
     foreach($br as $b){
       $ass = DB::table('items')->whereAddedat(Carbon::now()->format('m/d/Y'))->whereBranchid($id)->select('id', 'price', DB::raw('COUNT(price) as totalitems'))
       ->groupBy('id','price')->orderBy('id', 'DESC')->get();
       $totz = 0;
       foreach($ass as $as){
         $totz += $as->totalitems;

       }
     }


     return $totz;
   }
   public function getYesterdayAsset($id){
     $br = Branch::whereStatus(1)->get();

     foreach($br as $b){
       $ass = DB::table('items')->whereAddedat(Carbon::yesterday()->format('m/d/Y'))->whereBranchid($id)->select('id', 'price', DB::raw('SUM(price) as totalassets'))
       ->groupBy('id','price')->orderBy('id', 'DESC')->get();
       $tots = 0;
       foreach($ass as $as){
         $tots += $as->totalassets;

       }
     }


     return $tots;
   }
    public function getYesterdayItem($id){
     $br = Branch::whereStatus(1)->get();
     foreach($br as $b){
       $ass = DB::table('items')->whereAddedat(Carbon::yesterday()->format('m/d/Y'))->whereBranchid($id)->select('id', 'price', DB::raw('COUNT(price) as totalitems'))
       ->groupBy('id','price')->orderBy('id', 'DESC')->get();
       $totz = 0;
       foreach($ass as $as){
         $totz += $as->totalitems;

       }
     }


     return $totz;
   }
   public function getMonthItem($id){
    $br = Branch::whereStatus(1)->get();
    foreach($br as $b){
      $ass = DB::table('items')->whereAddedat(Carbon::now()->subMonth()->format('m/d/Y'))->whereBranchid($id)->select('id', 'price', DB::raw('COUNT(price) as totalitems'))
      ->groupBy('id','price')->orderBy('id', 'DESC')->get();
      $totz = 0;
      foreach($ass as $as){
        $totz += $as->totalitems;

      }
    }


    return $totz;
  }
  public function getMonthAsset($id){
    $br = Branch::whereStatus(1)->get();

    foreach($br as $b){
      $ass = DB::table('items')->whereAddedat(Carbon::now()->subMonth()->format('m/d/Y'))->whereBranchid($id)->select('id', 'price', DB::raw('SUM(price) as totalassets'))
      ->groupBy('id','price')->orderBy('id', 'DESC')->get();
      $tots = 0;
      foreach($ass as $as){
        $tots += $as->totalassets;

      }
    }


    return $tots;
  }

}
