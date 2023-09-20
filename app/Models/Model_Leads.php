<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Leads extends Model {
	
	function get_Leads($id=null,$name=null,$startdate=null,$enddate=null,$priority=null,$stage=null,$description=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('leads');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($name)){
			$builder->where('name',$name);
		}if(!empty($startdate)){
			$builder->where('startdate',$startdate);
		}if(!empty($enddate)){
			$builder->where('enddate',$enddate);
		}if(!empty($priority)){
			$builder->where('priority',$priority);
		}if(!empty($description)){
			$builder->where('description',$description);
		} return $builder;
	}

	function get_Leads2($id=null,$name=null,$startdate=null,$enddate=null,$priority=null,$stage=null,$description=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('leads');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($name)){
			$builder->where('name',$name);
		}if(!empty($startdate)){
			$builder->where('startdate',$startdate);
		}if(!empty($enddate)){
			$builder->where('enddate',$enddate);
		}if(!empty($priority)){
			$builder->where('priority',$priority);
		}if(!empty($description)){
			$builder->where('description',$description);
		} return $builder;
	}

	function get_Leads_product($id=null,$lead_id=null,$category_id=null,$product_id=null,$price=null,$quantity=null,$tax=null,$amount=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('lead_products');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($lead_id)){
			$builder->where('lead_id',$lead_id);
		}if(!empty($category_id)){
			$builder->where('category_id',$category_id);
		}if(!empty($product_id)){
			$builder->where('product_id',$product_id);
		}if(!empty($price)){
			$builder->where('price',$price);
		}if(!empty($quantity)){
			$builder->where('quantity',$quantity);
		}if(!empty($tax)){
			$builder->where('tax',$tax);
		}if(!empty($amount)){
			$builder->where('amount',$amount);
		} return $builder;
	}


}