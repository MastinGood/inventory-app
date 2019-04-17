<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Type;
use Auth;
use App\User;
use App\Branch;
use DB;
use Hash;
use Carbon\Carbon;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1){
            $types = Type::all();
            $items = Item::all();
            $items_today = Item::whereAddedat(Carbon::now()->format('m/d/Y'))->limit(5)->get();
            $items_today_all = Item::whereAddedat(Carbon::now()->format('m/d/Y'))->get();
            $items_today_count = Item::whereAddedat(Carbon::now()->format('m/d/Y'))->count();
            $items_yesterday = Item::whereAddedat(Carbon::yesterday()->format('m/d/Y'))->limit(5)->get();
            $items_yesterday_all = Item::whereAddedat(Carbon::yesterday()->format('m/d/Y'))->get();
            $items_yesterday_count = Item::whereAddedat(Carbon::yesterday()->format('m/d/Y'))->count();
            $items_month = Item::whereAddedat( Carbon::now()->subMonth()->format('m/d/Y'))->limit(5)->get();
            $items_month_all = Item::whereAddedat( Carbon::now()->subMonth()->format('m/d/Y'))->get();
            $items_month_count = Item::whereAddedat( Carbon::now()->subMonth()->format('m/d/Y'))->count();
            $counts = Item::all()->count();
            $staff = User::all()->count();
            $branch = Branch::whereStatus(1)->count();
            $totals = 0;
            foreach($items as $item){
                $totals += $item->price;
            }
            $total_today = 0;
            foreach($items_today_all as $item_tod){
                $total_today += $item_tod->price;
            }
            $total_yesterday = 0;
            foreach($items_yesterday_all as $item_yes){
                $total_yesterday += $item_yes->price;
            }
            $total_month = 0;
            foreach($items_month_all as $item_mon){
                $total_month += $item_mon->price;
            }
            $latest = Item::orderBy('id', 'DESC')
                        ->whereAddedat(Carbon::now()->format('m/d/Y'))->limit(5)->get();
        }
        else if(Auth::user()->usertype == 'admin' && Auth::user()->status == 0 || Auth::user()->status == 3){
            return view('error.ban');
        }
        else if(Auth::user()->usertype == 'staff' && Auth::user()->status == 0 || Auth::user()->status == 3){
            return view('error.ban');
        }
        else{
        $types = Type::whereBranchid(Auth::user()->branchid)->get();
        $items = Item::whereBranchid(Auth::user()->branchid)->get();
        $counts = Item::whereBranchid(Auth::user()->branchid)->count();
        $staff = User::whereBranchid(Auth::user()->branchid)->count();
        $branch = Branch::whereStatus(1)->count();
        $totals = 0;
        foreach($items as $item){
            $totals += $item->price;
        }
        $total_today = 0;

        $items_today = Item::whereAddedat(Carbon::now()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->limit(5)->get();
        $items_today_all = Item::whereAddedat(Carbon::now()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->get();
        $items_today_count = Item::whereAddedat(Carbon::now()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->count();
        $items_yesterday = Item::whereAddedat(Carbon::yesterday()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->limit(5)->get();
        $items_yesterday_all = Item::whereAddedat(Carbon::yesterday()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->get();
        $items_yesterday_count = Item::whereAddedat(Carbon::yesterday()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->count();
        $items_month = Item::whereAddedat(Carbon::now()->subMonth()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->limit(5)->get();
        $items_month_all = Item::whereAddedat(Carbon::now()->subMonth()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->get();
         $items_month_count = Item::whereAddedat(Carbon::now()->subMonth()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->count();

        $total_today = 0;
        foreach($items_today_all as $item_tod){
            $total_today += $item_tod->price;
        }
        $total_yesterday = 0;
        foreach($items_yesterday_all as $item_yes){
            $total_yesterday += $item_yes->price;
        }
        $total_month = 0;
        foreach($items_month_all as $item_mon){
            $total_month += $item_mon->price;
        }
        $latest = Item::orderBy('id', 'DESC')
                ->whereAddedat(Carbon::now()->format('m/d/Y'))->whereBranchid(Auth::user()->branchid)->limit(5)->get();
        }
        $brans = Branch::whereStatus(1)->limit(5)->get();
        $allbranchtotal = Branch::whereStatus(1)->count();
        return view('dashboard.index', compact('items', 'types', 'totals', 'counts','staff', 'branch','brans','total_today', 'items_yesterday','total_yesterday','items_today', 'items_month','total_month', 'latest', 'allbranchtotal', 'items_today_all', 'items_yesterday_all', 'items_month_all','items_today_count','items_yesterday_count','items_month_count'));
    }
    public function reset(){
         return view('auth.reset');
    }
    public function verify(Request $request){
        $this->validate($request, [
            'email' => 'email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
            ]);
      $user = User::where('email', $request['email'])->first();

        $notification = array(
                'message' => 'Password doesn\'t exist in our database!!',
                'alert-type' => 'danger'
                 );
        if(Hash::check($request['password_confirmation'], $user->password)){
            return view('auth.newpass');
        }else{
            return redirect()->back()->with($notification);
        }

    }
    public function updatepass(Request $request){
        $this->validate($request, [
            'password' => 'required|min:6',
            ]);
        User::where('id', Auth::user()->id)->update(['password' => bcrypt($request['password'])]);
        $notification = array(
                'message' => 'Password successfully updated!',
                'alert-type' => 'success'
                 );
        return redirect()->route('home')->with($notification);
    }
}
