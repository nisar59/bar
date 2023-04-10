<?php

namespace Modules\TablesReservation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TablesReservation\Entities\TablesReservation;
use DataTables;
use Throwable;
use Auth;
use DB;
class TablesReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        if (request()->ajax()) {
        $table_reservation=TablesReservation::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($table_reservation)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('tables-reservation.edit')){
                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/tables-reservation/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';

                }
                if(Auth::user()->can('tables-reservation.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/tables-reservation/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })

           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/tables-reservation/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/tables-reservation/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           ->rawColumns(['action','status'])
           ->make(true);
        }


        return view('tablesreservation::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tablesreservation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
        'name' => 'required',
        'guests' => 'required',        
        'price' => 'required',
        'time_from' => 'required',
        'time_to' => 'required',
        ]);

        DB::beginTransaction();
        try{

            $table_reservation=TablesReservation::whereTime('time_to','>=',$req->time_from)->orWhereTime('time_to','>=', $req->time_to);
            if($table_reservation->count()>0){
            return redirect()->back()->withInput()->with('error','There is an other table available in this time slot');
            }

            $inputs=$req->except('_token');
            $inputs['status']=1;
        $table_reservation=TablesReservation::create($inputs);

        DB::commit();
         return redirect('admin/tables-reservation')->with('success','Table successfully created');
         
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
        return view('tablesreservation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $table_reservation=TablesReservation::find($id);
        return view('tablesreservation::edit')->withData($table_reservation);;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $req->validate([
        'name' => 'required',
        'guests' => 'required',        
        'price' => 'required',
        'time_from' => 'required',
        'time_to' => 'required',
        ]);

        DB::beginTransaction();
        try{

            $table_reservation=TablesReservation::where('id','!=',$id)->where(function($qry) use ($req)
            {
               $qry->whereTime('time_to','>=',$req->time_from);
               $qry->orWhereTime('time_to','>=', $req->time_to);
            });


            if($table_reservation->count()>0){
            return redirect()->back()->withInput()->with('error','There is an other table available in this time slot');
            }

            $inputs=$req->except('_token');

        $table_reservation=TablesReservation::find($id)->update($inputs);

        DB::commit();
         return redirect('admin/tables-reservation')->with('success','Table successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */

    public function status($id)
    {
        DB::beginTransaction();
        try{
        $page=TablesReservation::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/tables-reservation')->with('success','Table status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
        TablesReservation::find($id)->delete();
        DB::commit();
         return redirect('admin/tables-reservation')->with('success','Table successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

}
