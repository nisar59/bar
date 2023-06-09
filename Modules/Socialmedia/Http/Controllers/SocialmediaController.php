<?php

namespace Modules\Socialmedia\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Socialmedia\Entities\Socialmedia;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class SocialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $social_media=Socialmedia::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($social_media)
           ->addColumn('action',function ($row){
               $action='';
               
               if(Auth::user()->can('social-media.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/social-media/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                    }
                if(Auth::user()->can('social-media.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/social-media/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })
             ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/social-media/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/social-media/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })

             ->editColumn('icon',function($row)
             {
                return '<i class="'.$row->icon.'"></i>';
             })

           ->rawColumns(['action','status', 'icon'])
           ->make(true);
        }
        return view('socialmedia::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $fontawesom=public_path('assets/fontawesom/fontawesom.json');

        $get_icons=file_get_contents($fontawesom);

        return view('socialmedia::create')->withIcons(json_decode($get_icons));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
        'name' => 'required',
        'link' => 'required',
        'icon' => 'required',
        ]);
        DB::beginTransaction();
        try{
        Socialmedia::create($req->except('_token'));
        DB::commit();
         return redirect('admin/social-media')->with('success','Social Media successfully created');
         
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
        return view('socialmedia::show');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $page=Socialmedia::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/social-media')->with('success','Social Media status successfully updated');
         
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
        $fontawesom=public_path('assets/fontawesom/fontawesom.json');

        $get_icons=file_get_contents($fontawesom);

        $social_media=Socialmedia::find($id);
        return view('socialmedia::edit',compact('social_media'))->withIcons(json_decode($get_icons));
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
        'name' => 'required',
        'link' => 'required',
        'icon' => 'required',
        ]);
         DB::beginTransaction();
        try{
        Socialmedia::find($id)->update($req->except('_token'));
        DB::commit();
         return redirect('admin/social-media')->with('success','Social Media successfully updated');
         
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
        Socialmedia::find($id)->delete();
        DB::commit();
         return redirect('admin/social-media')->with('success','Social Media successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
