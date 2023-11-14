<?php 

namespace App\Models;
use CodeIgniter\Model;

class Model_Users extends Model {
	
	function get_users($id=null,$username=null,$email=null,$status=null,$pass_string=null,$designation=null,$department=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('users');
		$builder->orderBy('status');
		if(!empty($id)){
			$builder->where('id',$id);
		} if(!empty($username)){
			$builder->where('username',$username);
		} if(!empty($email)){
			$builder->where('email',$email);
		} if(!empty($status)){
			$builder->whereIn('status',$status);
		}if(!empty($pass_string)){
			$builder->whereIn('pass_string',$pass_string);
		}if(!empty($designation)){
			$builder->whereIn('designation',$designation);
		}if(!empty($department)){
			$builder->whereIn('department',$department);
		}

		return $builder;
	}

	function get_sales_user($u_id=null,$name=null, $email=null, $phone=null, $address=null) {

	    // get all data of user according to user id
		$sql = "CALL get_sales_user_data(?)";
		$result = $this->db->query($sql,[$u_id]);
		return $result;


        // get all data of all users
		// $sql = "CALL get_sales_user_data()";
		// $result = $this->db->query($sql);
		// return $result;
		
		// if($result) {
		// 	return true;
		// }
		// return false;
	}
	// //
	function submenu_list(){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('sub_menus');
		$builder->select('sub_menus.*,menus.menu as menu');
		$builder->join('menus','sub_menus.menu_id = menus.id','left');
		$query = $builder->orderBy('sub_menus.menu_id','ASC');
		return $query;
	}
	//
	function crud_detail($sub_menu_id,$id){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('crud_access');
		// d($builder);
		// die();
		$builder->where('sub_menu_id',$sub_menu_id);
		$builder->where('id',$id);
		$query = $builder->get();
		return $query;
	}
	// 
	function get_main_menu($id=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('menus');
		if(!empty($id)){
			$builder->where('id',$id);
		}
		return $builder;	
	}

	function special_access(){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('special_permissions');
		// $builder->select('allow.*,special.permission');
		// $builder->join('special_permission_allow as allow','allow.sp_id = special.id');
		return $builder;
	}

	function special_access_detail($module,$id){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('special_permission_allow');
		// d($builder);
		// die();
		$builder->where('user_id',$id);
		$builder->where('sp_id',$module);
		$query = $builder->get();
		return $query;
	}


	function special_pipeline_access_detail($pipeline,$id){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('pipeline_permissions');
		// d($builder);
		// die();
		$builder->where('user_id',$id);
		$builder->where('pipeline_id',$pipeline);
		$query = $builder->get();
		return $query;
	}

}