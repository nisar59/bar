<?php

namespace Modules\Banner\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banner\Entities\Banner;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
     if (request()->ajax()) {
        $banner=Banner::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($banner)
           ->addColumn('action',function ($row){
               $action='';

               if(Auth::user()->can('banner.edit')){
               $path=url('images/banner');                   
                $action.='<a class="btn btn-success banner-show btn-sm m-1" data-type="'.$row->type.'" data-img="'.$path.'/'.$row->image.'" data-bgimg="'.$path.'/'.$row->background_image.'" data-video="'.$row->video.'" href="javascript:void(0)"><i class="fas fa-eye"></i></a>';

                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/banner/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }

                if(Auth::user()->can('banner.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/banner/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })
    
            ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/banner/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/banner/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           

           ->rawColumns(['action','status'])
           ->make(true);
        }

        return view('banner::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('banner::create');
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
        'background_image'=>'required_without:video',
        'video'=>'required_without:background_image',
        'type'=>'required',
        ]);
         DB::beginTransaction();
        try{
        $path=public_path('images/banner/');
        $inputs=$req->except('_token');

        if($req->image!=null){
             $inputs['image']=FileUpload($req->image, $path);
        }
        if($req->background_image!=null){
            $inputs['background_image']=FileUpload($req->background_image, $path);
        }
        if($req->video!=null){
            $inputs['video']=$req->video;
        }

        Banner::create($inputs);
        DB::commit();
         return redirect('admin/banner')->with('success','Banner successfully created');
         
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
        $page=Banner::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/banner')->with('success','Banner status successfully updated');
         
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
        return view('banner::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $banner=Banner::find($id);
        return view('banner::edit',compact('banner'));
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
        'name'=>'required',
        'type'=>'required',
        ]);
           DB::beginTransaction();
        try{
            $path=public_path('images/banner/');
        $inputs=$req->except('_token');

        if($req->image!=null){
             $inputs['image']=FileUpload($req->image, $path);
        }
        if($req->background_image!=null){
            $inputs['background_image']=FileUpload($req->background_image, $path);
        }
        if($req->video!=null){
            $inputs['video']=$req->video;
        }
        Banner::find($id)->update($inputs);
        DB::commit();
         return redirect('admin/banner')->with('success','Banner successfully created');
         
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
        Banner::find($id)->delete();
        DB::commit();
         return redirect('admin/banner')->with('success','Banner successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
