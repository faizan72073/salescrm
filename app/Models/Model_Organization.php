<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Organization extends Model {
	
	function get_organization($id=null,$organization=null,$address1=null,$address2=null,$country=null,$state=null,$city=null,$zipcode=null,$industry=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('organization');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($organization)){
			$builder->where('organization',$organization);
		}if(!empty($address1)){
			$builder->where('address1',$address1);
		}if(!empty($address2)){
			$builder->where('address2',$address2);
		}if(!empty($country)){
			$builder->where('country',$country);
		}if(!empty($state)){
			$builder->where('state',$state);
		}if(!empty($city)){
			$builder->where('city',$city);
		}if(!empty($zipcode)){
			$builder->where('zipcode',$zipcode);
		}if(!empty($industry)){
			$builder->where('industry',$industry);
		}return $builder;
	}
	
}