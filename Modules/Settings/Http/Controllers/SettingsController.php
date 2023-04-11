<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Settings;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['settings']=Settings::first();
        return view('settings::index')->withData($this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {

        $portal_logo=null;
        $portal_favicon=null;
        $website_logo=null;
        $website_small_logo=null;
        $penal_logo=null;
        $path=public_path('img/settings/');

        $sett=Settings::first();

        if($sett!=null){
            $portal_logo=$sett->portal_logo;
            $portal_favicon=$sett->portal_favicon;
            $website_logo=$sett->website_logo;
            $website_small_logo=$sett->website_small_logo;
            $website_favicon_icone=$sett->website_favicon_icone;
            $penal_logo=$sett->penal_logo;
        }

        if($req->file('panel_logo')!=null){
            $portal_logo=FileUpload($req->file('panel_logo'), $path);
        }
        if($req->file('panel_favicon')!=null){
            $portal_favicon=FileUpload($req->file('panel_favicon'), $path);
        }
        if($req->file('website_logo')!=null){
            $website_logo=FileUpload($req->file('website_logo'), $path);
        }
         if($req->file('website_s_logo')!=null){
            $website_small_logo=FileUpload($req->file('website_s_logo'), $path);
        }
                if($req->file('website_f_icone')!=null){
            $website_favicon_icone=FileUpload($req->file('website_f_icone'), $path);
        }
         if($req->file('penal_logo')!=null){
            $penal_logo=FileUpload($req->file('penal_logo'), $path);
        }

        $settings=Settings::firstOrNew(['id'=>1]);
        $settings->portal_name=$req->panel_name;
        $settings->portal_email=$req->panel_email;
        $settings->portal_logo=$portal_logo;
        $settings->portal_favicon=$portal_favicon;
        $settings->website_logo=$website_logo;
        $settings->website_small_logo=$website_small_logo;
        $settings->website_favicon_icone=$website_favicon_icone;
        $settings->penal_logo=$penal_logo;
        $settings->logging=$req->logging;
        $settings->logs_duration=$req->logs_duration;
        $settings->logs_duration_type=$req->logs_duration_type;

        if($settings->save()){
            return redirect()->back()->with('success', 'Panel settings successfully saved');
        }
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('settings::edit');
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
        //
    }
}
