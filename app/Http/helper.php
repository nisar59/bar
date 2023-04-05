<?php
use Modules\Settings\Entities\Settings;
use App\Models\User;
use Modules\Logs\Entities\Logs;
use Modules\Logs\Entities\SystemLogs;
use Illuminate\Support\Facades\Http;
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




function PackageDetail($id)
{
	$package=Packages::find($id);

	if($package!=null){
		return $package;
	}

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

$blocks=[
	//index sections files
'banner'=>[
	'name'=>'banner.blade.php',
	'data'=>[
		'background_image',
		'image',
		'heading',
		'sub_heading',
		'link',

	],

	],

	'ranking'=>[
	'name'=>'ranking.blade.php',
	'data'=>[
		'heading1',
		'subheading1',
		'heading2',
		'subheading2',
	],
	],

	'book_table'=>[
	'name'=>'book-table.blade.php',
	'data'=>[
		'heading',
		'subheading',
		'button',
		'image',
	],
	],

	'celebrate'=>[
	'name'=>'celebrate.blade.php',
	'data'=>[
		'image',
		'heading',
		'subheading',
		'button',

	],
	],

	'shop'=>[
	'name'=>'shop.blade.php',
	'data'=>[

		'heading',
		'subheading',
		'button',
		'image',

	],
	],

	'food_drink'=>[
	'name'=>'food-drink.blade.php',
	'data'=>[

		'heading',
		'subheading',
		'button',
	],
	],

	//welcome sections files 
	'welcome_video'=>[
	'name'=>'welcome-video.blade.php',
	'data'=>[
		'image',
	],
	],

	'welcome_text'=>[
	'name'=>'welcome-center-text.blade.php',
	'data'=>[
	'heading',
	'subheading',
	'products',
	],	
	],

	'welcome_images'=>[
	'name'=>'welcome-images.blade.php',
	'data'=>[
		'images',
	],
	],

	//our story sections files
	'story_slider'=>[
		'name'=>'story-slider.blade.php',
		'data'=>[
			'images',
		],
	],
	'our_story_text1'=>[
		'name'=>'our-story-text.blade.php',
		'data'=>[
			'header',
			'heading',
			'subheading',
		],
	],

	'our_story_one'=>[
		'name'=>'our-story-one.blade.php',
		'data'=>[
			'heading',
			'image',
		],
	],

	'our_story_text2'=>[
		'name'=>'our-story-center-text.blade.php',
		'data'=>[
			'heading',
		],
	],

	'our_story_two'=>[
		'name'=>'our-story-two.blade.php',
		'data'=>[
			'image',
			'heading',
		],
	],

	'our_story_footer_images'=>[
		'name'=>'our-story-footer-img.blade.php',
		'data'=>[
			'images',
		],
	],

	//Hours+Location sections files
	'hour_image_text'=>[
		'name'=>'hour-image-text.blade.php',
		'data'=>[
			'heading',
			'link',
			'phone',
			'subheading',
			'image', 
		],
	],

	//Direction missing


	//Menus sections files
	'menus_nav'=>[
		'name'=>'menus-nav.blade.php',
		'data'=>[
			'button',
			'nav-bar',
		],
	],

	// News and Events

	'news_images'=>[
		'name'=>'news-footer-images.blade',
		'data'=>[
			'images',
			'subheading',
			'button',
		],
	],

	














];