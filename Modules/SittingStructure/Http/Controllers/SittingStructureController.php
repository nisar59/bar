<?php

namespace Modules\SittingStructure\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SittingStructure\Entities\SittingStructure;
use Modules\SittingStructure\Entities\StructureTables;
use Throwable;
use DB;
class SittingStructureController extends Controller
{


    function __construct()
    {
        $ss=SittingStructure::first();

        if($ss==null){
            SittingStructure::create(['map'=>'']);
        }
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $ss=SittingStructure::with('tables')->first();

        return view('sittingstructure::index')->withData($ss);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sittingstructure::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
            'map'=>'required'
        ]);
        DB::beginTransaction();
        try { 
            $path=public_path('images/sitting-structure');    
            $ss=SittingStructure::firstOrNew();
            $ss->map=FileUpload($req->map, $path);
            $ss->save();
            
        DB::commit();
         return redirect()->back()->with('success','Sitting structure updated successfully');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }

    }


    public function tablestore(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'guests'=>'required'
        ]);
        DB::beginTransaction();
        try { 
            $ss=SittingStructure::first();
            $inputs=$req->except('_token');
            $inputs['sitting_structure_id']=$ss->id;
            $inputs['status']=1;
            StructureTables::create($inputs);
        DB::commit();
         return redirect()->back()->with('success','Sitting Table created successfully');
         
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
        return view('sittingstructure::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sittingstructure::edit');
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
            'guests'=>'required'
        ]);
        DB::beginTransaction();
        try { 
            $ss=SittingStructure::first();
            $inputs=$req->except('_token');
            $inputs['sitting_structure_id']=$ss->id;
            StructureTables::find($id)->update($inputs);
        DB::commit();
         return redirect()->back()->with('success','Sitting Table updated successfully');
         
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
        try { 
            StructureTables::find($id)->delete();
        DB::commit();
         return redirect()->back()->with('success','Sitting Table deleted successfully');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         } 


    }
}
