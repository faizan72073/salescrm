<?php 
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
//
function isLoggedIn()
{
	if (!empty(session()->get('username')  ) && !empty(session()->get('status')) ) {
		return true;
	} else {
		return false;
	}
}

function create_action_log($others){
	//
	$db = \Config\Database::connect();
	$request = \Config\Services::request();
	//
	$path = explode('/',$request->uri->getPath());
	$class=$path[0];
	$method=$path[1];
	$user=session()->get('username');
	$ip = $request->getIPAddress();;	
    //
	$data=[
	'date' => date('Y-m-d'),
	'user' => $user,
	'time' => date('H:i:s'),
	'ip_address' => $ip,
	'class' => $class,
	'method' => $method,
	'description' => $others
];
$builder = $db->table('action_log');
$builder->insert($data);
}
//
function access_crud($submenuid=null,$operation=null,$uid=null){
	$db = \Config\Database::connect();
	//
	if(empty($uid)){
		$uid = session()->get('id');	
	}
	//
	$builder = $db->table('crud_access as acc');
	$builder->join('sub_menus as menu','menu.id = acc.sub_menu_id');
	$builder->select('acc.serial');
	$builder->where('acc.id',$uid);
	if(!empty($submenuid)){
		$builder->where('menu.submenu',$submenuid);
	} if(!empty($operation)){
		$builder->where('acc.'.$operation,1);
	}
	$query = $builder->get();
	//
	if(count($query->getResultArray())  > 0){
		return true;
	}else{
		return false;
	}
}
//

function menu(){
	$db = \Config\Database::connect();
	//
	$builder = $db->table('menus');
	$query = $builder->orderBy('order_menu');
	return $query;
}
//
function submenu($menu_id){
	$db = \Config\Database::connect();
	//
	$builder = $db->table('sub_menus');
	$query = $builder->where('menu_id',$menu_id);
	return $query;
}
//

function parent_view($menu_id=null,$uid=null){
	$db = \Config\Database::connect();
	//
	if(empty($uid)){
		$uid = session()->get('id');	
	}
	//
	$builder = $db->table('crud_access');
	$builder->select('serial');
	$builder->where('id',$uid);
	$builder->where('menu_id',$menu_id);
	$builder->where('view',1);
	$query = $builder->get();
	//
	if(count($query->getResultArray())  > 0){
		return true;
	}else{
		return false;
	}

}
//
function call_API($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	return $result;
}
	//
function get_setting_value($attr){
	$db = \Config\Database::connect();
	//
	$builder = $db->table('settings');
	$builder->where('attribute',$attr);
	$query = $builder->get()->getRow();
	return $query->parameter;
}


function bell_notification(){
	$db = \Config\Database::connect();
	//
	$user_id = session()->get('id');
	$today = date('Y-m-d');
	$currentTime = date("H:i");

	// echo $currentTime;

// 	$date = '19:24:15 06/13/2013'; 
// echo date('h:i:s', strtotime($date));
	// $builder = $db->table('reminder')->join('remind_read', 'reminder.user_id = remind_read.for');;
	// $query = $builder->orderBy('remind_date', 'DESC');
	
	$builder = $db->table('reminder as rem');
	$builder->select('rem.*, read.status as read_status, users.id, users.firstname,users.lastname');
	$builder->join('remind_read as read','read.rem_id = rem.rem_id');
	$builder->join('users as users','read.user_id = users.id');
	$builder->where('read.for', $user_id);
	$builder->where('rem.remind_date <=', $today);
	$builder->where('rem.time <=', $currentTime);

	// $query = $builder->orderBy('remind_date');

	// dd($builder);

	return $builder;

}

?>