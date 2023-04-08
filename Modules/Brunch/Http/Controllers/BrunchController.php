<?php

namespace Modules\Brunch\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Brunch\Entities\Brunch;
use Yajra\DataTables\Facades\DataTables;
class BrunchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $brunch=Brunch::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($brunch)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('brunch/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('brunch/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->addColumn('image', function ($row) {
                    /*floder name*/                    
                    $path=public_path('images');
                    /*floder name*/
                    $url=url('images');
                    $img=$url.'/images.png';
                    if(file_exists($path.'/brunch/'.$row->image) AND $row->image!=null){
                    $img=$url.'/brunch/'.$row->image;
                    }

                    return '<img src="'.$img.'" height="50" width="50">';
                })
           ->rawColumns(['action','image'])
           ->make(true);
        }
        return view('brunch::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('brunch::create');
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
           'link'=>'required', 
        ]);
        $path=public_path('images/brunch');
        $brunch=Brunch::create([
           'image'=>FileUpload($req->file('image'), $path),
           'description'=> $req->description,
           'link'=> $req->link,
        ]);
        if($brunch->save()){
            return redirect('brunch')->with('success', 'Brunch successfully created');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('brunch::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $brunch=Brunch::find($id);
        return view('brunch::edit',compact('brunch'));
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
        $path=public_path('images/brunch');
        $brunch=Brunch::find($id);
         if ($req->file('image')!=null) {
        $brunch->image=FileUpload($req->file('image'),$path);
        }
        $brunch->description=$req->description;
        $brunch->link=$req->link;
        if($brunch->save()){
         return redirect('brunch')->with('success','Brunch successfully Updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $brunch=Brunch::find($id);
        if($brunch->delete()){
        return redirect('brunch')->with('success', 'Brunch successfully Deleted');

        }
    }
}
