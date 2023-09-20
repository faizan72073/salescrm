<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Reason extends Model {
	
	function get_lostReason($id=null,$reason=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('lostreason');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($reason)){
			$builder->where('reason',$reason);
		} return $builder;
	}

}