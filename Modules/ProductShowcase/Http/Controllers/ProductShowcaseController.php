<?php

namespace Modules\ProductShowcase\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductShowcase\Entities\ProductShowcase;
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
        $productshowcase=ProductShowcase::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($productshowcase)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('productshowcase.edit')){
                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('productshowcase/show/'.$row->id).'"><i class="fas fa-eye"></i></a>';
                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('productshowcase/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Auth::user()->can('productshowcase.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('productshowcase/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })
            ->addColumn('image', function ($row) {
                                $path=public_path('images');
                                $url=url('images');
                                $img=$url.'/images.png';
                                if(file_exists($path.'/product'.$row->image) AND $row->image!=null){
                                $img=$url.'/product'.$row->image;
                                }
            
                                return '<img src="'.$img.'" height="50" width="50">';
                            })
           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('productshowcase/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('productshowcase/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           

           ->rawColumns(['action','image','status'])
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
        'name'=>'required|string|max:255',
        'image'=>['required'],        
        ]);

         if($req->hasfile('image'))
         {
            $data = [];
            foreach($req->file('image') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/product/', $name);  
                $data[] = $name;  
            }
         }
          $product= new ProductShowcase();
          $product->name=$req->name;
          $product->image=json_encode($data);
        if($product->save()){
            return redirect('productshowcase')->with('success','Product Showcase successfully created');

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
         return redirect('productshowcase')->with('success','Product Showcase status successfully updated');
         
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
        $product=ProductShowcase::find($id);
        return view('productshowcase::edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
        ProductShowcase::find($id)->delete();
        DB::commit();
         return redirect('productshowcase')->with('success','Product Showcase successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
    }
}
}
