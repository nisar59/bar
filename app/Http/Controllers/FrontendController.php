<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pages\Entities\Pages;
use Modules\TableBookings\Entities\TableBookings;
use Auth;
use App;
class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug=null)
    {
        if($slug==null){
            $slug='landing';
        }          
    $page=Pages::where('slug',$slug)->first();

    if($page==null){
        App::abort(404,'The url not found');
    }

    return view('frontend.index')->withPage($page);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $book_table=TableBookings::where('user_id', Auth::user()->id)->where('payment_status',1)->get();
        return view('frontend.pages.user')->withData($book_table);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function send()
    {
        // code...
    }
}
