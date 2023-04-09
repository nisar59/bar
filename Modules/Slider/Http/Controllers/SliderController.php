<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\SliderImages;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use DB;
use Auth;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $slider=Slider::with('images')->select('*')->orderBy('id','ASC')->get();
           return DataTables::of($slider)
           ->addColumn('action',function ($row){
               $action='';
               if(Auth::user()->can('slider.edit')){
                 $action.="<a class='btn btn-success btn-sm m-1 slider-show' data-images='".json_encode($row->images)."' href='javascript:void(0)'><i class='fas fa-eye'></i></a>";

                   $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('slider/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';

                }
                if(Auth::user()->can('slider.delete')){
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('slider/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
                }
               return $action;
           })

           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('slider/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('slider/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })

           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('slider::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('slider::create');
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
        $slider=Slider::create($inputs);
        $path=public_path('images/slider');
        foreach ($req->image as $key => $image) {
            if($image!=null){
            SliderImages::create([
                'slider_id'=>$slider->id,
                'image'=>FileUpload($image, $path)
            ]);
            }
        }

        DB::commit();
         return redirect('slider')->with('success','Slider successfully created');
         
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
        return view('slider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $slider=Slider::find($id);
        return view('slider::edit',compact('slider'));
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
        ]);

        DB::beginTransaction();
        try{
        Slider::find($id)->update($req->except('_token'));

        $path=public_path('images/slider');
        if($req->image!=null){
        foreach ($req->image as $key => $image) {
            if($image!=null){
            SliderImages::create([
                'slider_id'=>$id,
                'image'=>FileUpload($image, $path)
            ]);
                }
            }
        }
        DB::commit();
         return redirect('slider')->with('success','Slider successfully updated');
         
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
        $page=Slider::find($id);

        if($page->status==1){
            $page->status=0;
        }
        else{
            $page->status=1;
        }
        $page->save();
        DB::commit();
         return redirect('slider')->with('success','Slider status successfully updated');
         
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
        Slider::find($id)->delete();
        DB::commit();
         return redirect('slider')->with('success','Slider successfully deleted');
         
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
        SliderImages::find($id)->delete();
        DB::commit();
         return redirect('slider')->with('success','Slider image successfully deleted');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }


}
