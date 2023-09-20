<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Menu extends Model {
	

	function main_menu($id = null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('menus');
		$builder->orderBy('order_menu');
		if(!empty($id)){
			$builder->where('id',$id);
		}
		return $builder;
	}
	//
	function submenu_menu($id = null,$menu_id=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('sub_menus');
		$builder->orderBy('menu_id');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($menu_id)){
			$builder->where('menu_id',$menu_id);
		}
		return $builder;
	}
	
}