<?php
use Modules\Settings\Entities\Settings;
use App\Models\User;
use Modules\Logs\Entities\Logs;
use Modules\Logs\Entities\SystemLogs;
use Illuminate\Support\Facades\Http;
use Modules\ProductShowcase\Entities\ProductShowcase;
use Modules\WeaklyEvents\Entities\WeaklyEvents;
use Modules\Events\Entities\Events;
use Modules\Caffe\Entities\Caffe;
use Modules\Brunch\Entities\Brunch;

function AllPermissions()
{
	$role=[];
	$role['users']=['view','add','edit','delete'];
	$role['permissions']=['view','add','edit','delete'];
	$role['trash']=['view','edit','delete'];	
	$role['logs']=['view','delete'];	
	$role['settings']=['view','add','edit','delete'];

return $role;

}



function FileUpload($file, $path){
	if($file==null){return null;}
	 $imgname=$file->getClientOriginalName();
	  if($file->move($path,$imgname)){
	  	return $imgname;
	  }
	  else{
	  	return null;
	  }
}



function Base64FileUpload($file, $path){
	if($file==null){return null;}
		$png =uniqid().date('Y-m-d-H-i-s')."base64images.png";
    		$path = $path.'/'.$png;
    		$uploadimg=Image::make(file_get_contents($file))->save($path);
    		if(isset($uploadimg->basename)){
    			return $uploadimg->basename;
    		}    
	 
}


function Settings()
{
	return Settings::first();
}



function User($id)
{
	$user=User::find($id);
	if($user!=null){
		return $user->name;
	}
}



function UserDetail($id)
{
	$user=User::find($id);
	if($user!=null){
		return $user;
	}
}

function MenuSearchBar()
{
	$sidebarmenu=[
				'Dashboard'=>[
					['name'=>'Dashboard','link'=>url('home')],
				],
				'Users'=>[
					['name'=>'Users','link'=>url('users')],
					['name'=>'Roles & Permissions','link'=>url('roles')],
				],
				'Settings'=>[
					['name'=>'Settings','link'=>url('settings')],
				],
	];

return $sidebarmenu;

}


function GenerateOTP()
{
	return rand(1000,9999);
}



function SendMessage($phone, $msg)
{


	return true;

}

function GenerateLog($info)
{
	if(!Settings()->logging){
		return true;
	}

	if(Logs::insert($info)){
		return true;
	}
	else{
		return false;
	}
}


function GenerateSystemLog($info)
{
	if(SystemLogs::insert($info)){
		return true;
	}
	else{
		return false;
	}
}



function TrashModules()
{
	$modules=[];

	$modules=[
			[
				'name'=>'Users',
				'model'=>'users',
			],

	];

	return $modules;
}

function ApiCall($type='get', $url, $data)
{	
	$response = $type=="get" ? Http::get($url, $data) : Http::post($url, $data);
	$res=['success'=>$response->successful(), 'data'=>$response->body()];

	return (object) $res;

}



function ColorsPack()
{
	return ['#006BA6','#E33932','#F8A101','#F77C0C','#B3234E','#890D53','#601071', '#3B1585','#6891B1','#05B4C9','#00C3A7','#00C76F'];
}

function ProductShowcase($id)
{
	return ProductShowcase::with('images')->find($id);
}


function Caffe()
{
	return Caffe::where('status',1)->get();
}

function BottomLessBrunch()
{
	return Brunch::where('status',1)->get();
}


function WeeklyEvents()
{
	return WeaklyEvents::where('status', 1)->get();
}


function Events()
{
	return Events::where('status', 1)->get();
}