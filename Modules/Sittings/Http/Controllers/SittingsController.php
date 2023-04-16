<?php

namespace Modules\Sittings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SittingStructure\Entities\SittingStructure;
use Modules\Sittings\Entities\Sittings;
use Modules\Sittings\Entities\SittingTables;
use Carbon\Carbon;
use DataTables;
use Throwable;
use Auth;
use DB;
class SittingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
    if (request()->ajax()) {
        $sitting=Sittings::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($sitting)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('sittings.edit')){
                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/sittings/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Auth::user()->can('sittings.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/sittings/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })

           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/sittings/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/sittings/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           ->addColumn('time_from',function ($row){
              return Carbon::parse($row->time_from)->format('h:i A');
           })
           ->addColumn('time_to',function ($row){
              return Carbon::parse($row->time_to)->format('h:i A');
           })

           ->rawColumns(['action','status'])
           ->make(true);
        }



        return view('sittings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $ss=SittingStructure::with(['tables'=>function($qry){
            $qry->where('status',1);
        }])->first();

        return view('sittings::create')->withData($ss);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'time_from'=>'required',
            'time_to'=>'required',
            'price'=>'required|array',
            'price.*'=>'required'
        ]);

        DB::beginTransaction();
        try { 

            if($req->time_to<$req->time_from OR $req->time_to==$req->time_from){
            return redirect()->back()->withInput()->with('error','Time From could not be greater than or equal to Time To');
            }



            $inputs=$req->except('_token','price','tables');
            $inputs['status']=1;

            $sitting=Sittings::create($inputs);

            foreach ($req->tables as $key => $table) {
               SittingTables::create([
                'sitting_id'=>$sitting->id,
                'table_id'=>$table,
                'price'=>$req->price[$key]
               ]);
            }

        DB::commit();
         return redirect('admin/sittings')->with('success','Sitting is created successfully');
         
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
        return view('sittings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $ss=SittingStructure::with(['tables'=>function($qry){
            $qry->where('status',1);
        }])->first();

        $sitting=Sittings::with('tables')->find($id);

        return view('sittings::edit')->withData($ss)->withSitting($sitting);
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
            'name'=>'required',
            'time_from'=>'required',
            'time_to'=>'required',
            'price'=>'required|array',
            'price.*'=>'required'
        ]);

        DB::beginTransaction();
        try { 

            if($req->time_to<$req->time_from OR $req->time_to==$req->time_from){
            return redirect()->back()->withInput()->with('error','Time From could not be greater than or equal to Time To');
            }

            $inputs=$req->except('_token','price','tables');
            $inputs['status']=1;

            $sitting=Sittings::find($id)->update($inputs);

            SittingTables::where('sitting_id',$id)->delete();

            foreach ($req->tables as $key => $table) {
               SittingTables::create([
                'sitting_id'=>$id,
                'table_id'=>$table,
                'price'=>$req->price[$key]
               ]);
            }

        DB::commit();
         return redirect('admin/sittings')->with('success','Sitting is updated successfully');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }



    }



    public function status($id)
    {
        DB::beginTransaction();
        try{
        $sitting=Sittings::find($id);

        if($sitting->status==1){
            $sitting->status=0;
        }
        else{
            $sitting->status=1;
        }
        $sitting->save();
        DB::commit();
         return redirect()->back()->with('success','Sitting status successfully updated');
         
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
    public function destroy($id)
    {

        DB::beginTransaction();
        try{
         Sittings::find($id)->delete();
         SittingTables::where('sitting_id',$id)->delete();
        DB::commit();
         return redirect()->back()->with('success','Sitting deleted successfully');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }    }
}
