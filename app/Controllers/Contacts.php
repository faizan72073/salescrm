<?php

namespace App\Controllers;

use App\Models\Model_Contacts;
use App\Models\Model_EmailSMTP;
use \Hermawan\DataTables\DataTable;


class Contacts extends BaseController
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
		if(isLoggedIn() && access_crud('Contacts','view')){
			return view('admin/contactslist');
		}else{
			return redirect()->to(base_url('403'));
		}
	}

	public function add_contacts()
	{
		//
		$error = null;
		$sess_status = session()->get('status');
		$id = session()->get('id');
		$firstname = $this->input->getPost('firstname');
		$lastname = $this->input->getPost('lastname');
		$email = $this->input->getPost('email');
		$phone = $this->input->getPost('phone');
		$title = $this->input->getPost('title');
		$phonetype = $this->input->getPost('phonetype');
		$remarks = $this->input->getPost('remarks');
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		// if ($sess_status != 'admin') {
		// 	$error = "Access Denied";
		// }
		//
		if(!access_crud('Contacts','create')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'firstname' => ['label' => 'firstname', 'rules' => 'required|trim'],
			'lastname' => ['label' => 'lastname', 'rules' => 'required|trim'],
			'email' => ['label' => 'email', 'rules' => 'required|trim'],
			'phone' => 'trim|required|min_length[11]|max_length[11]',
			'title' => ['label' => 'title', 'rules' => 'required|trim'],
			'phonetype' => ['label' => 'phonetype', 'rules' => 'required|trim'],
			'remarks' => ['label' => 'remarks', 'rules' => 'required|trim'],
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
			$data = array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email' => $email,
				'phone' => $phone,
				'title' => $title,
				'phonetype' => $phonetype,
				'remarks' => $remarks
			);
			//
			$builder = $this->db->table('contacts');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			$this->db->transComplete();
			create_action_log("Contact Id (".$insert_id.")");
			$EmailSMTP = new Model_EmailSMTP();
			$sendmail = $EmailSMTP->sendMail('m.talha@lbi.net.pk','hello testing','hello hi');
			echo $sendmail;
			return $this->response->setStatusCode(200)->setBody('Contact Added Successfully');

			
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	//
	public function show_contacts()
	{
		$sess_status = session()->get('status');
		if (isLoggedIn() && access_crud('Contacts','view')) {

			$contactsModel = new Model_Contacts();
			$query = $contactsModel->get_contacts();
			//
			$ser = 0;
			foreach ($query->get()->getResult() as $value) {

				$firstname = $value->firstname;
				$lastname = $value->lastname;
				$email = $value->email;
				$phone = $value->phone;
				$phonetype = $value->phonetype;
				$title = $value->title;
				$remarks = $value->remarks;
				$id = $value->id;
				//
				$ser++;

				?>
				<tr>
					<td><?php echo $ser; ?></td>
					<td><?php echo $firstname; ?></td>
					<td><?php echo $lastname; ?></td>
					<td><?php echo $title; ?></td>
					<td><?php echo $email; ?></td>
					<td><?php echo $phone; ?></td>
					<td><?php echo $phonetype; ?></td>
					<td><?php echo $remarks; ?></td>

					<td>
						<a href="javascript:void(0);" class="mr-3 text-primary updContactBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Edit" data-contactid="<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delContactBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Delete" data-contactid="<?php echo $id; ?>"><i
								class="fa fa-trash-alt"></i></a>
						<!-- <a href="<?php base_url() ?>/user/allow-access/<?php echo $id; ?>" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="allow access"><i class="ri-lock-line"></i></a> -->
						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
					 -->
					</td>

				</tr>
			<?php }
		}
	}
	//
	public function update_Contact_from()
	{

		$contactid = $this->input->getPost('id');
		// 
		$contactsModel = new Model_Contacts();
		$value = $contactsModel->get_contacts($contactid)->get()->getRow();
		//
		$id = $value->id;
		$firstname = $value->firstname;
		$lastname = $value->lastname;
		$title = $value->title;
		$email = $value->email;
		$phone = $value->phone;
		$phonetype = $value->phonetype;
		$remarks = $value->remarks;
		?>
		<input type="hidden" name="contactid" value="<?php echo $id; ?>">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Firstname</label>
						<input type="text" class="form-control" name="firstname" id="exampleFormControlInput1" required=""
							value="<?= $firstname; ?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Lastname</label>
						<input type="text" class="form-control" name="lastname" id="exampleFormControlInput1" required=""
							value="<?= $lastname; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Email Address</label>
						<input type="email" class="form-control" name="email" id="exampleFormControlInput1" required=""
							value="<?= $email; ?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">phone</label>
						<input type="tel" class="form-control" name="phone" id="exampleFormControlInput1" required=""
							value="<?= $phone; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Phone Type</label>
						<select class="form-control" name="phonetype" id="exampleFormControlInput1">
							<option value="Home">Home</option>
							<option value="Mobile">Mobile</option>
							<option value="Work">Work</option>
							<option value="other">other</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Title</label>
						<input type="text" class="form-control" name="title" id="exampleFormControlInput1" required=""
							value="<?= $title; ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12">
			<div class="form-group">
			<label for="exampleFormControlInput1">Remarks</label>
			  <textarea type="text" class="form-control" name="remarks" id="exampleFormControlInput1"><?= $remarks; ?></textarea>
			</div>
		</div>
		

  </div>
<?php

}
	//
	public function update_contacts()
	{
        $error = null;
		$contactid = $this->input->getPost('contactid');
		$sess_status = session()->get('status');
		$id = session()->get('id');
		//
		if (!isLoggedIn()){
			$error = "Session Timeout";
		}
		//
		// if ($sess_status != 'admin') {
		// 	$error = "Access Denied";
		// }
		// if(!access_crud('Contacts','update')) {
		// 	$error = "You Don`t Have Access To Update That";
		// }

		if(!access_crud('Contacts','update')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'firstname' => ['label' => 'firstname', 'rules' => 'required|trim'],
			'lastname' => ['label' => 'lastname', 'rules' => 'required|trim'],
			'email' => ['label' => 'email', 'rules' => 'required|trim'],
			'phone' => ['label' => 'phone', 'rules' => 'required|trim'],
			'title' => ['label' => 'title', 'rules' => 'required|trim'],
			'phonetype' => ['label' => 'phonetype', 'rules' => 'required|trim'],
			'remarks' => ['label' => 'remarks', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		if(empty($error)) {

			$this->db->transStart();
			//
			$firstname = $this->input->getPost('firstname');
			$lastname = $this->input->getPost('lastname');
			$email = $this->input->getPost('email');
			$phone = $this->input->getPost('phone');
			$title = $this->input->getPost('title');
			$phonetype = $this->input->getPost('phonetype');
			$remarks = $this->input->getPost('remarks');
			//
			$data = array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email' => $email,
				'phone' => $phone,
				'title' => $title,
				'phonetype' => $phonetype,
				'remarks' => $remarks
			);
			$builder = $this->db->table('contacts');
			$builder->where('id', $contactid);
			$builder->update($data);
			//
			$this->db->transComplete();
			create_action_log("Contact Id (".$contactid.")");
			return $this->response->setStatusCode(200)->setBody('Contact Updated Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}
	//
	public function delete_contacts()
	{

		$error = null;
		$sess_status = session()->get('status');
		$id = $this->input->getPost('id');
		//
		if (!isLoggedin()) {
			$error = "Session Timeout";
		}
		//
		// if ($sess_status != 'admin') {
		// 	$error = "Access Denied";
		// }
		//
		if(!access_crud('Contacts','delete')) {
			$error = "You Don`t Have Access To Delete That";
		}
		//
		if (empty($error)) {

			if (!empty($id)) {
				//
				$db = \Config\Database::connect();
				//
				$this->db->transStart();
				//
				$builder = $db->table('contacts');
				$builder->where('id', $id);
				$builder->delete();
				//
				$builder = $db->table('crud_access');
				$builder->where('id', $id);
				$builder->delete();
				//
				create_action_log("Contact Id (".$id.")");
				//
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('Contact Deleted Successfully');
			}
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}

}