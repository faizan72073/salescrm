<?php namespace App\Models;

use CodeIgniter\Model;

class Model_lead_products extends Model {
	
	function get_Leads_product($id=null,$lead_id=null,$category_id=null,$product_id=null,$price=null,$quantity=null,$tax=null,$discount=null,$amount=null){
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
		}if(!empty($discount)){
			$builder->where('discount',$discount);
		}if(!empty($amount)){
			$builder->where('amount',$amount);
		} return $builder;
	}


}