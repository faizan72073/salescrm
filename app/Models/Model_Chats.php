<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Chats extends Model {
	
	function get_Chats($id=null,$user_id=null,$lead_id=null,$chat_text=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('chats');
		if(!empty($id)){
			$builder->where('id',$id);
		}if(!empty($user_id)){
			$builder->where('user_id',$user_id);
		}if(!empty($lead_id)){
			$builder->where('lead_id',$lead_id);
		}if(!empty($chat_text)){
			$builder->where('chat_text',$chat_text);
		} return $builder;
	}

	// public function Link_user()
	// {
	// 	return $this->belongsTo(Model_Users::class, 'user_id', 'id');
	// }

}