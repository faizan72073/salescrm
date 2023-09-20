<?php namespace App\Models;

use CodeIgniter\Model;

class Model_Notifications extends Model {
	
	// function get_all_reminder($id=null,$user_id=null,$date=null,$time=null,$title=null,$text=null,$remind_data=null){
	// 	$db = \Config\Database::connect();
	// 	//
	// 	$builder = $db->table('reminder');
	// 	if(!empty($id)){
	// 		$builder->where('id',$id);
	// 	}if(!empty($user_id)){
	// 		$builder->where('user_id',$user_id);
	// 	}if(!empty($date)){
	// 		$builder->where('date',$date);
	// 	}if(!empty($time)){
	// 		$builder->where('time',$time);
	// 	}if(!empty($title)){
	// 		$builder->where('title',$title);
	// 	}if(!empty($text)){
	// 		$builder->where('text',$text);
	// 	}if(!empty($remind_data)){
	// 		$builder->where('remind_data',$remind_data);
	// 	}return $builder;
	// }

	function get_all_reminder($my_remind = NULL) {
		$today = date('Y-m-d');
		$currentTime = strtotime(date('H:i:s'));
		$user_id = session()->get('id');
		$fromDate = date("Y-m-d", strtotime(date( "Y-m-d", strtotime( $today ) ) . "-3 month" ) );

		$builder = $this->db->table('reminder as rem');
		$builder->select('rem.*, read.*, users.id, users.firstname,users.lastname');
		$builder->join('remind_read as read','read.rem_id = rem.rem_id');
		$builder->join('users as users','read.user_id = users.id');
		if($my_remind) {
			$builder->where('read.user_id', $user_id);
		} else {
			$builder->where('read.for', $user_id);
			$builder->where('rem.remind_date <=', $today);
			$builder->where('rem.remind_date >=', $fromDate);
		}
		$builder->where('rem.status','1');
		$builder->orderBy('read.read_id','DESC');
		$builder->groupBy('read.rem_id');
		$query = $builder->get()->getResult();
		
		if ($my_remind) {
			return $query;
		} else {

			if (count($query) > 0) {
				$query2 = array();
				foreach ($query as $key => $value) {

					if ($value->remind_date == $today) {

						$remindTime = strtotime($value->time);
						if ($currentTime > $remindTime) {
							array_push($query2, $value);
						}

					} else {
						array_push($query2, $value);
					}
				}

				if (count($query2) > 0) {
					return $query2;
				} else {
					return NULL;
				}

			} else {
				return $query;
			}
		}
	}


	function get_all_reminder_for_me($read_id=null,$user_id=null,$for=null,$rem_id=null,$status=null){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('remind_read');
		if(!empty($read_id)){
			$builder->where('read_id',$read_id);
		}if(!empty($user_id)){
			$builder->where('user_id',$user_id);
		}if(!empty($for)){
			$builder->where('for',$for);
		}if(!empty($rem_id)){
			$builder->where('rem_id',$rem_id);
		}if(!empty($status)){
			$builder->where('status',$status);
		}return $builder;
	}

	// function getReminderById($read_id=null,$user_id=null,$for=null,$rem_id=null,$status=null){
	// 	$db = \Config\Database::connect();
	// 	//
	// 	$builder = $db->table('reminder');
	// 	if(!empty($read_id)){
	// 		$builder->where('read_id',$read_id);
	// 	}if(!empty($user_id)){
	// 		$builder->where('user_id',$user_id);
	// 	}if(!empty($user_id)){
	// 		$builder->where('user_id',$user_id);
	// 	}if(!empty($for)){
	// 		$builder->where('for',$for);
	// 	}if(!empty($rem_id)){
	// 		$builder->where('rem_id',$rem_id);
	// 	}if(!empty($text)){
	// 		$builder->where('text',$text);
	// 	}if(!empty($status)){
	// 		$builder->where('status',$status);
	// 	}return $builder;
	// }

	function getReminderById($rem_id) {
		$builder = $this->db->table('reminder');
		$builder->select('reminder.*, users.firstname,users.lastname');
		$builder->join('users as users','reminder.user_id = users.id');
		// $builder->join('remind_read as read','reminder.rem_id = read.rem_id');
		$builder->where('rem_id', $rem_id);
		$query = $builder->get()->getRow();
		// dd($query);
		return $query;
	}

	
	function getReminderUsersById($rem_id) {
		$builder = $this->db->table('remind_read as read');
		$builder->select('read.*, users.id, users.firstname,users.lastname,users.username');
		$builder->join('users as users','read.for = users.id');
		$builder->where('rem_id', $rem_id);
		$query = $builder->get()->getResult();
		return $query;
	}
	function checkNewReminder()
	{
		$user_id = session()->get('id');
		//
		$currentTime = strtotime(date('H:i:s'));
		$today = date('Y-m-d');
		// $fromDate = date("Y-m-d", strtotime(date( "Y-m-d", strtotime( $today )) . "-3 month" ) );
		//
		$builder = $this->db->table('reminder as rem');
		$builder->select('rem.*, read.*, users.id, users.firstname,users.lastname, read.status as readStatus');
		$builder->join('remind_read as read','read.rem_id = rem.rem_id');
		$builder->join('users as users','read.user_id = users.id');
		$builder->where('read.for', $user_id);
		$builder->where('read.status', '0');
		$builder->where('rem.status', '1');
		$builder->where('rem.remind_date =', $today);
		$builder->where('rem.time <=', $currentTime);
		$builder->orderBy('read.read_id','DESC');
		$query = $builder->get()->getResultArray();

		if (count($query) > 0) {
			$query2 = array();
			foreach ($query as $key => $value) {
				if ($value['remind_date'] == $today){

					$remindTime = strtotime($value['time']);
					if ($currentTime > $remindTime) {
						array_push($query2, $value);
					}
				}else{
					array_push($query2, $value);
				}
			}
			if (count($query2) > 0) {
				return $query2;
			} else {
				return NULL;
		   }
		} 
		else {
		return NULL;
	  }

	}


	
}

