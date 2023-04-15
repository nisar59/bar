<?php

namespace Modules\TableBookings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TablesReservation\Entities\TablesReservation;
use Modules\Extras\Entities\Extras;
use Modules\TableBookings\Entities\TableBookings;
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
        $extras=Extras::where('status',1)->get();
        $tables=TablesReservation::where('status',1)->get();
        return view('tablebookings::create')->withData($tables)->withExtras($extras);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req, $id)
    {
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
        $inputs['table_id']=$id;
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
        $table_book=TableBookings::with('table')->find($id);
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
