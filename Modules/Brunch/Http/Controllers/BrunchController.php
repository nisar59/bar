<?php

namespace Modules\Brunch\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Brunch\Entities\Brunch;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
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
               if(Auth::user()->can('brunch.edit')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/brunch/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
           if(Auth::user()->can('brunch.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/brunch/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }
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
        DB::beginTransaction();
        try{
            $path=public_path('images/brunch');
            $inputs=$req->except('_token');
            $inputs['image']=FileUpload($req->image, $path);
        Brunch::create($inputs);
        DB::commit();
         return redirect('admin/brunch')->with('success','Bottomless Brunch successfully created');
         
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
        $req->validate([
/*           'image'=>'required', 
*/           'description'=>'required', 
           'link'=>'required', 
        ]);
          DB::beginTransaction();
        try{
            $path=public_path('images/brunch');
            $inputs=$req->except('_token');
            if($req->image!=null){
                $inputs['image']=FileUpload($req->image, $path);
            }
        Brunch::find($id)->update($inputs);
        DB::commit();
         return redirect('admin/brunch')->with('success','Bottomless Brunch successfully updated');
         
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
        Brunch::find($id)->delete();
        DB::commit();
         return redirect('admin/brunch')->with('success','Bottomless Brunch successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
