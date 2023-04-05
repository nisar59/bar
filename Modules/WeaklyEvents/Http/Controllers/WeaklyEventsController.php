<?php

namespace Modules\WeaklyEvents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WeaklyEvents\Entities\WeaklyEvents;
use Yajra\DataTables\Facades\DataTables;
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
               $action.='<a class="btn btn-primary btn-sm" href="'.url('weaklyevents/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('weaklyevents/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
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
        $path=public_path('images/w-events');
        $weaklyevents=WeaklyEvents::create([
           'image'=>FileUpload($req->file('image'), $path),
           'description'=> $req->description,
        ]);
        if($weaklyevents->save()){
            return redirect('weaklyevents')->with('success', 'Weakly-Events successfully created');
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
        $file=$req->file('image');
        if ($file!=null) {
        $imgname=$file->getClientOriginalName();
   
        }
        $path=public_path('images/w-events');
        $events=WeaklyEvents::find($id);
         if ($req->file('image')!=null) {
        $events->image=FileUpload($req->file('image'),$path);
        }
        $events->description=$req->description;
        if($events->save()){
         return redirect('weaklyevents')->with('success','WeaklyEvents successfully Updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $events=WeaklyEvents::find($id);
        if($events->delete()){
         return redirect('weaklyevents')->with('success','WeaklyEvents successfully Deleted');

        }
    }
}
