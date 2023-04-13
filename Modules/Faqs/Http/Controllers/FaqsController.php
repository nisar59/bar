<?php

namespace Modules\Faqs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faqs\Entities\Faqs;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $faqs=Faqs::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($faqs)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('faqs.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/faqs/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
            if(Auth::user()->can('faqs.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/faqs/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
             ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/faqs/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/faqs/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('faqs::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('faqs::create');
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
           'description'=>'required', 
        ]);
        DB::beginTransaction();
        try{
        Faqs::create($req->except('_token'));
        DB::commit();
         return redirect('admin/faqs')->with('success','FAQs successfully created');
         
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
        return view('faqs::show');
    }


    public function status($id)
    {
        DB::beginTransaction();
        try{
        $page=Faqs::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/faqs')->with('success','FAQs status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $faq=Faqs::find($id);
        return view('faqs::edit',compact('faq'));
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
        Faqs::find($id)->update($req->except('_token'));
        DB::commit();
         return redirect('admin/faqs')->with('success','FAQs successfully updated');
         
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
        Faqs::find($id)->delete();
        DB::commit();
         return redirect('admin/faqs')->with('success','FAQs successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
