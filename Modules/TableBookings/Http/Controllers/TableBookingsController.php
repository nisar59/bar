<?php

namespace Modules\TableBookings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Extras\Entities\Extras;
use Modules\TableBookings\Entities\TableBookings;
use Modules\SittingStructure\Entities\StructureTables;
use Modules\Sittings\Entities\SittingTables;
use Modules\Sittings\Entities\Sittings;
use App\Mail\UserTableBooking;
use DataTables;
use Throwable;
use Mail;
use Auth;
use DB;
use Carbon\Carbon;
class TableBookingsController extends Controller
{

    function __construct()
    {
        $bkngs=TableBookings::whereDate('booking_date','<',now());
        if($bkngs->count()>0){
        DB::beginTransaction();

        try {
            $bkngs->update(['status'=>1]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        } catch (Throwable $e){
            DB::rollback();
        }
    }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $table_booking=TableBookings::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($table_booking)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('table-bookings.view')){
               $action.='<a class="btn btn-success btn-sm m-1 show-details" href="javascript:void(0)" data-href="'.url('admin/table-bookings/show/'.$row->id).'"><i class="fas fa-eye"></i></a>';    
                }

               if(Auth::user()->can('table-bookings.edit')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/table-bookings/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';    
                }
               return $action;
           })
             ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-info btn-sm m-1" href="'.url('admin/table-bookings/status/'.$row->id).'">Served</a>';
                }else{
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/table-bookings/status/'.$row->id).'">Actived</a>';                
           }
               return $status;
           })

             ->editColumn('user_id',function($row)
             {
                 return User($row->user_id);
             })
             ->addColumn('user_email',function($row)
             {
                if(UserDetail($row->user_id)!=null){
                 return UserDetail($row->user_id)->email;
                }
             })

             ->editColumn('sitting_id',function($row)
             {
                $sitt='';
                 if($row->sitting()->exists()){
                    $sitt.=Carbon::parse($row->sitting->time_from)->format('h:i A');
                 }

                 return $sitt;
             })

             ->editColumn('booking_date',function($row)
             {
                 return Carbon::parse($row->booking_date)->format('d-m-Y');
             })

             ->editColumn('table_id',function($row)
             {
                $tlb='Guests ';
                 if($row->table()->exists() && $row->table->table()->exists()){
                    $tlb.=$row->table->table->guests;
                    $tlb.=' (';
                    $tlb.=$row->table->table->name;
                    $tlb.=')';
                 }
                 
                 return $tlb;
             })

           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('tablebookings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $req)
    {
        if(!Auth::check()){
            session()->put('redirect-url', url()->current());
            return redirect('user-login');
        }

        $get_unpaid=TableBookings::where('user_id', Auth::user()->id)->where('payment_status', 0);

        if($get_unpaid->count()>0){
            $get_unpaid->delete();
        }
        $guests=$req->guests;
        $extras=Extras::where('status',1)->get();
        $table_booking=TableBookings::whereDate('booking_date', $req->date)->where('payment_status',1)->get();

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

        $total=0;

        if($req->extras!=null){
        $ext=Extras::whereIn('id', $req->extras)->get();
        foreach($ext as $ex){
            $total=(int)$total + (int) $ex->price;
            }
        }


        $sitt_tbl=SittingTables::where('table_id', $req->table)->where('sitting_id', $req->sitting)->first(); 

        $total=(int)$total + (int) $sitt_tbl->price;




        $inputs['user_id']=Auth::user()->id;
        $inputs['sitting_id']=$req->sitting;
        $inputs['table_id']=$req->table;
        $inputs['extras_ids']=$req->extras;
        $inputs['amount']=$total;
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


    public function postsuccess($id)
    {
        try {
            $book_table=TableBookings::find($id);
            $book_table->payment_status=1;
            $book_table->save();
        DB::commit();

        Mail::to(Settings()->portal_email)->send(new UserTableBooking($book_table));

         return redirect('table-bookings/success/'.$id);
         } catch(Exception $e){
            DB::rollback();
            return redirect('/')->with('error','Something went wrong with this error, please contact admin: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect('/')->with('error','Something went wrong with this error, please contact admin: '.$e->getMessage());
         }

    }


    public function success($id)
    {
        $book_table=TableBookings::find($id);
       return view('tablebookings::success')->withData($book_table);
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $res=[
            'success'=>false,
            'message'=>null,
            'html'=>null,
        ];

        try {
        $table_book=TableBookings::find($id);
        $res['success']=true;
        $res['message']='Table Booking detail successfully fetched';
        $res['html']=view('tablebookings::show')->withData($table_book)->render();
        return response()->json($res);

        } catch (Exception $e) {
            $res['success']=false;
            $res['message']='Something went wrong with this error: '.$e->getMessage();
        return response()->json($res);
        } catch (Throwable $e){
            $res['success']=false;
            $res['message']='Something went wrong with this error: '.$e->getMessage();            
        return response()->json($res);
        }
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function usershow($id)
    {
        $res=[
            'success'=>false,
            'message'=>null,
            'html'=>null,
        ];

        try {
        $table_book=TableBookings::find($id);
        $res['success']=true;
        $res['message']='Table Booking detail successfully fetched';
        $res['html']=view('tablebookings::user-show')->withData($table_book)->render();
        return response()->json($res);

        } catch (Exception $e) {
            $res['success']=false;
            $res['message']='Something went wrong with this error: '.$e->getMessage();
        return response()->json($res);
        } catch (Throwable $e){
            $res['success']=false;
            $res['message']='Something went wrong with this error: '.$e->getMessage();            
        return response()->json($res);
        }
    }


     /**
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $page=TableBookings::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/table-bookings')->with('success','Table Booking status successfully updated');
         
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
        DB::beginTransaction();
        try{
        TableBookings::find($id)->delete();
        DB::commit();
         return redirect('admin/table-bookings')->with('success','Table Booking successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
