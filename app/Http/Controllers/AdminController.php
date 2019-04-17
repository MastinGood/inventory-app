<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use App\Type;
use App\Item;
use DB;
use Carbon\Carbon;
use Auth;
use PDF;
use App\Log;
class AdminController extends Controller
{
    public function staffIndex(){
        $users = User::whereUsertype('staff')->get();
        return view('admin.staff.index', compact('users'));
    }
    public function staffAdd(){
        $branches = Branch::whereStatus(1)->get();
        return view('admin.staff.add', compact('branches'));
    }
    public function staffStore(Request $request){
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required'],
            'usertype' => ['required', 'string'],
            'status' => ['required', 'numeric'],
            'password' => ['required'],
        ]);
        if($request['usertype'] == 'staff'){
             User::create([
            'branchid' => $request['branchid'],
            'name' => $request['name'],
            'email' => $request['email'],
            'usertype' => $request['usertype'],
            'status' => $request['status'],
            'password' => bcrypt($request['password']),
        ]);

             $notification = array(
            'message' => 'Staff successfully added!!',
            'alert-type' => 'success'
             );
         }else{
                User::create([
                'branchid' => 0,
                'name' => $request['name'],
                'email' => $request['email'],
                'usertype' => "admin",
                'status' => $request['status'],
                'password' => bcrypt($request['password']),
            ]);
            $notification = array(
            'message' => 'Staff successfully added!!',
            'alert-type' => 'success'
             );
         }


        return redirect()->route('staff.index')->with($notification);
    }
     public function staffEdit($id){
        $branches = Branch::whereStatus(1)->get();
        $user = User::findOrFail($id);
        return view('admin.staff.edit', compact('user', 'branches'));
    }
    public function staffUpdate(Request $request, User $staff){
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required'],
            'usertype' => ['required', 'string'],
            'status' => ['required', 'numeric'],
            'branchid' => ['required'],
        ]);

        $staff->name = $request['name'];
        $staff->email = $request['email'];
        $staff->usertype = $request['usertype'];
        $staff->branchid = $request['branchid'];
        $staff->status = $request['status'];
        $staff->save();
        $notification = array(
            'message' => 'Staff successfully updated!!',
            'alert-type' => 'success'
        );
        return redirect()->route('staff.index')->with($notification);
    }
    public function staffDelete($id){
        User::whereId($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Staff successfully removed!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function branchIndex(){
        $branches = Branch::orderBy('id', 'DESC')->get();
        return view('admin.branch.index', compact('branches'));
    }
    public function branchAdd(){
        return view('admin.branch.add');
    }
    public function branchEdit(Branch $branch){
        return view('admin.branch.edit', compact('branch'));
    }
    public function branchStore(Request $request){
        $request->validate([
            'branchname' => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);
        Branch::create([
            'branchname' => $request['branchname'],
            'status' => $request['status']
        ]);
        $notification = array(
            'message' => 'Branch successfully added!!',
            'alert-type' => 'success'
        );
        return redirect()->route('branch.index')->with($notification);
    }
    public function branchUpdate(Branch $branch, Request $request){

        $request->validate([
            'branchname' => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);
        $branch->branchname = $request['branchname'];
        $branch->status = $request['status'];
        $branch->save();
        $user = User::whereBranchid($branch->id)->whereStatus('3')->get();
        foreach($user as $us){
            $uss = User::where('id', $us->id)->update(['status' => 1]);
        }
        $notification = array(
            'message' => 'Branch successfully updated!!',
            'alert-type' => 'success'
        );
        return redirect()->route('branch.index')->with($notification);
    }
    public function branchDelete($id){
        Branch::whereId($id)->update(['status' => 0]);
        $users = User::where('branchid', $id)->where('status', 1)->get();
        foreach($users as $user){
            $us = User::where('id', $user->id)->update(['status' => 3]);
        }
        $notification = array(
            'message' => 'Branch successfully removed!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function adminReport(){
        $types = Type::orderBy('type', 'ASC')->get();
        $items = Item::orderBy('id', 'DESC')->get();
        $counts = Item::all()->count();
        $totals = 0;
        foreach($items as $item){
            $totals += $item->price;
        }
        $brans = 'All';
        $from = Carbon::now()->format('d/m/Y');
        $to = Carbon::now()->format('d/m/Y');
        $branchs = Branch::where('status', 1)->get();
        return view('admin.report.index', compact('items', 'types', 'totals', 'counts', 'branchs','to','from','brans'));
    }
    public function adminReportGenerate(Request $request){
         $method = $request->method();
        if($request->isMethod('POST')){

            $key = $request['date'];
            $date = explode("-", $key);
            $from = Carbon::parse($date[0])->format('m/d/Y');
            $to = Carbon::parse($date[1])->format('m/d/Y');

            $type = $request['type'];
            $branch = $request['branch'];


                if($branch == 'all' && $type == 'all'){

                $brans = 'ALL';
                $items = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus(1)
                           ->get();
                $counts = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus(1)
                           ->count();
                $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                    }
                }
                else if($type == 'all' && $branch != null){
                    $bname = Branch::find($branch);
                    $brans = $bname->branchname;
                $items = Item::whereBetween('addedat', array($from, $to))
                            ->whereBranchid($branch)
                           ->whereStatus(1)
                           ->get();

                $counts = Item::whereBetween('addedat', array($from, $to))
                           ->whereBranchid($branch)
                           ->whereStatus(1)
                           ->count();

                $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                }
                }
                else if($branch == 'all' && $type != null){
                $brans = 'ALL';
                $items = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus(1)
                           ->whereType($type)
                           ->get();
                $counts = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus(1)
                           ->whereType($type)
                           ->count();
                $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                }
                }
                else{
                    $bname = Branch::find($branch);
                     $brans = $bname->branchname;
                    $items = Item::whereBetween('addedat', array($from, $to))
                            ->whereBranchid($branch)
                            ->whereType($type)
                           ->whereStatus(1)
                           ->get();
                $counts = Item::whereBetween('addedat', array($from, $to))
                           ->whereBranchid($branch)
                            ->whereType($type)
                           ->whereStatus(1)
                           ->count();

                $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                }
                }


            $types = Type::orderBy('type', 'ASC')->get();
            $branchs = Branch::whereStatus(1)->get();
             return view('admin.report.index', compact('items', 'types', 'totals', 'counts', 'branchs','brans','from','to'));
         }
    }
    public function summary($id){
        $branch = Branch::findOrFail($id);
        $br = Branch::whereStatus(1)->get();
            $ass = DB::table('items')->whereBranchid($id)->select('id', 'price', DB::raw('SUM(price) as totalassets'))
            ->groupBy('id','price')->orderBy('id', 'DESC')->get();
            $tots = 0;
            foreach($ass as $as){
                $tots += $as->totalassets;
            }
        $brs = Branch::where('status', 1)->get();

            $ass1 = DB::table('items')->whereBranchid($id)->select('id', 'price', DB::raw('COUNT(price) as totalitems'))
            ->groupBy('id','price')->orderBy('id', 'DESC')->get();
            $totz = 0;
            foreach($ass1 as $as1){
                $totz += $as1->totalitems;

            }
        $items = Item::whereBranchid($branch->id)->whereStatus(1)->orderBy('id','DESC')->get();
        $itemscount = Item::whereBranchid($branch->id)->whereStatus(1)->orderBy('id','DESC')->count();
        $staff = User::where('branchid', $id)->count();

        return view('dashboard.summary', compact('branch', 'items', 'tots', 'staff', 'totz','itemscount'));
    }
    public function summaryPDF($id){
        $branch = Branch::findOrFail($id);
        $br = Branch::whereStatus(1)->get();
            $ass = DB::table('items')->whereBranchid($id)->select('id', 'price', DB::raw('SUM(price) as totalassets'))
            ->groupBy('id','price')->orderBy('id', 'DESC')->get();
            $tots = 0;
            foreach($ass as $as){
                $tots += $as->totalassets;
            }
        $brs = Branch::where('status', 1)->get();

            $ass1 = DB::table('items')->whereBranchid($id)->select('id', 'price', DB::raw('COUNT(price) as totalitems'))
            ->groupBy('id','price')->orderBy('id', 'DESC')->get();
            $totz = 0;
            foreach($ass1 as $as1){
                $totz += $as1->totalitems;
            }
        $items = Item::whereBranchid($branch->id)->whereStatus(1)->get();
        $staff = User::whereBranchid($id)->count();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => 'true', 'isJavascriptEnabled' => 'true', 'isPhpEnabled' => 'true']);
        $pdf = PDF::loadView('pdf.index', compact('branch', 'items', 'tots', 'staff', 'totz'));
         return $pdf->download('summary.pdf');

    }
    public function logsIndex(){
        return view('admin.logs.index');
    }
}
