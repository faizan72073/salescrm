<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Lead_Timeline extends Model {
	
	function get_Lead_Timeline($id=null,$lead_id=null,$pipeline_id=null,$user_id=null,$datetime=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('lead_timeline');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($lead_id)){
			$builder->where('lead_id',$lead_id);
		}if(!empty($pipeline_id)){
			$builder->where('pipeline_id',$pipeline_id);
		}if(!empty($user_id)){
			$builder->where('user_id',$user_id);
		}if(!empty($datetime)){
			$builder->where('datetime',$datetime);
		} return $builder;
	}

}