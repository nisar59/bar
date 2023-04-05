<?php

namespace Modules\Events\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Events\Entities\Events;
use Yajra\DataTables\Facades\DataTables;
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
               $action.='<a class="btn btn-primary btn-sm" href="'.url('events/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('events/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
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
           ->rawColumns(['action','image'])
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
           's_event'=>'required', 
           'title'=>'required', 
           'description'=>'required', 
           'image'=>'required', 
           'info_link'=>'required', 
           'ticket_link'=>'required', 
           'face_link'=>'required', 
        ]);
        $path=public_path('images/events');
        $events=Events::create([
           'image'=>FileUpload($req->file('image'), $path),
           'events'=> $req->s_event,
           'title'=> $req->title,
           'description'=> $req->description,
           'info_link'=> $req->info_link,
           'ticket_link'=> $req->ticket_link,
           'facebook_link'=> $req->face_link,
        ]);
        if($events->save()){
            return redirect('events')->with('success', 'Events successfully created');
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
        $file=$req->file('image');
        if ($file!=null) {
        $imgname=$file->getClientOriginalName();
   
        }
        $path=public_path('images/events');
        $events=Events::find($id);
         if ($req->file('image')!=null) {
        $events->image=FileUpload($req->file('image'),$path);
        }
        $events->events=$req->s_event;
        $events->title=$req->title;
        $events->description=$req->description;
        $events->info_link=$req->info_link;
        $events->ticket_link=$req->ticket_link;
        $events->facebook_link=$req->face_link;
        if($events->save()){
            return redirect('events')->with('success', 'Events successfully Updated');
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
        return redirect('events')->with('success', 'Events successfully Deleted');
 
        }
    }
}
