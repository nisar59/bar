<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pages\Entities\Pages;

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

    return view('frontend.index')->withPage($page);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function welcome()
    {
        return view('frontend/welcome');
    }
    
    public function ourstory()
    {
         return view('frontend/our_story');
    }


     public function hours_location()
    {
         return view('frontend/hour_location');
    }


     public function cafe_dante_menu()
    {
         return view('frontend/cafe_dante_menu');
    }


      public function west_village_menu()
    {
         return view('frontend/west_village_menu');
    }



       public function reservations()
    {
         return view('frontend/reservations');
    }


        public function storee()
    {
         return view('frontend/store');
    }


         public function gift_card()
    {
         return view('frontend/gift_card');
    }


    public function bottled_cocktails()
    {
        return view('frontend/bottled-cocktails');
    }


    public function collaborations()
    {
        return view('frontend/collaborations');
    }


    public function news_and()
    {
       return view('frontend/news-and-events');
    }

   public function press()
   {
       return view('frontend/press');
   }


     public function contact()
   {
       return view('frontend/contact');
   }



    public function celebrate()
    {
        return view('frontend/celebrate');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function work_with()
    {
     return view('frontend/work_with');   
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
}
