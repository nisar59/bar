<?php

namespace Modules\WeaklyEvents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WeaklyEvents\Entities\WeaklyEvents;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class WeaklyEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $weaklyevents=WeaklyEvents::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($weaklyevents)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('weaklyevents.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/weaklyevents/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
               if(Auth::user()->can('weaklyevents.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/weaklyevents/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('image', function ($row) {
                    /*floder name*/                    
                    $path=public_path('images');
                    /*floder name*/
                    $url=url('images');
                    $img=$url.'/images.png';
                    if(file_exists($path.'/w-events/'.$row->image) AND $row->image!=null){
                    $img=$url.'/w-events/'.$row->image;
                    }

                    return '<img src="'.$img.'" height="50" width="50">';
                })
           ->rawColumns(['action','image'])
           ->make(true);
        }
        return view('weaklyevents::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('weaklyevents::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
           'image'=>'required', 
           'description'=>'required', 
        ]);

        DB::beginTransaction();
        try{
            $path=public_path('images/w-events');
            $inputs=$req->except('_token');
            $inputs['image']=FileUpload($req->image, $path);
        WeaklyEvents::create($inputs);
        DB::commit();
         return redirect('admin/weaklyevents')->with('success','Weakly Events successfully created');
         
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
        return view('weaklyevents::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $events=WeaklyEvents::find($id);
        return view('weaklyevents::edit',compact('events'));
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
           'description'=>'required', 
        ]);
         DB::beginTransaction();
        try{
            $path=public_path('images/w-events');
            $inputs=$req->except('_token');
            if($req->image!=null){
                $inputs['image']=FileUpload($req->image, $path);
            }
        WeaklyEvents::find($id)->update($inputs);
        DB::commit();
         return redirect('admin/weaklyevents')->with('success','Weakly Events successfully updated');
         
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
        WeaklyEvents::find($id)->delete();
        DB::commit();
         return redirect('admin/weaklyevents')->with('success','Weakly Events successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
