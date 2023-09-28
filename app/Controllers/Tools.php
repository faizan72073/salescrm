<?php 
namespace App\Controllers;
use App\Models\Model_Warehouse;
use App\Models\Model_Users;
use App\Models\Model_Notifications;



class Tools extends BaseController
{
	public function __construct(){

		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();
		date_default_timezone_set("Asia/Karachi");
	}
	//
	public function notification()
	{
		if(isLoggedIn()){
			$Model_Users = new Model_Users();
			$all_users = $Model_Users->get_users();
			$data['all_users_result'] = $all_users->get()->getResult();
			return view('admin/notification',$data);
		}else {
			return redirect()->to(base_url('login'));
		}
	}

	public function all_reminders()
	{
		if(isLoggedIn()){
			$sess_id = session()->get('id');
			$Model_Notification = new Model_Notifications();
			$Model_Users = new Model_Users();
			//
			$data['myreminderlist'] = $Model_Notification->get_all_reminder($sess_id);
			$data['reminderlistforme'] = $Model_Notification->get_all_reminder();
			$data['all_users'] = $Model_Users->get_users()->get()->getResult();
			//
			return view('admin/all_reminder',$data);
		}else {
			return redirect()->to(base_url('login'));
		}
	}
	
	public function set_reminder(){
		if(isLoggedIn()){
			$Model_Users = new Model_Users();
			$error = null;
			//
			$select_all = $this->input->getPost('select_all');
			$reminderDate = $this->input->getPost('reminderDate');
			// dd($reminderDate);
			$remind_for = $this->input->getPost('remind_for');
			// dd($remind_for);
			// $except_users = $this->input->getPost('except_users');
			$title = $this->input->getPost('title');
			$content = $this->input->getPost('content');
			$user_id = session()->get('id');
			$explodedDateTime = explode('T',$reminderDate);

			$validation =  \Config\Services::validation();
			//
			$validate = $this->validate([
				'reminderDate' => 'required',
				'title' => 'trim|required',
				'content' => 'trim|required',
			]);
			if(!$validate){
				$error = $validation->listErrors();
			}
			if(empty($error)){
				$data = array(
					'date'	=> date('Y-m-d'),
					'time'	=> $explodedDateTime[1],
					'title'	=> $title,
					'text'	=> $content,
					'remind_date'	=> $explodedDateTime[0],
					'user_id'	=>	$user_id,
					'status' => '1'
				);
				$this->db->table('reminder')->insert($data);
				$rem_id = $this->db->insertID();

				if ($select_all == NULL) {
					foreach ($remind_for as $key => $user) {
						$data2 = array(
							'user_id'	=>	$user_id,
							'for'		=>	$user,
							'rem_id'	=>	$rem_id,
							'status'	=>	'0'
						);
						$this->db->table('remind_read')->insert($data2);
					}
				} else {
					$all_users = $Model_Users->get_users()->get()->getResult();
					// dd($all_users);
				        // 
					     foreach ($all_users as $key => $userResult) {
						//
						$data2 = array(
							'user_id'	=>	$user_id,
							'for'		=>	$userResult->id,
							'rem_id'	=>	$rem_id,
							'status'	=>	'0'
						);
						$this->db->table('remind_read')->insert($data2);
					}
				}
				?>
				<script>
					window.location.href = "<?= base_url();?>/tools/all_reminders";
				</script>
				<?php
			}else{ echo $error;}

		}else {
			return redirect()->to(base_url('login'));
		}

	}
	public function delete_reminder(){
		if(isLoggedIn()){
			$rem_id = $this->input->getPost('rem_id');
			$this->db->table('reminder')->where('rem_id', $rem_id)->delete();
		}else {
			return redirect()->to(base_url('login'));
		}
	}
	//
	public function checkNewReminder()
	{
		$error = null;
		//
		if(!isLoggedIn()){
			$error = "Session Timeout";
		}
		//
		if(empty($error)){

		$Model_Notification = new Model_Notifications();
		$data['checkreminder'] = $Model_Notification->checkNewReminder();

		if(!empty($data['checkreminder'])){
		return json_encode($data);
		}
		else{
			return "NULL";
		}
	}
	else{
		return $this->response->setStatusCode(500,$error);
	}

	}
	//
	public function markRead()
	{
		$error = null;
		$user_id = session()->get('id');
		$read_id = $this->input->getPost('read_id');
		$rem_id = $this->input->getPost('rem_id');
		
		//
		if(empty($error)){
		$this->db->table('remind_read')->where('rem_id',$rem_id,'user_id',$user_id)->update(['status' => '1']);
		return $this->response->setStatusCode(200)->setBody('Your Reminder Mark As Read');
		}

		else{
			return $this->response->setStatusCode(500,$error);
		}
	
	}

	
	public function markallRead()
	{

		// echo "hello";
		$error = null;
		$user_id = session()->get('id');

		$error = null;
		//
		if(!isLoggedIn()){
			$error = "Session Timeout";
		}
		// $read_id = $this->input->getPost('read_id');
		// $rem_id = $this->input->getPost('rem_id');
		
		if(empty($error)){
		$this->db->table('remind_read')->where('for', $user_id)->update(['status' => '1']);
		return $this->response->setStatusCode(200)->setBody('Your All Reminder Mark As Read');
		}
		else{
			return $this->response->setStatusCode(500,$error);
		}
	
	}

	
	//
	// public function markReadAll()
	// {
	// 	$sessID = session()->get('id');
	// 	$this->db->table('remind_read')->where('for',$sessID)->update(['status' => '1']);
		
	// }
	//
	public function getReminderById(){

		$error = null;
		//
		if(!isLoggedIn()){
			$error = "Session Timeout";
		}

		$rem_id = $this->input->getPost('rem_id');
		//
		if(empty($error)){
		$Model_Notification = new Model_Notifications();
		$data['reminders'] = $Model_Notification->getReminderById($rem_id);
		$data['remindersUsers'] = $Model_Notification->getReminderUsersById($rem_id);
        //
		// if($data) {
		// 	return json_encode(array("reminders" => $data, "remindersUsers" => $userData));
		// } else {
		// 	echo "NULL";
		// }
		return json_encode($data);
		}
		else{
			return $this->response->setStatusCode(500,$error);
		}

	}
	//
	public function alert(){

		$acc_user_id = session()->get('id');
		$Model_Notification = new Model_Notifications();
		$query = $Model_Notification->get_all_reminder();
		$rowCount = count($query);
		//
		if($rowCount > 0) { 
			$count = 5;
			if ($rowCount < 5) {
				$count = $rowCount;
			}
			
			for ($i=0; $i < $count ; $i++) { ?>
				<a class="dropdown-item d-flex align-items-center ViewRemind" data-rem_id="<?php echo $query[$i]->rem_id; ?>" data-my_reminder="0">
					<div class="dropdown-list-image mr-3" style="font-size:30px;">
						<i class="fas fa-envelope-open fa-fw"></i>
					</div>
					<div>
						<div class="text-truncate"><?php echo $query[$i]->title; ?></div>
						<div class="small text-gray-500"><?= $query[$i]->firstname.' '.$query[$i]->lastname;?> | <small><?php echo date('M d,Y',strtotime($query[$i]->remind_date));?></small></div>
					</div>
				</a>

			<?php }
			?>
			<a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url();?>/tools/all_reminders">View All Messages</a> 
			<?php
		} else{ ?>
			<a class="dropdown-item text-center small text-gray-500">No message</a> 
			<a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url();?>/tools/all_reminders">View All Messages</a> 
		<?php }
	}
	//
	public function voice(){
	
		return view('voice');
	}

	public function pdf($id){
		
		$data = array(
			
			'pdf_id' => $id,

		);
		// dd($data);

		return view('admin/pdf',$data);
	}


	public function bell_notification()
	{
		if(isLoggedIn()){
			$sess_id = session()->get('id');
			$Model_Notification = new Model_Notifications();
			$Model_Users = new Model_Users();
			//
			$data['myreminderlist'] = $Model_Notification->get_all_reminder($sess_id);
			$data['reminderlistforme'] = $Model_Notification->get_all_reminder();
			$data['all_users'] = $Model_Users->get_users()->get()->getResult();
			//
			return view('cpanel-layout/navbar',$data);
		}else {
			return redirect()->to(base_url('login'));
		}
	}






}
