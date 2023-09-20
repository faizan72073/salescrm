<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Followup extends Model {
	
	function get_follow_up($id=null,$lead_id=null,$follow_up_date=null,$follow_up_time=null,$firstname=null,$lastname=null,$emailaddress=null,$template=null,$emailtemplate=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('lead_follow_up');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($lead_id)){
			$builder->where('lead_id',$lead_id);
		}if(!empty($follow_up_date)){
			$builder->where('follow_up_date',$follow_up_date);
		}if(!empty($follow_up_time)){
			$builder->where('follow_up_time',$follow_up_time);
		}if(!empty($firstname)){
			$builder->where('firstname',$firstname);
		}if(!empty($lastname)){
			$builder->where('lastname',$lastname);
		}if(!empty($emailaddress)){
			$builder->where('emailaddress',$emailaddress);
		}if(!empty($template)){
			$builder->where('template',$template);
		}if(!empty($emailtemplate)){
			$builder->where('emailtemplate',$emailtemplate);
		}return $builder;
	}
	
}