<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Pipeline extends Model {
	
	function get_pipeline($id=null,$name=null,$p_order=null,$description=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('pipeline');
		if(!empty($id)){
			$builder->where('id',$id);
		} if(!empty($name)){
			$builder->where('name',$name);
		} if(!empty($p_order)){
			$builder->where('p_order',$p_order);
		} if(!empty($description)){
			$builder->where('description',$description);
		} 
		return $builder;
	}

	public function Link_Leads()
	{
		 return $this->belongsTo(Model_Leads::class, 'stage', 'id');
	}

}