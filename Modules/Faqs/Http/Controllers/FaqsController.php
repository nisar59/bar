<?php

namespace Modules\Faqs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faqs\Entities\Faqs;
use Yajra\DataTables\Facades\DataTables;
class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         if (request()->ajax()) {
        $faqs=Faqs::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($faqs)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-primary btn-sm" href="'.url('faqs/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('faqs/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->rawColumns(['action'])
           ->make(true);
        }
        return view('faqs::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('faqs::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $req->validate([
           'title'=>'required', 
           'area'=>'required', 
        ]);
        $faq=Faqs::create([
           'title'=> $req->title,
           'text'=> $req->area,
        ]);
        if($faq->save()){
            return redirect('faqs')->with('success', 'FAQs successfully created');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('faqs::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $faq=Faqs::find($id);
        return view('faqs::edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
        $faq=Faqs::find($id);
        $faq->title=$req->title;
        $faq->text=$req->area;
        if($faq->save()){
            return redirect('faqs')->with('success', 'FAQs successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $faq=Faqs::find($id);
        if($faq->delete()){
            return redirect('faqs')->with('success', 'FAQs successfully Updated');
        }
        
    }
}
