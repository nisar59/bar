<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
            if (request()->ajax()) {
        $menu=Menu::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($menu)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-primary btn-sm" href="'.url('menu/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('menu/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('menu::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('menu::create');
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
        'url'=>'required',
        ]);
        $menu=new Menu;
        $menu->name=$req->name;
        $menu->url=$req->url;
        if($menu->save()){
         return redirect('menu')->with('success','Menu successfully created');
         } 
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('menu::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $menu=Menu::find($id);
        return view('menu::edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $menu=Menu::find($id);
        $menu->name=$req->name;
        $menu->url=$req->url;
        if($menu->save()){
         return redirect('menu')->with('success','Menu successfully Updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $menu=Menu::find($id);
        if($menu->delete()){
         return redirect('menu')->with('success','Menu successfully Deleted');
         }
    }
}
