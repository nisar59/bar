<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Modules\Slider\Entities\Slider;
use Modules\Banner\Entities\Banner;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Str;
use Auth;
use Throwable;
class PagesController extends Controller
{

    public function __construct()
    { 
        Pages::firstOrCreate([
            'slug'=>'landing',            
        ],['title'=>'Landing','slug'=>'landing','status'=>1]);
    }


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
               
               if(Auth::user()->can('pages.edit')){
               $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/pages/blocks/'.$row->id).'"><i class="fa fa-bars" ></i> </a>';
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/pages/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                    }
                if(Auth::user()->can('pages.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/pages/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })

           ->addColumn('status',function ($row){
               $status='';
               if($row->status==1){
               $status.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/pages/status/'.$row->id).'">Active</a>';
                }else{
               $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/pages/status/'.$row->id).'">Deactive</a>';                
           }
               return $status;
           })


           ->rawColumns(['status','action'])
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
        $sliders=Slider::where('status',1)->get();
        $banners=Banner::where('status',1)->get();
        return view('pages::create')->withSliders($sliders)->withBanners($banners);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req['slug']=Str::slug($req->slug);
        $req->validate([
        'title'=>'required',
        'slug'=>['required','unique:pages'],        
        ]);
        $req['status']=1;
    DB::beginTransaction();
        try{
        Pages::create($req->except('_token'));
        DB::commit();
         return redirect('admin/pages')->with('success','Page successfully created');
         
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

        $sliders=Slider::where('status',1)->get();
        $banners=Banner::where('status',1)->get();

        return view('pages::edit',compact('pages'))->withSliders($sliders)->withBanners($banners);
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
        'title'=>'required',
        'slug'=>['required','unique:pages,slug,'.$id],        
        ]);

    DB::beginTransaction();
        try{
            $inputs=$req->except('_token');
            $inputs['slider_banner_id']=$req->slider_banner_id;
        Pages::find($id)->update($inputs);
        DB::commit();
         return redirect('admin/pages')->with('success','Page successfully created');
         
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
        $page=Pages::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/pages')->with('success','Page status successfully updated');
         
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
        Pages::find($id)->delete();
        DB::commit();
         return redirect('admin/pages')->with('success','Page successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
