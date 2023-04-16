<?php

namespace Modules\TableBookings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Extras\Entities\Extras;
use Modules\TableBookings\Entities\TableBookings;
use Modules\SittingStructure\Entities\StructureTables;
use Modules\Sittings\Entities\Sittings;
use Throwable;
use Auth;
use DB;
class TableBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tablebookings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $req)
    {
        $guests=$req->guests;
        $extras=Extras::where('status',1)->get();
        $table_booking=TableBookings::whereDate('booking_date', $req->date)->get();

        $bookings=[];

        foreach ($table_booking as $key => $tb) {
            $bookings[]=$tb->table_id;
        }


        if($guests==null){
        $sitting=Sittings::with('tables.table')->where('status',1)->get();
        }
        else{

        $structure_table=StructureTables::where('guests',$guests)->get('id');
        $tables=[];
        foreach ($structure_table as $key => $value) {
           $tables[]=$value->id;
        }

        $sitting=Sittings::with(['tables'=>function($qry) use($tables)
        {
         $qry->whereIn('table_id',$tables);
        }])->where('status',1)->get();
        }


        return view('tablebookings::create')->withData($sitting)->withExtras($extras)->withBookings($bookings);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {

        $req->validate([
            'table'=>'required',
            'sitting'=>'required'
        ],[
            'table.required'=>'Please select atleast one table to reserve',
            'sitting.required'=>'Please select atleast one table to reserve'
        ]);

        if(!Auth::check()){
            session()->put('redirect-url', url()->current());
            return redirect('user-login');
        }

        if($req->date==null){
            return redirect('table-bookings/create');
        }

        DB::beginTransaction();
        try{
        $inputs['user_id']=Auth::user()->id;
        $inputs['sitting_id']=$req->sitting;
        $inputs['table_id']=$req->table;
        $inputs['extras_ids']=json_encode($req->extras);
        $inputs['booking_date']=$req->date;
        $inputs['payment_status']=0;
        $inputs['status']=0;
        $table_book=TableBookings::create($inputs);
        DB::commit();
         return redirect('table-bookings/checkout/'.$table_book->id);
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $table_book=TableBookings::find($id);
        return view('tablebookings::show')->withData($table_book);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function checkout($id)
    {
        $table_book=TableBookings::with('sitting')->find($id);
        return view('tablebookings::checkout')->withData($table_book);    
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('tablebookings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
