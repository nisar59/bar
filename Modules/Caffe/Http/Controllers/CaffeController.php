<?php

namespace Modules\Caffe\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Caffe\Entities\Caffe;
use Yajra\DataTables\Facades\DataTables;
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
               $action.='<a class="btn btn-primary btn-sm" href="'.url('caffe/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('caffe/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->rawColumns(['action'])
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
           'link'=>'required', 
        ]);
        $path=public_path('images/caffe');
        $caffe=Caffe::create([
           'title'=> $req->title,
           'file'=>FileUpload($req->file('file'), $path),
           'description'=> $req->description,
           'link'=> $req->link,
        ]);
        if($caffe->save()){
            return redirect('caffe')->with('success', 'Caffe successfully created');
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $file=$req->file('file');
        if ($file!=null) {
        $imgname=$file->getClientOriginalName();
   
        }
        $path=public_path('images/caffe');
        $caffe=Caffe::find($id);
         if ($req->file('file')!=null) {
        $caffe->file=FileUpload($req->file('file'),$path);
        }
         $caffe->title=$req->title;
         $caffe->description=$req->description;
         $caffe->link=$req->link;
        if($caffe->save()){
            return redirect('caffe')->with('success', 'Caffe successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $caffe=Caffe::find($id);
        if($caffe->delete()) {
        return redirect('caffe')->with('success','Caffe successfully Deleted');
        
    }
    }
}
