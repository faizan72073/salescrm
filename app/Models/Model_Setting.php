<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Setting extends Model {
	
	public function __construct(){

		parent::__construct();
		$this->db = \Config\Database::connect();
	}
	//
	function setting($attr = null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('settings');
		if(!empty($attr)){
			$builder->where('attribute',$attr);
		}
		return $builder;
	}
	//
	function settingUpdate($attr,$value=null,$param=null){
		$data = array();
		$data['value'] = $value;
		$data['parameter'] = $param;
			//
		$this->db->table('settings')->where('attribute',$attr)->update($data);
	}
	//
	function general_search($text){
		//
		$builder = $this->db->table('customer');
		$builder->like('username',$text);
		$builder->orLike('firstname',$text);
		$builder->orLike('lastname',$text);
		$builder->orLike('email',$text);
		$builder->orLike('nic',$text);
		return $builder;
	}
	//
	function get_products($id=null,$category_id=null,$product_name=null,$product_code=null,$product_category=null,$unit=null,$unit_price=null,$texation=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('products');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($category_id)){
			$builder->where('category_id',$category_id);
		}if(!empty($product_name)){
			$builder->where('product_name',$product_name);
		} if(!empty($product_code)){
			$builder->where('product_code',$product_code);
		} if(!empty($product_category)){
			$builder->where('product_category',$product_category);
		}if(!empty($unit)){
			$builder->where('unit',$unit);
		}if(!empty($unit_price)){
			$builder->where('unit_price',$unit_price);
		}if(!empty($texation)){
			$builder->where('texation',$texation);
		}
		return $builder;
	}

	function get_categories($id=null,$category_name=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('categories');
		if(!empty($id)){
			$builder->where('id',$id);
		} if(!empty($category_name)){

			$builder->where('category_name',$category_name);
		} 
		return $builder;
	}

	function get_company($id=null,$company_name=null,$country=null,$state=null,$city=null,$description=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('company');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($company_name)){
			$builder->where('company_name',$company_name);
		}if(!empty($country)){
			$builder->where('country',$country);
		}if(!empty($state)){
			$builder->where('state',$state);
		}if(!empty($city)){
			$builder->where('city',$city);
		}if(!empty($description)){
			$builder->where('description',$description);
		}return $builder;
	}

	function get_email_template($id=null,$template=null,$template_name=null,$subject=null,$description=null,$status=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('email_template');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($template)){
			$builder->where('template',$template);
		}if(!empty($template_name)){
			$builder->where('template_name',$template_name);
		}if(!empty($subject)){
			$builder->where('subject',$subject);
		}if(!empty($description)){
			$builder->where('description',$description);
		}if(!empty($status)){
			$builder->where('status',$status);
		}return $builder;
	}

	function get_department($id=null,$department_name=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('department');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($department_name)){
			$builder->where('department',$department_name);
		}return $builder;
	}


	function get_cities($id=null,$country_id=null,$state_id=null,$name=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('city');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($country_id)){
			$builder->where('country_id',$country_id);
		} if(!empty($state_id)){
			$builder->where('state_id',$state_id);
		}if(!empty($name)){
			$builder->where('name',$name);
		}
		return $builder;
	}
	

}