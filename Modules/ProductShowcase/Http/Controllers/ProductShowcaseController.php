<?php

namespace Modules\ProductShowcase\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductShowcase\Entities\ProductShowcase;
use Modules\ProductShowcase\Entities\ProductShowcaseImages;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class ProductShowcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $slider=ProductShowcase::with('images')->select('*')->orderBy('id','ASC')->get();
           return DataTables::of($slider)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('show-case.edit')){
                 $action.="<a class='btn btn-success btn-sm m-1 show-case-show' data-images='".json_encode($row->images)."' href='javascript:void(0)'><i class='fas fa-eye'></i></a>";

                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('admin/show-case/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';

                }
                if(Auth::user()->can('show-case.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/show-case/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })

           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('admin/show-case/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('admin/show-case/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('productshowcase::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('productshowcase::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
        'image' => 'required|array',
        'image.*' => 'image|mimes:jpg,jpeg,png'
        ]);

        DB::beginTransaction();
        try{
            $inputs=$req->except('_token','image');
            $inputs['status']=1;
        $product_showcase=ProductShowcase::create($inputs);
        $path=public_path('images/show-case');
        foreach ($req->image as $key => $image) {
            if($image!=null){
            ProductShowcaseImages::create([
                'product_showcase_id'=>$product_showcase->id,
                'image'=>FileUpload($image, $path)
            ]);
            }
        }

        DB::commit();
         return redirect('admin/show-case')->with('success','Show Case successfully created');
         
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
        return view('productshowcase::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $showcase=ProductShowcase::find($id);
        return view('productshowcase::edit',compact('showcase'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        DB::beginTransaction();
        try{
        ProductShowcase::find($id)->update($req->except('_token','image'));
        $path=public_path('images/show-case');
        if($req->image!=null){
        foreach ($req->image as $key => $image) {
            if($image!=null){
            ProductShowcaseImages::create([
                'product_showcase_id'=>$id,
                'image'=>FileUpload($image, $path)
            ]);
                }
            }
        }
        DB::commit();
         return redirect('admin/show-case')->with('success','Show Case successfully updated');
         
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

    public function status($id)
    {
        DB::beginTransaction();
        try{
        $page=ProductShowcase::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('admin/show-case')->with('success','Show Case status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
        ProductShowcase::find($id)->delete();
        DB::commit();
         return redirect('admin/show-case')->with('success','Show Case successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }


    public function destroyimage($id)
    {
        DB::beginTransaction();
        try{
        ProductShowcaseImages::find($id)->delete();
        DB::commit();
         return redirect('admin/show-case')->with('success','Show Case image successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }


}
