<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Auth;
use App\item;
use Carbon\Carbon;
use PDF;
use App\Log;
use App\Branch;
class StaffController extends Controller
{

    public function typeIndex(){
        $types = Type::whereBranchid(Auth::user()->branchid)
                    ->orderBy('id', 'DESC')->get();

        return view('staff.item_type.index', compact('types'));
    }
     public function typeAdd(){
        return view('staff.item_type.add');
    }
    public function typeStore(Request $request){

        $request->validate([
            'type' => ['required', 'string'],
            'status' => ['required', 'numeric']
        ]);

        Type::create([
            'branchid' => Auth::user()->branchid,
            'type'     => $request['type'],
            'status'   => $request['status'],
            'userid'   => Auth::user()->id,
        ]);

         $notification = array(
            'message'    => 'Iten Type successfully added!!',
            'alert-type' => 'success'
        );

         // $log = new Log;
         // $log->addedby = Auth::user()->name;
         // $log->branch = $this->getBranch(Auth::user()->branchid)->branchname;
         // $log->description = Auth::user()->name." just added a new item type";
         // $log->addedat = Carbon::now()->format('d-m-Y');
         // $log->any = $request['type'];
         // $log->save();

         return redirect()->route('type.index')->with($notification);
    }
    public function typeEdit(Type $type){

        return view('staff.item_type.edit' ,compact('type'));
    }
    public function typeUpdate(Type $type, Request $request){
         $request->validate([
            'type'   => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);

        $type->type   = $request['type'];
        $type->status = $request['status'];
        $type->save();

         $notification = array(
            'message'    => 'Item Type successfully updated!!',
            'alert-type' => 'success'
        );
        return redirect()->route('type.index')->with($notification);
    }
    public function typeDelete($id){

        Type::whereId($id)->update(['status' => 0]);
        $notification = array(
            'message'    => 'Item Type successfully removed!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function itemIndex(){
       $items = Item::whereStatus(1)->orderBy('id', 'DESC')
                    ->whereBranchid(Auth::user()->branchid)
                    ->get();
       return view('staff.item.index', compact('items'));
    }
    public function itemAdd(){
        $types = Type::whereBranchid(Auth::user()->branchid)
                     ->whereStatus(1)
                     ->get();
        return view('staff.item.add', compact('types'));
    }
    public function itemStore(Request $request){
        $this->validate($request, [
        'name' => 'required|string',
        'description' => 'required|string',
        'type' => 'required|string',
        'price' => 'required|integer',
        'status' => 'required|integer',
      ]);
         if ($request->hasFile('photo')) {

            $image = $request->file('photo');
            $ph = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $image->move($destinationPath, $ph);

               Item::create([
                'branchid'         => Auth::user()->branchid,
                'name'             => $request['name'],
                'description'      => $request['description'],
                'type'             => $request['type'],
                'photo'            => $ph,
                'price'            => $request['price'],
                'status'           => $request['status'],
                'addedby'          => Auth::user()->id,
                'addedat'          => Carbon::now()->format('m/d/Y'),
            ]);

          }

        $notification = array(
            'message'    => 'Item successfully added!!',
            'alert-type' => 'success'
        );
        return redirect()->route('items.index')->with($notification);
    }
    public function itemEdit(Item $item){
         $types = Type::whereBranchid(Auth::user()->branchid)->get();
        return view('staff.item.edit', compact('item','types'));
    }
    public function itemUpdate(Item $item, Request $request){
        $this->validate($request, [
        'name' => 'required|string',
        'description' => 'required|string',
        'type' => 'required|string',
        'price' => 'required|integer',
        'status' => 'required|integer',
      ]);
          if ($request->hasFile('photo')) {

            $image = $request->file('photo');
            $ph = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $image->move($destinationPath, $ph);
            $item->photo = $ph;
            $item->save();

            $item->branchid = Auth::user()->branchid;
            $item->addedby = Auth::user()->id;
            $item->name = $request['name'];
            $item->description = $request['description'];
            $item->type = $request['type'];
            $item->price = $request['price'];
            $item->status = $request['status'];
            $item->save();
    }
    else{
            $item->branchid = Auth::user()->branchid;
            $item->addedby = Auth::user()->id;
            $item->name = $request['name'];
            $item->description = $request['description'];
            $item->type = $request['type'];
            $item->price = $request['price'];
            $item->status = $request['status'];
            $item->save();
    }
    $notification = array(
            'message'    => 'Item successfully updated!!',
            'alert-type' => 'success'
        );
        return redirect()->route('item.index')->with($notification);
    }
    public function itemDelete($id){
        Item::where('id', $id)->update(['status' => 0]);

        $notification = array(
            'message'    => 'Item Type successfully removed!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function itemSearch(Request $request){
    $method = $request->method();
    if($request->isMethod('POST')){
        $keyword = $request['search'];
        $date = explode("-", $keyword);
        $from = Carbon::parse($date[0])->format('m/d/Y');
        $to = Carbon::parse($date[1])->format('m/d/Y');
        $items = Item::whereBetween('addedat', array($from, $to))->get();
         return view('staff.item.index', compact('items'));
    }
    else{
        $items = Item::where('status' , 1 )->orderBy('id', 'DESC')->get();
       return view('staff.item.index', compact('items'));
         }
    }
    public function reportIndex(){

        $types = Type::whereBranchid(Auth::user()->branchid)->get();
        $items = Item::whereBranchid(Auth::user()->branchid)->orderBy('id', 'DESC')->get();
        $counts = Item::whereBranchid(Auth::user()->branchid)->count();
        $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                }
        return view('staff.report.index', compact('items', 'types', 'totals', 'counts'));
    }
    public function reportGenerate(Request $request){
        $method = $request->method();
        if($request->isMethod('POST')){
            $key = $request['date'];
            $date = explode("-", $key);
            $from = Carbon::parse($date[0])->format('m/d/Y');
            $to = Carbon::parse($date[1])->format('m/d/Y');
            $item_key = $request['key_item'];
            $stat = $request['stat'];
            if($item_key == "all"){
                 $items = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus($stat)
                           ->whereBranchid(Auth::user()->branchid)
                           ->get();
                $counts = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus($stat)
                           ->whereBranchid(Auth::user()->branchid)
                           ->count();
                $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                }
            }
            else{
                 $items = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus($stat)
                           ->whereBranchid(Auth::user()->branchid)
                           ->whereType($item_key)
                           ->get();
                $counts = Item::whereBetween('addedat', array($from, $to))
                           ->whereStatus($stat)
                           ->whereBranchid(Auth::user()->branchid)
                           ->whereType($item_key)
                           ->count();
                $totals = 0;
                foreach($items as $item){
                    $totals += $item->price;
                }

            }

            $types = Type::whereBranchid(Auth::user()->branchid)->get();
             return view('staff.report.index', compact('items', 'types', 'totals', 'counts'));
        }

    // }
    // public function generatePDF(Request $request){

    //     $data = ['title' => $request->input('stat')];

    //     // $pdf = PDF::loadView('staff.myPdf', $data);
    //     // return $pdf->download('itsolutionstuff.pdf');
    // }
    }
     // public function getBranch($id){
     //        return Branch::where('id', $id)->first();
     //    }
}
