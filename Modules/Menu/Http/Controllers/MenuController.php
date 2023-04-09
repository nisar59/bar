<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Pages\Entities\Pages;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use Str;
use DB;
use Auth;
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
               if(Auth::user()->can('menu.edit')){
                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/menu/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Auth::user()->can('menu.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/menu/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })

           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/menu/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/menu/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           ->rawColumns(['action','status'])
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
        $pages=Pages::where('status',1)->get();
        return view('menu::create')->withPages($pages);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {     

        $req->validate([
        'type'=>'required',
        'name'=>'required',
        ]);

        DB::beginTransaction();
        try{
            $inputs=$req->except('_token');
            $inputs['status']=1;
            $inputs['sort_by']=1;
        Menu::create($inputs);
        DB::commit();
         return redirect('admin/menu')->with('success','Menu successfully created');
         
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
        $pages=Pages::where('status',1)->get();
        return view('menu::edit',compact('menu'))->withPages($pages);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $req['slug']=Str::slug($req->slug);
        $req->validate([
        'type'=>'required',
        'name'=>'required',
        ]);

        DB::beginTransaction();
        try{
        Menu::find($id)->update($req->except('_token'));
        DB::commit();
         return redirect('admin/menu')->with('success','Menu successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
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
        $page=Menu::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/menu')->with('success','Page status successfully updated');
         
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
        Menu::find($id)->delete();
        DB::commit();
         return redirect('admin/menu')->with('success','Menu successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }

    }
}
