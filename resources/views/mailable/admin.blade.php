@php
$temp=Settings()->order_email_template;
$user=UserDetail($data->user_id);

if($user!=null){
	$temp=@str_replace('{name}', @$user->name, $temp);
	$temp=@str_replace('{phone}', @$user->phone, $temp);
	$temp=@str_replace('{email}', @$user->email, $temp);
}

$booking_date=@Carbon\Carbon::parse(@$data->booking_date)->format('D d-M-Y');
$sitting=@Carbon\Carbon::parse(@$data->sitting->time_from)->format('h:i A');
$table=@$data->table->table->name;
$price=@number_format($data->table->price);
$total=@number_format($data->amount);

$extras='<table style="border-collapse: collapse; text-align: center; vertical-align: middle;" border="1" width="100%"><thead><th style="text-align:center;">Sr No#</th><th style="text-align: center; width:75%;">Name</th><th style="text-align:center;">Price</th></thead><tbody>';


if(count($data->extras)>0){

foreach($data->extras as $key=> $extra){

$extras.="<tr><td>".$key."</td><td>".$extra->name."</td><td>£ ".number_format($extra->price)."</td></tr>";
	}	
}
else{
$extras.='<tr><td colspan="3">No Extra Found</td></tr></tbody>';
}

$temp=@str_replace('{booking-date}', @$booking_date, $temp);
$temp=@str_replace('{sitting}', @$sitting, $temp);
$temp=@str_replace('{table}', @$table, $temp);
$temp=@str_replace('{sitting-price}', @$price, $temp);
$temp=@str_replace('{extras}', @$extras, $temp);
$temp=@str_replace('{total}', @$total, $temp);



@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="container" style="margin-right: 15px; margin-left: 15px; background: #ededed; border-radius: 10px; color: inherit; padding: 15px;">
			{!! $temp !!}
		</div>
	</body>
</html>