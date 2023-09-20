<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Contacts extends Model {
	
	function get_contacts($id=null,$firstname=null,$lastname=null,$email=null,$phone=null,$phonetype=null,$title=null,$remarks=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('contacts');
		$builder->orderBy('email');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($firstname)){
			$builder->where('firstname',$firstname);
		}if(!empty($lastname)){
			$builder->where('lastname',$lastname);
		}if(!empty($email)){
			$builder->where('email',$email);
		}if(!empty($phone)){
			$builder->where('phone',$phone);
		}if(!empty($phonetype)){
			$builder->where('phonetype',$phonetype);
		}if(!empty($title)){
			$builder->where('title',$title);
		}if(!empty($remarks)){
			$builder->where('remarks',$remarks);
		}return $builder;
	}
	
}