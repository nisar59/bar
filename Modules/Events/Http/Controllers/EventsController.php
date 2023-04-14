<?php

namespace Modules\Events\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Events\Entities\Events;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $events=Events::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($events)
           ->addColumn('action',function ($row){
               $action='';
                if(Auth::user()->can('events.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/events/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
            }
                if(Auth::user()->can('events.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/events/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
               return $action;
           })
           ->addColumn('image', function ($row) {
                    /*floder name*/                    
                    $path=public_path('images');
                    /*floder name*/
                    $url=url('images');
                    $img=$url.'/images.png';
                    if(file_exists($path.'/events/'.$row->image) AND $row->image!=null){
                    $img=$url.'/events/'.$row->image;
                    }

                    return '<img src="'.$img.'" height="50" width="50">';
                })
             ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/events/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/events/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })
           ->rawColumns(['action','image','status'])
           ->make(true);
        }
        return view('events::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('events::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
         $req->validate([
           'event_type'=>'required', 
           'title'=>'required', 
           'description'=>'required', 
           'image'=>'required', 
           'info_link'=>'required', 
           'ticket_link'=>'required', 
           'facebook_link'=>'required', 
        ]);
        DB::beginTransaction();
        try{
            $path=public_path('images/events');
            $inputs=$req->except('_token');
            $inputs['image']=FileUpload($req->image, $path);
        Events::create($inputs);
        DB::commit();
         return redirect('admin/events')->with('success','Events successfully created');
         
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
        return view('events::show');
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
        $page=Events::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/events')->with('success','Events status successfully updated');
         
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
        $events=Events::find($id);
        return view('events::edit',compact('events'));
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
           'events'=>'required', 
           'title'=>'required', 
           'description'=>'required', 
           'info_link'=>'required', 
           'ticket_link'=>'required', 
           'facebook_link'=>'required', 
        ]);
        DB::beginTransaction();
        try{
            $path=public_path('images/events');
            $inputs=$req->except('_token');
            if($req->image!=null){
                $inputs['image']=FileUpload($req->image, $path);
            }
        Events::find($id)->update($inputs);
        DB::commit();
         return redirect('admin/events')->with('success','Events successfully updated');
         
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
        $events=Events::find($id);
        if($events->delete()){
        return redirect('admin/events')->with('success', 'Events successfully Deleted');
 
        }
    }
}
