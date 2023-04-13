<?php

namespace Modules\Caffe\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Caffe\Entities\Caffe;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class CaffeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
           if (request()->ajax()) {
        $caffe=Caffe::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($caffe)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('caffe.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/caffe-menu/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
           if(Auth::user()->can('caffe.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/caffe-menu/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/caffe-menu/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/caffe-menu/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('caffe::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('caffe::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
         $req->validate([
           'title'=>'required', 
           'file'=>'required', 
           'description'=>'required', 
        ]);
        DB::beginTransaction();
        try{
            $path=public_path('caffe-menu');
            $inputs=$req->except('_token');
            $inputs['file']=FileUpload($req->file, $path);
        Caffe::create($inputs);
        DB::commit();
         return redirect('admin/caffe-menu')->with('success','Caffe Menu successfully created');
         
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
        return view('caffe::show');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $caffe=Caffe::find($id);
        return view('caffe::edit',compact('caffe'));
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
        $page=Caffe::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/caffe-menu')->with('success','Caffe Menu status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
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
           'title'=>'required', 
           'description'=>'required', 
        ]);
         DB::beginTransaction();
        try{
            $path=public_path('caffe-menu');
            $inputs=$req->except('_token');
            if($req->file!=null){
                $inputs['file']=FileUpload($req->file, $path);
            }
        Caffe::find($id)->update($inputs);
        DB::commit();
         return redirect('admin/caffe-menu')->with('success','Caffe Menu successfully updated');
         
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
        Caffe::find($id)->delete();
        DB::commit();
         return redirect('admin/caffe-menu')->with('success','Caffe Menu successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
