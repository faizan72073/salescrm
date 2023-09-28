<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Tools extends Model {
	
	function get_country($id=null,$name=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('country');
		if(!empty($id)){
			$builder->where('id',$id);
		}
		if(!empty($name)){
			$builder->where('name',$name);
		}
		return $builder;
	}
	function get_state($id=null,$country_id=null,$name=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('state');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($country_id)){
			$builder->where('country_id',$country_id);
		}
		if(!empty($name)){
			$builder->where('name',$name);
		}
		return $builder;
	}

	function get_cities($id=null,$state_id=null,$name=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('city');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($state_id)){
			$builder->where('state_id',$state_id);
		}
		if(!empty($name)){
			$builder->where('name',$name);
		}
		return $builder;
	}

	function get_country_state_city(){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('country');
		$builder->select('country.*, state.name as state_name, city.name as city_name');
		$builder->join('state','country.id = state.country_id');
		$builder->join('city','state.id = city.state_id');
		$builder->OrderBy('name','ASC');

		$query = $builder->get()->getResult();
		return $query;
	}

	

}