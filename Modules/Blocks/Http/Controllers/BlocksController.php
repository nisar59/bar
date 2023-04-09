<?php

namespace Modules\Blocks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blocks\Entities\Blocks;
use Modules\Pages\Entities\Pages;
use Throwable;
use DB;
class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        $page=Pages::with('blocks')->find($id);
        return view('blocks::index')->withPage($page);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id, $key)
    {
            $res=[
            'success'=>false,
            'html'=>'',
            'data'=>''
        ];
        try{
        $blocks=config('page-blocks')->$key;

        request()->merge(['file_name'=>$blocks['name']]);
        request()->merge(['block_name'=>$key]);

        foreach($blocks['data'] as $block){
            $block_name=$block['name'];
            request()->merge([$block_name=>null]);
        }

        $save_res=$this->store(request(), $id);

        if($save_res==false OR $save_res==null){
        return response()->json($res);
        }

        $res['success']= true;
        $res['html']= view('blocks::edit')->withBlock($blocks)->withData($save_res)->render();
        $res['data']= $save_res->id;

        return response()->json($res);

        } catch(Exception $e){
        return response()->json($res);

        } catch(Throwable $e){
        return response()->json($res);
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req, $id)
    {
        $data=$req->except('_token','file_name','block_name');
        DB::beginTransaction();
        try{
        $res=Blocks::create([
                'page_id'=>$id,
                'block_name'=>$req->block_name,
                'file_name'=>$req->file_name,
                'data'=>json_encode($data),
                'sort_by'=>1,
        ]);
        DB::commit();
        return $res;
        }catch(Exception $e){
            return false;
        }catch(Throwable $e){
            return false;
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blocks::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

            $res=[
            'success'=>false,
            'html'=>'',
            'data'=>''
        ];
        try{
        $get_block=Blocks::find($id);
        $key=$get_block->block_name;
        $blocks=config('page-blocks')->$key;
        $res['success']= true;
        $res['html']= view('blocks::edit')->withBlock($blocks)->withData($get_block)->render();
        return response()->json($res);

        } catch(Exception $e){
        return response()->json($res);

        } catch(Throwable $e){
        return response()->json($res);
        }



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
          $block=Blocks::find($id);
          $block_data=json_decode($block->data);
          $key=$block->block_name;
          $blocks=config('page-blocks')->$key;
          $path=public_path('images/frontend/');
          $data=[];

          foreach ($blocks['data'] as $key => $blck) {
            $block_name=$blck['name'];
            $block_type=$blck['type'];

            if($block_type=="file"){
                if($req->$block_name!=null){
                    $data[$block_name]=FileUpload($req->$block_name, $path);
                }
                else{
                    $data[$block_name]=$block_data->$block_name;
                }
            }else{
              $data[$block_name]=$req->$block_name;
            }
          }

          $block->update(['data'=>json_encode($data)]);
          DB::commit();
          return redirect()->back()->with('success', "Block Successfully updated");
      }catch(Exception $e){
          return redirect()->back()->with('error', "Something went wrong with this error: ".$e->getMessage());

      }catch(Throwable $e){
          return redirect()->back()->with('error', "Something went wrong with this error: ".$e->getMessage());
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
          $block=Blocks::find($id);
          $block->delete();
          DB::commit();
          return redirect()->back()->with('success', "Block Successfully delete");
      }catch(Exception $e){
          return redirect()->back()->with('error', "Something went wrong with this error: ".$e->getMessage());

      }catch(Throwable $e){
          return redirect()->back()->with('error', "Something went wrong with this error: ".$e->getMessage());
      }
           


    }
    
}
