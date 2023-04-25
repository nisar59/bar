<?php

namespace Modules\Extras\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Extras\Entities\Extras;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $extras=Extras::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($extras)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('extras.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/extras/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('extras.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/extras/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/extras/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/extras/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           ->editColumn('price', function($row)
           {
              return '£ '.number_format($row->price);
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('extras::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('extras::create');
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
           'price'=>'required', 
           'description'=>'required', 
        ]);
        DB::beginTransaction();
        try{
        Extras::create($req->except('_token'));
        DB::commit();
         return redirect('admin/extras')->with('success','Extras successfully created');
         
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
        return view('extras::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
      $extra=Extras::find($id);
        return view('extras::edit',compact('extra'));
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
           'price'=>'required', 
           'description'=>'required', 
        ]);
            DB::beginTransaction();
        try{
        Extras::find($id)->update($req->except('_token'));
        DB::commit();
         return redirect('admin/extras')->with('success','Extras successfully updated');
         
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
        $page=Extras::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/extras')->with('success','Extras status successfully updated');
         
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
        Extras::find($id)->delete();
        DB::commit();
         return redirect('admin/extras')->with('success','Extras successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
