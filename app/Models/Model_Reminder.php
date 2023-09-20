<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Reminder extends Model {
	
	function get_reminder($id=null,$lead_id=null,$title=null,$date=null,$time=null,$assigned_to=null,$description=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('lead_reminder');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($lead_id)){
			$builder->where('lead_id',$lead_id);
		}if(!empty($title)){
			$builder->where('title',$title);
		}if(!empty($date)){
			$builder->where('date',$date);
		}if(!empty($time)){
			$builder->where('time',$time);
		}if(!empty($assigned_to)){
			$builder->where('assigned_to',$assigned_to);
		}if(!empty($description)){
			$builder->where('description',$description);
		}return $builder;
	}
	
}