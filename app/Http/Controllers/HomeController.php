<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\TableBookings\Entities\TableBookings;
use App\Models\User;
use Carbon\Carbon;
use Artisan;
use Auth;
use Throwable;
use Hash;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    



    public function index()
    {        
        User::find(Auth::id())->update([
            'lock_screen_token'=>Hash::make(Auth::id().now()),
        ]);

        $bookings=TableBookings::where('payment_status',1);

        $total_bookings=$bookings->count();

        $active_bookings=$bookings->where('status',0)->count();
        $served_bookings=$bookings->where('status',1)->count();

        return view('home',compact('total_bookings', 'active_bookings', 'served_bookings'));
    }



    public function checkauth()
    {
       return Auth::check();
    }

    public function lockscreen(Request $req)
    {
        try {
            $user=User::where('lock_screen_token', $req->id)->first();
            if($user==null){
            return redirect('login');
            }
            return view('auth.lock-screen')->withUser($user);    
        } catch (Exception $e) {
            return redirect('login');
        } catch(Throwable $e){
            return redirect('login');
        }

    }



    public function artisan($command)
    {
        DB::beginTransaction();
        try{
            $sett=Settings();
            $sett->logging=0;
            $sett->save();
            Artisan::call($command);
            $res=Artisan::output();
            $sett=Settings();
            $sett->logging=1;
            $sett->save();
            DB::commit(); 
            return redirect()->back()->with('info',$res);
        } catch (Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error '.$e->getMessage());
        }catch (Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error '.$e->getMessage());
        }


    }


}
