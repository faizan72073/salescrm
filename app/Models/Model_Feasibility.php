<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Feasibility extends Model {
	
	function get_Feasibility($id=null,$lead_id=null,$customer_type=null,$customer_name=null,$address=null,$poc=null,$poc_phone=null,$google_coordinates=null,$originally_request_by=null,$sales_person=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('feasibility');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($lead_id)){
			$builder->where('lead_id',$lead_id);
		}if(!empty($customer_type)){
			$builder->where('customer_type',$customer_type);
		}if(!empty($customer_name)){
			$builder->where('customer_name',$customer_name);
		}if(!empty($address)){
			$builder->where('address',$address);
		}if(!empty($poc)){
			$builder->where('poc',$poc);
		}if(!empty($poc_phone)){
			$builder->where('poc_phone',$poc_phone);
		}if(!empty($google_coordinates)){
			$builder->where('google_coordinates',$google_coordinates);
		}if(!empty($originally_request_by)){
			$builder->where('originally_request_by',$originally_request_by);
		}if(!empty($sales_person)){
			$builder->where('sales_person',$sales_person);
		}
		return $builder;
	}
	
}