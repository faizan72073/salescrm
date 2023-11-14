<?php

namespace App\Controllers;

use App\Models\Model_Users;
use App\Models\Model_Pipeline;
use App\Models\Model_Leads;
use App\Models\Model_Chats;
use App\Models\Model_Tools;
use App\Models\Model_Reminder;
use App\Models\Model_Followup;
use App\Models\Model_Setting;
use App\Models\Model_Lead_Timeline;
use App\Models\Model_Lead_Products;
use App\Models\Model_Feasibility;
use App\Models\Model_Notifications;


class Lead extends BaseController
{
	public function __construct()
	{

		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();
	}
	//
	public function index()
	{
		$sess_status = session()->get('status');
		$user_id = session()->get('id');
		$department = session()->get('department');
		$department_status = session()->get('status');

		if(isLoggedIn() && access_crud('Leads','view')){

			$pipelineModel = new Model_Pipeline();
			$LeadsModel = new Model_Leads();
			$tool = new Model_Tools();
			$modelSetting = new Model_Setting();
			$modelFeasibility = new Model_Feasibility();
			//
			$data['pipeline'] = $pipelineModel->get_pipeline()->orderBy('p_order');
			$data['pipeline2'] = $pipelineModel->get_pipeline()->orderBy('p_order');
			if($department == 'Sales' && $department_status == 'hod'){
			$data['leads'] = $LeadsModel->get_Leads()->where('stage',1)->get()->getResult();
			}
			else{
				$data['leads'] = $LeadsModel->get_Leads()->where('stage',1)->get()->getResult();
			}
			// dd($data['leads']);
			$data['Feasibility'] = $modelFeasibility->get_Feasibility();
			$data['country'] = $tool->get_country();
			$data['categories'] = $modelSetting->get_categories()->get()->getResult();
			$data['email_templates'] = $modelSetting->get_email_template()->where('status', 'Active');
			//
			return view('admin/lead', $data);
		}else{

			return redirect()->to(base_url('403'));
		}


	}

	//this function is used to edit all lead detail like lead,product,reminder,follow up 
	public function edit_leads($id)
	{
	
		$pipelineModel = new Model_Pipeline();
		$LeadsModel = new Model_Leads();
		$reminder = new Model_Reminder();
		$follow_up = new Model_Followup();
		$modelSetting = new Model_Setting();
		$modelLeadProduct = new Model_Lead_Products();
		$LeadTimeline = new Model_Lead_Timeline();
		$tool = new Model_Tools();
		$modelFeasibility = new Model_Feasibility();
		$Model_Users = new Model_Users();
		$Model_Notification = new Model_Notifications();
		//
		$all_users = $Model_Users->get_users();
		$data['all_users_result'] = $all_users->get()->getResult();
		//
		$data['pipeline2'] = $pipelineModel->get_pipeline()->orderBy('p_order');
		$data['leads'] = $LeadsModel->get_Leads($id)->get()->getRow();

		$sess_id = session()->get('id');
		$data['myreminderlist'] = $Model_Notification->get_all_reminder($sess_id);
		$data['reminderlistforme'] = $Model_Notification->get_all_reminder();
		$data['all_users'] = $Model_Users->get_users()->get()->getResult();

		$data['country'] = $tool->get_country();
		$data['state'] = $tool->get_state();
		// $data['reminder'] = $reminder->get_reminder(null, $id)->get()->getRow();
		// $data['follow_up'] = $follow_up->get_follow_up(null, $id)->get()->getRow();
		$data['Feasibility'] = $modelFeasibility->get_Feasibility(null, $id)->get()->getRow();
		
		$data['categories'] = $modelSetting->get_categories()->get()->getResult();
		$data['categories2'] = $modelSetting->get_categories()->get()->getResult();
		$data['products'] = $modelSetting->get_products()->get()->getResult();

        $data['lead_timeline'] = $LeadTimeline->get_Lead_Timeline(null,$id)->get()->getResult();
		$data['lead_products'] = $modelLeadProduct->get_Leads_product(null, $id)->get()->getResult();
		//
		$data['timeline'] = array();
		//
		$data['lead_timeline'] = $LeadTimeline->get_Lead_Timeline(null,$id)->orderBy('datetime')->get()->getResult();
		
		//
        foreach($data['lead_timeline'] as $item){
			$pipelinedetail = $pipelineModel->get_pipeline($item->pipeline_id)->get()->getRow();
			$getname = $pipelinedetail->name;
			$getdatetime = $item->datetime;
			array_push($data['timeline'],$getname,$getdatetime);  
			// print_r($data['timeline']);
		
		}

		// die();
		// $data['department_name'] = $pipelineModel->get_pipeline()->where('id',1)->get()->getResult();
		// dd($department_name);
		// $names = $department_name->name;
		return view('admin/edit_Leads', $data);
	}
	public function update_lead_form()
	{

		$error = null;
		$sess_status = session()->get('status');
		$lead_id = $this->input->getPost("lead_id");
		//
		$firstname_lead = $this->input->getPost('firstname_lead');
		$lastname_lead = $this->input->getPost('lastname_lead');
		$organization = $this->input->getPost('organization');
		$job_title = $this->input->getPost('job_title');
		$email_address_lead = $this->input->getPost('email_address_lead');
		$phone = $this->input->getPost('phone');
		$country = $this->input->getPost('country');
		$state = $this->input->getPost('state');
		$deal_title = $this->input->getPost('deal_title');
		$currency = $this->input->getPost('currency');
		$amount = $this->input->getPost('amount');
		$industry = $this->input->getPost('industry');
		$expected_close_date = $this->input->getPost('expected_close_date');
		//
		if (!isLoggedIn()) {
			$error = 'Session Timeout';
		}
		//
		if(!access_crud('Leads','update')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'firstname_lead' => ['label' => 'firstname', 'rules' => 'required|trim'],
			'lastname_lead' => ['label' => 'lastname', 'rules' => 'required|trim'],
			'organization' => ['label' => 'organization', 'rules' => 'required|trim'],
			'job_title' => ['label' => 'job title', 'rules' => 'required|trim'],
			'email_address_lead' => ['label' => 'email address', 'rules' => 'required|trim'],
			'phone' => 'trim|required|min_length[11]|max_length[11]',
			'country' => ['label' => 'country', 'rules' => 'required|trim'],
			'state' => ['label' => 'state', 'rules' => 'required|trim'],
			'deal_title' => ['label' => 'deal_title', 'rules' => 'required|trim'],
			'currency' => ['label' => 'currency', 'rules' => 'required|trim'],
			'amount' => ['label' => 'amount', 'rules' => 'required|trim'],
			'industry' => ['label' => 'industry', 'rules' => 'required|trim'],
			'expected_close_date' => ['label' => 'expected_close_date', 'rules' => 'required|trim'],

		]);
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error . "Hint:<pre><h6>    Error In Lead Tab</h6></pre>");
			$error = nl2br($error);
			// $error = "Error in Lead Tab";
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'firstname' => $firstname_lead,
				'lastname' => $lastname_lead,
				'organization' => $organization,
				'job_title' => $job_title,
				'email_address' => $email_address_lead,
				'phone' => $phone,
				'country_id' => $country,
				'state_id' => $state,
				'deal_title' => $deal_title,
				'currency' => $currency,
				'amount' => $amount,
				'industry' => $industry,
				'expected_close_date' => $expected_close_date,
			);
			//
			$builder = $this->db->table('leads')->where('id', $lead_id)->update($data);
			create_action_log("Lead Id (".$lead_id.")");
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Lead Update Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	public function update_reminder_form()
	{

		$error = null;
		$sess_status = session()->get('status');
		$lead_id = $this->input->getPost("lead_id");
		//
		$reminder_type = $this->input->getPost("reminder_type");
		// dd($reminder_type);
		$title = $this->input->getPost("title");
		$date = $this->input->getPost("date");
		$time = $this->input->getPost("time");
		$assigned_to = $this->input->getPost("assigned_to");
		$description = $this->input->getPost("description");
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Leads','create')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'reminder_type' => ['label' => 'reminder type', 'rules' => 'required|trim'],
			'title' => ['label' => 'title', 'rules' => 'required|trim'],
			'date' => ['label' => 'date', 'rules' => 'required|trim'],
			'time' => ['label' => 'time', 'rules' => 'required|trim'],
			'assigned_to' => ['label' => 'assigned to', 'rules' => 'required|trim'],
			'description' => ['label' => 'description', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		if (empty($error)){
			//
			$this->db->transStart();

				$data = [
					'reminder_type' => $reminder_type,
					'title' => $title,
					'date' => $date,
					'time' => $time,
					'lead_id' => $lead_id,
					'assigned_to' => $assigned_to,
					'description' => $description,
				];
				$builder = $this->db->table('lead_reminder')->insert($data);
				$insert_id = $this->db->insertID();
				create_action_log("Reminder Id (".$insert_id.")");
				$this->db->transComplete();

				return $this->response->setStatusCode(200)->setBody('Reminder inserted Successfully');
			}

		else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	public function update_follow_up_form()
	{
		$error = null;
		$lead_id = $this->input->getPost("lead_id");
		$sess_status = session()->get('status');
		$user_id = session()->get('id');
		//
		$follow_up_date = $this->input->getPost("follow_up_date");
		$follow_up_time = $this->input->getPost("follow_up_time");
		$firstname = $this->input->getPost("firstname");
		$lastname = $this->input->getPost("lastname");
		$email_address = $this->input->getPost("email_address");
		$template = $this->input->getPost("template");
		$email_template = $this->input->getPost("email_template");
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Leads','create')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'follow_up_date' => ['label' => 'follow up date', 'rules' => 'required|trim'],
			'follow_up_time' => ['label' => 'follow up time', 'rules' => 'required|trim'],
			'firstname' => ['label' => 'firstname', 'rules' => 'required|trim'],
			'lastname' => ['label' => 'lastname', 'rules' => 'required|trim'],
			'email_address' => ['label' => 'email address', 'rules' => 'required|trim'],
			'template' => ['label' => 'template', 'rules' => 'required|trim'],
			'email_template' => ['label' => 'email template', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//

		if (empty($error)) {
			$this->db->transStart();
			//
				$data = [
                    'user_id' => $user_id,
					'lead_id' => $lead_id,
					'follow_up_date' => $follow_up_date,
					'follow_up_time' => $follow_up_time,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'email_address' => $email_address,
					'template' => $template,
					'email_template' => $email_template,

				];
				//
				$builder = $this->db->table('lead_follow_up')->insert($data);
				$insert_id = $this->db->insertID();
				create_action_log("Follow Up Id (".$insert_id.")");
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('follow up Insert Successfully');
			} 
		
		else{
			return $this->response->setStatusCode(500, $error);
		}

	}
	//this function is used to Show Chats 
	public function show_chats()
	{
		$lead_id = $this->input->getPost('lead_id');
		//
		$modelUsers = new Model_Users();
		$ModelChats = new Model_Chats();
		$data = $ModelChats->get_Chats(null, null, $lead_id);
		//
		foreach ($data->get()->getResult() as $item) {
			$name = $modelUsers->get_users($item->user_id)->get()->getRow();
			$firstname = $name->firstname;
			$lastname = $name->lastname;
			$id = $item->id;
			?>
			<div class="media">
				<div class="media-head">
					<div class="avatar avatar-sm avatar-warning avatar-rounded">
						<span class="initial-wrap">
							<?= ucfirst($firstname[0]) . ucfirst($lastname[0]); ?>
						</span>
					</div>
				</div>
				<div class="media-body">
					<div>
						<span class="cm-name" style="color:#007D88">
							<?= strtoupper($firstname . ' ' . $lastname); ?>
						</span> &nbsp;&nbsp;<span style="font-size:0.75rem">
							<?php echo $item->chat_at; ?>
						</span>
					</div>
					<p class="fw-medium">
						<?php echo $item->chat_text; ?>
						<?php
						$sess_id = session()->get('id');
						if($item->user_id == $sess_id){
						?>
						<!-- <a href="javascript:void(0);" class="text-danger delChatBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-chatid="<?php echo $id;?>"><i style="font-size:12px;" class="fa fa-trash-alt"></i></a> -->
					<?php
						}
					?>
					</p>
					<div class="separator separator-light"></div>

				</div>
			</div>
			<?php
		}
	?>
	<?php
	}
	//this function is used temporary user delete it after work done
	public function add_chat()
	{
		$error = null;
		$chat_text = $this->input->getPost('chat_text');
		$lead_id = $this->input->getPost('lead_id');
		// $status = session()->get('status');
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Leads','create')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'chat_text' => ['label' => 'comment', 'rules' => 'required|trim'],
		]);
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		if (empty($error)) {

			$user_id = session()->get('id');
			$this->db->transStart();
			$data = array(
				'lead_id' => $lead_id,
				'user_id' => $user_id,
				'chat_text' => $chat_text,
			);
			//
			$builder = $this->db->table('chats')->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Chat id (".$insert_id.")");
			$this->db->transComplete();
			//
			// return $this->response->setStatusCode(200)->setBody('Message Sent Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}
	//
	public function delete_chats(){
		$error = null;
		$id = $this->input->getPost('id');
		$sess_id = session()->get('id');

		// $ModelChats = new Model_Chats();
		// $data = $ModelChats->get_Chats(null,$sess_id)->get()->getRow();
		// $cid = $data->user_id;
		// dd($cid);
		//
		if(!isLoggedin()){
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Leads','delete')) {
			$error = "Access Denied";
		}
		//
		if(empty($error)){
		$db = \Config\Database::connect();
		//
		$this->db->transStart();
		//
		$builder = $db->table('chats');
		$builder->where('id',$id)->where('user_id',$sess_id);
		$builder->delete();
		//
		$builder = $db->table('crud_access');
		$builder->where('id',$id);
		$builder->delete();
		//
		create_action_log("Chat id (".$id.")");
		//
		$this->db->transComplete();
		//
		return $this->response->setStatusCode(200)->setBody('chat Deleted Successfully');
	   }
	else{
		return $this->response->setStatusCode(500, $error);
	}
}


//
	public function add_leads()
	{
		$error = null;
		$id = session()->get('id');
		//lead
		$firstname_lead = $this->input->getPost('firstname_lead');
		$firstname_lead = ucfirst($firstname_lead);
		$lastname_lead = $this->input->getPost('lastname_lead');
		$organization = $this->input->getPost('organization');
		$job_title = $this->input->getPost('job_title');
		$email_address_lead = $this->input->getPost('email_address_lead');
		$phone = $this->input->getPost('phone');
		$country = $this->input->getPost('country');
		$state = $this->input->getPost('state');
		$deal_title = $this->input->getPost('deal_title');
		$currency = $this->input->getPost('currency');
		$amount = $this->input->getPost('amount');
		$industry = $this->input->getPost('industry');
		$expected_close_date = $this->input->getPost('expected_close_date');
		//product
		$category = $this->input->getPost('category');
		$product = $this->input->getPost('product');
		$price = $this->input->getPost('price');
		$quantity = $this->input->getPost('quantity');
		$tax = $this->input->getPost('tax');
		$discount = $this->input->getPost('discount');
		$amount_product = $this->input->getPost('amount_product');
		//reminder
		$title = $this->input->getPost("title");
		$reminder_type = $this->input->getPost("reminder_type");
		$date = $this->input->getPost("date");
		$time = $this->input->getPost("time");
		$assigned_to = $this->input->getPost("assigned_to");
		$description = $this->input->getPost("description");
		//follow up
		$follow_up_date = $this->input->getPost("follow_up_date");
		$follow_up_time = $this->input->getPost("follow_up_time");
		$firstname = $this->input->getPost("firstname");
		$lastname = $this->input->getPost("lastname");
		$email_address = $this->input->getPost("email_address");
		$template = $this->input->getPost("template");
		$email_template = $this->input->getPost("email_template");
		//feasibility form
		//
		$customer_type = $this->input->getPost("customer_type");
		$address = $this->input->getPost("address");
		$customer_name = $this->input->getPost("customer_name");
		$poc = $this->input->getPost("poc");
		$poc_phone = $this->input->getPost("poc_phone");
		$google_coordinates = $this->input->getPost("google_coordinates");
		// dd($google_coordinates);
		$originally_request_by = $this->input->getPost("originally_request_by");
		$sales_person = $this->input->getPost("sales_person");
		$sess_status = session()->get('status');
		//
		if (!isLoggedIn()) {
			$error = 'Session Timeout';
		}
		if(!access_crud('Leads','create')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'firstname_lead' => ['label' => 'firstname', 'rules' => 'required|trim'],
			'lastname_lead' => ['label' => 'lastname', 'rules' => 'required|trim'],
			'organization' => ['label' => 'organization', 'rules' => 'required|trim'],
			'job_title' => ['label' => 'job title', 'rules' => 'required|trim'],
			'email_address_lead' => ['label' => 'email address', 'rules' => 'required|trim'],
			'phone' => 'required|min_length[11]|max_length[11]',
			'country' => ['label' => 'country', 'rules' => 'required|trim'],
			'state' => ['label' => 'state', 'rules' => 'required|trim'],
			'deal_title' => ['label' => 'deal_title', 'rules' => 'required|trim'],
			'currency' => ['label' => 'currency', 'rules' => 'required|trim'],
			'amount' => ['label' => 'amount', 'rules' => 'required|trim'],
			'industry' => ['label' => 'industry', 'rules' => 'required|trim'],
			'expected_close_date' => ['label' => 'expected_close_date', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error . "Hint:<pre><h6>    Error In Lead Tab</h6></pre>");
			$error = nl2br($error);
			// $error = "Error in Lead Tab";
		}
		//
		$pipelineModel = new Model_Pipeline();
		$pipeDetail = $pipelineModel->get_pipeline();
		if ($pipeDetail->countAllResults() <= 0) {
			$error = 'Please create pipeline first';
		}
		//////////////////////////////////////////////////
		if (empty($error)) {
			//
			$pipelineModel = new Model_Pipeline();
			$pipeDetail = $pipelineModel->get_pipeline()->orderBy('p_order', 'ASC')->get()->getRow();
			//
			$data = array(
				'user_id' => $id,
				'firstname' => $firstname_lead,
				'lastname' => $lastname_lead,
				'organization' => $organization,
				'job_title' => $job_title,
				'pipeline_id' => $pipeDetail->id,
				'email_address' => $email_address_lead,
				'phone' => $phone,
				'country_id' => $country,
				'state_id' => $state,
				'deal_title' => $deal_title,
				'currency' => $currency,
				'amount' => $amount,
				'industry' => $industry,
				'expected_close_date' => $expected_close_date,
			);
			$builder = $this->db->table('leads')->insert($data);
			$insert_id = $this->db->insertID();
			//
			if (!empty($category)) {
				foreach ($category as $key => $valuecategory) {
					$builder = $this->db->table('lead_products')->insert(['lead_id' => $insert_id, 'category_id' => $category[$key], 'product_id' => $product[$key], 'price' => $price[$key], 'quantity' => $quantity[$key], 'tax' => $tax[$key], 'discount' => $discount[$key], 'amount' => $amount_product[$key]]);
			   }
			}
			//reminer insert
			if (!empty($_POST["reminder_type"] && $_POST["title"] && $_POST["date"] && $_POST["time"] && $_POST["assigned_to"] && $_POST["description"])) {
				//
				$data3 = array(
					'reminder_type' => $reminder_type,
					'title' => $title,
					'date' => $date,
					'time' => $time,
					'assigned_to' => $assigned_to,
					'lead_id' => $insert_id,
					'description' => $description,
				);
				//
				$builder = $this->db->table('lead_reminder')->insert($data3);
			}
			//follow_up insert
			if (!empty($_POST["follow_up_date"] && $_POST["follow_up_time"] && $_POST["firstname"] && $_POST["lastname"] && $_POST["email_address"] && $_POST["template"] && $_POST["email_template"])) {
				//
				$data4 = array(
					'user_id' => $id,
					'follow_up_date' => $follow_up_date,
					'follow_up_time' => $follow_up_time,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'email_address' => $email_address,
					'template' => $template,
					'lead_id' => $insert_id,
					'email_template' => $email_template,
				);
				//
				$builder = $this->db->table('lead_follow_up')->insert($data4);
			}

			//feasibility insert
			if (!empty($_POST["customer_type"] && $_POST["customer_name"] && $_POST["address"] && $_POST["poc"] && $_POST["poc_phone"] && $_POST["google_coordinates"] && $_POST["originally_request_by"] && $_POST["sales_person"])) {
			   //
				$data5 = array(
				  'customer_type' => $customer_type,
				  'customer_name' => $customer_name,
				  'address' => $address,
				  'poc' => $poc,
				  'poc_phone' => $poc_phone,
				  'google_coordinates' => $google_coordinates,
				  'originally_request_by' => $originally_request_by,
				  'lead_id' => $insert_id,
				  'sales_person' => $sales_person,
				);
			//
			$builder = $this->db->table('feasibility')->insert($data5);
			}

			$user_id = session()->get('id');
			//
			$data6=[
				'lead_id' => $insert_id,
				'pipeline_id' => $pipeDetail->id,
				'user_id' => $user_id,
			];
			//
			$builder = $this->db->table('lead_timeline')->insert($data6);

			create_action_log("Lead Id (".$insert_id.")");
			return $this->response->setStatusCode(200)->setBody('Lead Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}

	//this function is used to show specific lead
	public function leads_detail(){

		$error = null;
		$id = $this->input->getPost('id');
		//
		$leaddata = new Model_Leads();
		$data['lead'] = $leaddata->get_Leads()->where('id', $id)->get()->getRow();
		//
		$response = json_encode($data);
		return $response;
	}
	//this function is used to update lead or move lead to another department
	public function update_lead_pipeline(){

		$error = null;
		$pipid = $this->input->getpost('pipid');
		$leadid = $this->input->getpost('leadid');
		$sess_status = session()->get('status');
		$id = session()->get('id');
		//
		// if ($sess_status != 'admin') {
		// 	$error = "Access Denied";
		// }
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Leads','update')) {
			$error = "Access Denied";
		}
		if (empty($error)) {
			$data = [
				'pipeline_id' => $pipid,
			];
			//
			$builder = $this->db->table('leads')->where('id', $leadid)->update($data);
			//the below code is used for action logs fro lead timeline
			$user_id = session()->get('id');
						//
			$data=[
				'lead_id' => $leadid,
				'pipeline_id' => $pipid,
				'user_id' => $user_id,
			];
			//
			$builder = $this->db->table('lead_timeline')->insert($data);

			create_action_log("Lead Id (".$leadid.")");

			return $this->response->setStatusCode(200)->setBody('Lead stage updated successfully');

		} else {
			return $this->response->setStatusCode(500, $error);
		}
 }
	public function addReminder()
	{

		$error = null;
		$sess_status = session()->get('status');
		$id = session()->get('id');
		$title = $this->input->getPost("title");
		$date = $this->input->getPost("date");
		$time = $this->input->getPost("time");
		$assigned_to = $this->input->getPost("assigned_to");
		$description = $this->input->getPost("description");
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'title' => ['label' => 'title', 'rules' => 'required|trim'],
			'date' => ['label' => 'date', 'rules' => 'required|trim'],
			'time' => ['label' => 'time', 'rules' => 'required|trim'],
			'assigned_to' => ['label' => 'assigned_to', 'rules' => 'required|trim'],
			'description' => ['label' => 'description', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//

		if (empty($error)) {
			$data = [
				'title' => $title,
				'date' => $date,
				'time' => $time,
				'assigned_to' => $assigned_to,
				'description' => $description,
			];
			//
			$builder = $this->db->table('lead_reminder')->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Reminder id (".$insert_id.")");
			return $this->response->setStatusCode(200)->setBody('Reminder Set Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}


	}
	//
	public function addFollowup()
	{

		$error = null;
		$sess_status = session()->get('status');
		$user_id = session()->get('id');
		$follow_up_date = $this->input->getPost("follow_up_date");
		$follow_up_time = $this->input->getPost("follow_up_time");
		$firstname = $this->input->getPost("firstname");
		$lastname = $this->input->getPost("lastname");
		$email_address = $this->input->getPost("email_address");
		$template = $this->input->getPost("template");
		$email_template = $this->input->getPost("email_template");
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'follow_up_date' => ['label' => 'follow up date', 'rules' => 'required|trim'],
			'follow_up_time' => ['label' => 'follow up time', 'rules' => 'required|trim'],
			'firstname' => ['label' => 'firstname', 'rules' => 'required|trim'],
			'lastname' => ['label' => 'lastname', 'rules' => 'required|trim'],
			'email_address' => ['label' => 'emailaddress', 'rules' => 'required|trim'],
			'template' => ['label' => 'template', 'rules' => 'required|trim'],
			'email_template' => ['label' => 'email template', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		if (empty($error)) {
			$data = [
				'user_id' => $user_id,
				'follow_up_date' => $follow_up_date,
				'follow_up_time' => $follow_up_time,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email_address' => $email_address,
				'template' => $template,
				'email_template' => $email_template,

			];
			//
			$builder = $this->db->table('lead_follow_up')->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Follow id (".$insert_id.")");
			return $this->response->setStatusCode(200)->setBody('follow up Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
}

	public function get_product_ac_category()
	{

		$id = $this->input->getPost('id');
		// dd($id);
		$modelSetting = new Model_Setting();
		$data['products'] = $modelSetting->get_products()->where('category_id', $id)->get()->getresult();

		$response = json_encode($data);
		return $response;

	}

	public function get_data_ac_product()
	{

		$id = $this->input->getPost('id');

		$modelSetting = new Model_Setting();
		$data['products_data'] = $modelSetting->get_products()->where('id', $id)->get()->getRow();

		$response = json_encode($data);
		return $response;

	}

	public function delete_lead_products()
	{

		$error = null;
		$id = $this->input->getPost('id');
		//
		if (!isLoggedin()) {
			$error = "Session Timeout";
		}
		//
		if (empty($error)) {
			if (!empty($id)) {
				//
				$db = \Config\Database::connect();
				//
				$this->db->transStart();
				//
				$builder = $db->table('lead_products');
				$builder->where('id', $id);
				$builder->delete();
				//
				$builder = $db->table('crud_access');
				$builder->where('id', $id);
				$builder->delete();
				//
				create_action_log("Product Id (".$id.")");
				//
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('product Deleted Successfully');
			}
		} else {
		return $this->response->setStatusCode(500, $error);
	}
}

	public function add_lead_product(){

		$error = null;
		//
		$category = $this->input->getPost('category');
		$lead_product_id = $this->input->getPost('lead_product_id');
		$product = $this->input->getPost('product');
		$price = $this->input->getPost('price');
		$quantity = $this->input->getPost('quantity');
		$tax = $this->input->getPost('tax');
		$amount_product = $this->input->getPost('amount_product');
		//
		$sess_status = session()->get('status');
		//
		if (!isLoggedIn()) {
			$error = 'Session Timeout';
		}
		// if ($sess_status != 'admin') {
		// 	$error = 'Access Denied';
		// }
		if(!access_crud('Leads','create')) {
			$error = "Access Denied";
		}
		//
		if (empty($error)) {

			foreach ($category as $key => $valuecategory) {
				// var_dump($category);
				$builder = $this->db->table('lead_products')->insert(['lead_id' => $lead_product_id, 'category_id' => $category[$key], 'product_id' => $product[$key], 'price' => $price[$key], 'quantity' => $quantity[$key], 'tax' => $tax[$key], 'amount' => $amount_product[$key]]);
			}
			$insert_id = $this->db->insertID();
			create_action_log("Product Id (".$insert_id.")");
			return $this->response->setStatusCode(200)->setBody('New product Added Successfully');

		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	public function lead_won()
	{

		$error = null;
		$id = session()->get('id');
		//
		$lead_id = $this->input->getPost('lead_id');
		$status = $this->input->getPost('status');

		if(!access_crud('Leads','update')) {
			$error = "Access Denied";
		}
		//
		if(!special_access('can won the lead')){
			$error = "Access Denied";
		}
		//
		if(empty($error)){
		$data = [
			'status' => $status,
		];
		$builder = $this->db->table('leads')->where('id', $lead_id)->update($data);
		create_action_log("Lead Id (".$lead_id.")");
		return $this->response->setStatusCode(200)->setBody('Lead Won');
	}
	else{

		return $this->response->setStatusCode(500, $error);
	}

}
	public function lead_loss()
	{

		$error = null;
		$id = session()->get('id');
		//
		$lead_id = $this->input->getPost('lead_id');
		$status = $this->input->getPost('status');

		if(!access_crud('Leads','update')) {
			$error = "Access Denied";
		}
		//
		if(!special_access('Can loss the lead')){
			$error = "Access Denied";
		}

		if(empty($error)){

		$data = [
			'status' => $status,
		];
		$builder = $this->db->table('leads')->where('id', $lead_id)->update($data);

		create_action_log("Lead Id (".$lead_id.")");
		return $this->response->setStatusCode(200)->setBody('Lead Lost');

	}
	else{
		return $this->response->setStatusCode(500, $error);
	}
}

	public function show_reminders(){

		$id = $this->input->getPOst('id');
		$sess_status = session()->get('status');
		$user_id = session()->get('id');
		if(isLoggedIn()){

			$Remindermodel = new Model_Reminder();
			$query=$Remindermodel->get_reminder()->where('lead_id',$id);
		//
			$ser=0;
			foreach ($query->get()->getResult() as $value) {
				$title=$value->title;
				$date=$value->date;
				$time=$value->time;
				$assigned_to=$value->assigned_to;
				$description=$value->description;
				$id=$value->id;
                  //
				$ser++;
				?>
				<tr>
                    <td><?php echo $ser;?></td>
					<td><?php echo $title;?></td>
					<td><?php echo $date;?></td>
					<td><?php echo $time;?></td>
					<td><?php echo $assigned_to;?></td>
					<td><?php echo $description;?></td>

					<td>
						<!-- <a href="javascript:void(0);" class="mr-3 text-primary updReminderBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-reminderid="<?php echo $id;?>"><i class="fa fa-edit"></i></a> -->
						<a href="javascript:void(0);" class="text-danger delReminderBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-reminderid="<?php echo $id;?>"><i class="fa fa-trash-alt"></i></a>

						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
					 -->
					</td>
				</tr>
			<?php } 
		}
	}

	public function delete_lead_reminder(){
		$error = null;
		$id = $this->input->getPost('id');
		//
		if(!isLoggedin()){
			$error = "Session Timeout";
		}
		//
		if(empty($error)){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('lead_reminder');
		$builder->where('id',$id);
		$builder->delete();
		//
		$builder = $db->table('crud_access');
		$builder->where('id',$id);
		$builder->delete();
		//
		$insert_id = $this->db->insertID();
		create_action_log("Reminder Id (".$id.")");
		//
		return $this->response->setStatusCode(200)->setBody('reminder Deleted Successfully');
	   }
	else{
		return $this->response->setStatusCode(500, $error);
	}
}




public function show_follow_up(){

	$id = $this->input->getPOst('id');
	$sess_status = session()->get('status');
	$user_id = session()->get('id');
	if(isLoggedIn()){

		$Followupmodel = new Model_Followup();

		if($sess_status == 'admin'){

			$query=$Followupmodel->get_follow_up()->where('lead_id',$id);
		}
		else{
			$query=$Followupmodel->get_follow_up()->where('lead_id',$id)->where('user_id', $user_id);
		}
		
	//
		$ser=0;
		foreach ($query->get()->getResult() as $value) {
			$follow_up_date=$value->follow_up_date;
			$follow_up_time=$value->follow_up_time;
			$firstname	=$value->firstname	;
			$lastname=$value->lastname;
			$email_address=$value->email_address;
			$template=$value->template;
			$email_template=$value->email_template;
			$id=$value->id;
			  //
			$ser++;
			?>
			<tr>
				<td><?php echo $ser;?></td>
				<td><?php echo $follow_up_date;?></td>
				<td><?php echo $follow_up_time;?></td>
				<td><?php echo $firstname;?></td>
				<td><?php echo $lastname;?></td>
				<td><?php echo $email_address;?></td>
				<td><?php echo $template;?></td>
				<td><?php echo $email_template;?></td>

				<td>
					<!-- <a href="javascript:void(0);" class="mr-3 text-primary updReminderBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-reminderid="<?php echo $id;?>"><i class="fa fa-edit"></i></a> -->
					<a href="javascript:void(0);" class="text-danger delFollowupBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-followupid="<?php echo $id;?>"><i class="fa fa-trash-alt"></i></a>

					<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
				 -->
				</td>
			</tr>
		<?php } 
	}
}
//
public function delete_lead_follow_up(){
	$error = null;
	$id = $this->input->getPost('id');
	$user_id = session()->get('id');

	//
	if(!isLoggedin()){
		$error = "Session Timeout";
	}
	//
	if(empty($error)){
	$db = \Config\Database::connect();
	//
	$builder = $db->table('lead_follow_up');
	$builder->where('id',$id);
	$builder->delete();
	//
	$builder = $db->table('crud_access');
	$builder->where('id',$id);
	$builder->delete();
	//
	$insert_id = $this->db->insertID();
	create_action_log("user id (".$insert_id.")");
	//
	return $this->response->setStatusCode(200)->setBody('follow up Deleted Successfully');
   }
else{
	return $this->response->setStatusCode(500, $error);
}
}

public function update_feasibility_form()
{

	$error = null;
	$sess_status = session()->get('status');
	$lead_id = $this->input->getPost("lead_id");
	//
	$customer_type = $this->input->getPost("customer_type");
	// dd($reminder_type);
	$customer_name = $this->input->getPost("customer_name");
	$poc = $this->input->getPost("poc");
	$poc_phone = $this->input->getPost("poc_phone");
	$address = $this->input->getPost("address");
	$google_coordinates = $this->input->getPost("google_coordinates");
	$originally_request_by = $this->input->getPost("originally_request_by");
	$sales_person = $this->input->getPost("sales_person");
	//
	if (!isLoggedIn()) {
		$error = "Session Timeout";
	}

	if(!access_crud('Leads','update')) {
		$error = "Access Denied";
	}
	//
	// if(!access_crud('Leads','update')) {
	// 	$error = "You Don`t Have Access To Update That";
	// }
	//
	$validation = \config\Services::validation();
	//
	$validate = $this->validate([
		'customer_type' => ['label' => 'customer type', 'rules' => 'required|trim'],
		'customer_name' => ['label' => 'customer name', 'rules' => 'required|trim'],
		'poc' => ['label' => 'poc', 'rules' => 'required|trim'],
		'poc_phone' => ['label' => 'poc phone', 'rules' => 'required|trim'],
		'address' => ['label' => 'address', 'rules' => 'required|trim'],
		'google_coordinates' => ['label' => 'google coordinates', 'rules' => 'required|trim'],
		'originally_request_by' => ['label' => 'originally request by', 'rules' => 'required|trim'],
		'sales_person' => ['label' => 'sales person', 'rules' => 'required|trim'],
	]);
	//
	if (!$validate) {
		$error = $validation->listErrors();
		$error = str_replace(array("\n", "\r"), '', $error);
		$error = nl2br($error);
	}
	//
	if (empty($error)){

		$feasibilitydata = new Model_Feasibility();
		$get_data = $feasibilitydata->get_feasibility(null,$lead_id);
		$results = $get_data->CountAllResults();
		// dd($results);
		if($results > 0){
		//
		$this->db->transStart();

			$data = [
				'customer_type' => $customer_type,
				'customer_name' => $customer_name,
				'poc' => $poc,
				'poc_phone' => $poc_phone,
				'address' => $address,
				'google_coordinates' => $google_coordinates,
				'originally_request_by' => $originally_request_by,
				'sales_person' => $sales_person,
			];
			$builder = $this->db->table('feasibility')->where('lead_id',$lead_id)->update($data);
			$this->db->transComplete();
			$insert_id = $this->db->insertID();
			create_action_log("feasibility id (".$insert_id.")");
			return $this->response->setStatusCode(200)->setBody('Feasibility Form Updated Successfully');
		}
	   else{
				$data = [
					'lead_id' => $lead_id,
					'customer_type' => $customer_type,
					'customer_name' => $customer_name,
					'poc' => $poc,
					'poc_phone' => $poc_phone,
					'address' => $address,
					'google_coordinates' => $google_coordinates,
					'originally_request_by' => $originally_request_by,
					'sales_person' => $sales_person,
				];
				$builder = $this->db->table('feasibility')->insert($data);
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('Feasibility Form Inserted Successfully');

           }
      }
		else {
			return $this->response->setStatusCode(500, $error);
	    }
  }

  public function upload_po(){

	$error = null;
	$po = $this->input->getFile("PO");
	// $type = mime_content_type($po);
	// echo $type;
	// // $slice = explode('/',$po);
	// // echo $slice[2];
	$lead_id = $this->input->getPost("lead_id");
	$datetime = date('y-m-d H:i:s');
	$sess_status = session()->get('status'); 

	if(!isLoggedIn()){
		$error = "session Timeout";
	}
	//
	if(!special_access('Can upload PO')){
		$error = "Access Denied";
	}
	//
	if($po == ''){
		$error = "Please Select PO";
	}
	//
	// $extension = explode('.',$po);
	// dd($extension[0]);
	// $validation = \config\Services::validation();

	if(empty($error)){

		if (!empty($_FILES['PO']['name'])) {
			if (file_exists('./assets/po/po-'.$lead_id.'.pdf')) {
				unlink('./assets/po/po-'.$lead_id.'.pdf'); // delete old if exist
			}
			$po->move('./assets/po', 'po-'."$lead_id".'.pdf');
		    //
			$data=[
				'po_datetime' => $datetime,
			];
			//
			$builder = $this->db->table('leads')->where('id',$lead_id)->update($data);
			return $this->response->setStatusCode(200)->setBody('PO Uploaded Successfully');
		}
   }
	else{
		return $this->response->setStatusCode(500, $error);
	}

}


  public function stage_2(){

	$error = null;
	$lead_id = $this->input->getPost('lead_id');
	$sess_status = session()->get('status'); 
	//
	if(!isLoggedIn()){
		$error = "session Timeout";
	}

	if(!special_access('Can enable to COFC')){
		$error = "Access Denied";
	}
	//
	if(empty($error)){
		$pipelineModel = new Model_Pipeline();
		$pipeDetail = $pipelineModel->get_pipeline()->orderBy('p_order', 'ASC')->get()->getRow();
		$data = [
			'stage' => 2,
			'pipeline_id' => $pipeDetail->id,
		];
		$builder = $this->db->table('leads')->where('id',$lead_id)->update($data);
		return $this->response->setStatusCode(200)->setBody('Stage 2 Activated');
	}
	else{
		return $this->response->setStatusCode(500, $error);
	}

}

public function delete_pdf(){

	$error = null;
	//
	$lead_id = $this->input->getPost("lead_id");
	$sess_status = session()->get('status'); 
	//
	if(!isLoggedIn()){
		$error = "session Timeout";
	}
	//
	if(empty($error)){

			if (file_exists('./assets/po/po-'.$lead_id.'.pdf')) {
				unlink('./assets/po/po-'.$lead_id.'.pdf'); // delete old if exist
			}

			return $this->response->setStatusCode(200)->setBody('PO Deleted Successfully');

   }
	else{
		return $this->response->setStatusCode(500, $error);
	}

  }


//   public function lead_stage2()
//   {
// 	  $sess_status = session()->get('status');

	  
// 		 return view('admin/lead-stage2');
// 	}

	public function lead_cofc_stage()
	{
		$error = null;
		$sess_status = session()->get('status');

		// if(!special_access('Can enable to COFC','1')){

		// 	$error = "Special Access Denied";
		// }

		if(isLoggedIn() && access_crud('Leads','view')){

			$pipelineModel = new Model_Pipeline();
			$LeadsModel = new Model_Leads();
			//
			$data['pipeline'] = $pipelineModel->get_pipeline()->orderBy('p_order');
			$data['pipeline2'] = $pipelineModel->get_pipeline()->orderBy('p_order');
			$data['leads2'] = $LeadsModel->get_Leads()->where('stage',2)->get()->getResult();
			//
			return view('admin/lead-stage2', $data);
		}else{

			return redirect()->to(base_url('403'));
		}


	}



  }





