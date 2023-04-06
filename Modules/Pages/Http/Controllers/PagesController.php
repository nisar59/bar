<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $pages=Pages::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($pages)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-success btn-sm" href="'.url('pages/blocks/'.$row->id).'"><i class="fa fa-bars" ></i> </a>';
               $action.='<a class="btn btn-primary btn-sm" href="'.url('pages/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('pages/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('pages::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pages::create');
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
        $page=new Pages;
        $page->title=$req->title;
        $page->description=$req->description;
        if($page->save()){
         return redirect('pages')->with('success','Pages successfully created');
         } 
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pages=Pages::find($id);
        return view('pages::edit',compact('pages'));
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
        $page=Pages::find($id);
        $page->title=$req->title;
        $page->description=$req->description;
        if($page->save()){
         return redirect('pages')->with('success','Pages successfully Updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
         $page=Pages::find($id);
         if($page->delete()){
         return redirect('pages')->with('success','Pages successfully Deleted');
         }
    }
}
