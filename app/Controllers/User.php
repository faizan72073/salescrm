<?php

namespace App\Controllers;
use App\Models\Model_Users;
use App\Models\Model_Menu;
use App\Models\Model_Pipeline;
use App\Models\Model_Setting;
use \Hermawan\DataTables\DataTable;


class User extends BaseController
{
	public function __construct(){

		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();
	}
	//
	public function index()
	{
		$sess_status = session()->get('status');
		if(isLoggedIn() && $sess_status == 'admin'){
			$pipelineModel = new Model_Pipeline();
			$settingModel = new Model_Setting();
			$data['department'] = $settingModel->get_department();
			$data['companies'] = $settingModel->get_company();
			return view('admin/userlist',$data);
		}else{
			return redirect()->to(base_url('login'));
		}

	}
	//
	public function show_users(){
		$sess_status = session()->get('status');
		if(isLoggedIn() && $sess_status == 'admin'){

			$userModel = new Model_Users();
			$query=$userModel->get_users(null,null,null,['admin','user']);
		//
			$ser=0;
			foreach ($query->get()->getResult() as $value) {

				$modelsetting = new Model_Setting();
				$departmentdetail = $modelsetting->get_department($value->department_id)->get()->getRow();
				$companydetail = $modelsetting->get_company($value->company_id)->get()->getRow();
				//
				$departmentname = $departmentdetail->department;
				$companyname = $companydetail->company_name;

				$user=$value->username;
				$fname=$value->firstname;
				$lname=$value->lastname;
				$password=$value->password;
				$email=$value->email;
				$mobilephone=$value->mobilephone;
				// $department=$value->department_id;
				$status=$value->status;
				$id=$value->id;
                  //
				$ser++;
				$deletemodal="$('#deleteModel').modal('show');document.getElementById('duserid').value=";
				if($value->block == 'no'){
					$activetxt = 'Active'; $class = 'success';  
				}else{
					$activetxt = 'Block'; $class = 'danger';
				}
				?>
				<tr>
					<td><?php echo $ser;?></td>
					<td><?php echo $user;?></td>
					<td><?php echo $fname;?></td>
					<td><?php echo $lname;?></td>
					<td><?php echo $email;?></td>
					<td><?php echo $departmentname;?></td>
					<td><?php echo $companyname;?></td>
					<td><?php echo $mobilephone;?></td>
					<td><span class="badge badge-soft-primary"><?php echo $status;?></span></td>
					<td><span class="badge badge-soft-<?php echo $class;?>"><?php echo $activetxt;?></span></td>
					<td>
						<a href="javascript:void(0);" class="mr-3 text-primary updUserBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-userid="<?php echo $id;?>"><i class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delUserBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-userid="<?php echo $id;?>"><i class="fa fa-trash-alt"></i></a>
						<a href="<?php base_url() ?>/user/allow-access/<?php echo $id;?>" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="allow access"><i class="ri-lock-line"></i></a>

						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
					 -->
					</td>
				</tr>
			<?php } 
		}
	}
	//
	public function update_form(){
		$pipelineModel = new Model_Pipeline();
		$settingModel = new Model_Setting();
		$userModel = new Model_Users();
		//
		$data = $settingModel->get_department();
		$data2 = $settingModel->get_company();
		//
		$request = \Config\Services::request();
		$userid=$request->getPost('userid');
		//
		$value=$userModel->get_users($userid)->get()->getRow();
		// 
		$fnames= $value->firstname;
		$lnames=$value->lastname;
		$mails= $value->email;
		$nics= $value->nic;
		$password= $value->password;
		$password=md5($password);
		$mobiles= $value->mobilephone;
		$usernames= $value->username;
		$address= $value->address;
		$designation = $value->designation;
		$department= $value->department_id;
		$status= $value->status;
		$block = $value->block;
		$extension = $value->extension;
		?>
		<input type="hidden" name="userid" value="<?php echo $userid;?>">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Firstname</label>
						<input type="text" class="form-control" name="f_name" id="exampleFormControlInput1" required="" value="<?= $fnames;?>" >
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Lastname</label>
						<input type="text" class="form-control" name="l_name" id="exampleFormControlInput1" required="" value="<?= $lnames;?>">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Email</label>
						<input type="email" class="form-control" name="email" id="exampleFormControlInput1" required="" value="<?= $mails;?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">CNIC</label>
						<input type="text" class="form-control" name="nic" id="exampleFormControlInput1" required="" value="<?= $nics;?>">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Username</label>
						<input type="text" class="form-control" name="username" id="exampleFormControlInput1" required="" value="<?= $usernames;?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Password</label>
						<input type="password" class="form-control" name="password" id="exampleFormControlInput1"  >
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Mobile#</label>
						<input type="text" class="form-control" name="mobile" id="exampleFormControlInput1" required="" value="<?= $mobiles;?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Address</label>
						<input type="text" class="form-control" name="address" id="exampleFormControlInput1" required="" value="<?= $address;?>">
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Designation</label>
									<input type="text" class="form-control" name="designation" id="exampleFormControlInput1" value="<?= $designation;?>">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Department</label>
									<select class="form-control" name="department" id="exampleFormControlInput1" >
										<?php
										foreach($data->get()->getResult() as $item){
										?>
										<option id="department" value="<?= $item->id; ?>"><?= strtolower($item->department); ?></option>

										<?php
										}
										?>
								    </select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Select Company</label>
									<select class="form-control" required="" name="company">
									<?php
										foreach($data2->get()->getResult() as $value){
										?>
										<option id="company" value="<?= $value->id; ?>"><?= strtolower($value->company_name); ?></option>

										<?php
										}
										?>
	
									</select>
								</div>
							</div>
						</div>
					</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">IP Phone Extension</label>
						<input type="text" class="form-control" name="extension" id="exampleFormControlInput1" value="<?= $extension;?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<!-- <div class="form-group"> -->
						<?php 
						if($block == 'yes'){
							$check = 'checked';
						}else{ $check = null; }
						?>
						<label for="exampleFormControlInput1">Block Account</label>
						<div>
							<input type="hidden" name="block" value="no">
							<input type="checkbox" name="block" class="switchBtn" id="switch8" switch="danger" value="yes" <?= $check;?>/>
							<label for="switch8" data-on-label="Yes" data-off-label="No"></label>
						</div>
						<!-- </div> -->
					</div>

				</div>
			</div>
		  <?php

		}
		//
		public function update_user(){

				$error = null;
				$sess_status = session()->get('status');
				if(!isLoggedIn()){
				$error = "Session Timeout";
				}
				if($sess_status != 'admin'){
				$error = "Access Denied";
				}

				$validation =  \Config\Services::validation();

				$validate = $this->validate([

					'f_name' => ['label' => 'firstname', 'rules' => 'required|trim|alpha'],
					'l_name' => ['label' => 'lastname', 'rules' => 'required|alpha'],
					'email' => ['label' => 'email', 'rules' => 'required|trim|valid_email'],
					'nic' => ['label' => 'nic', 'rules' => 'required|trim'],
					'username' => 'trim|required',
					'mobile' => 'trim|required|integer|min_length[11]|max_length[11]',
					'designation' => ['label' => 'designation', 'rules' => 'required|trim'],
					'department' => ['label' => 'department', 'rules' => 'required|trim'],
					'company' => ['label' => 'company', 'rules' => 'required|trim'],
					'address' => 'trim|required'
				]);
				$extension = $this->input->getPost('extension');
				if(!empty($extension)){
					$validate = $this->validate([
						'extension' => 'trim|integer',
					]);
				} 
				if(!$validate){
					$error = $validation->listErrors();
					$error = str_replace(array("\n", "\r"), '', $error);
					$error =  nl2br($error);
				}
		        //
				if(empty($error)){
					$this->db->transStart();
					//
					$userid = $this->input->getPost('userid');
					$fname= $this->input->getPost('f_name');
					$lname= $this->input->getPost('l_name');
					$mail= $this->input->getPost('email');
					$designation= $this->input->getPost('designation');
					$department= $this->input->getPost('department');
					$company= $this->input->getPost('company');
					$nic= $this->input->getPost('nic');
					$access = $this->input->getPost('block');
					$extension = $this->input->getPost('extension');
					// 
					$new_pass= $this->input->getPost('password');
					if(!empty($new_pass)){
						$pass_md5=md5($new_pass);
					}
					// 
					$mobile= $this->input->getPost('mobile');
					$username= $this->input->getPost('username');
					$address= $this->input->getPost('address');

					if(!empty($new_pass)){
						$data= [
							'firstname'=> $fname,
							'lastname'=>$lname,
							'username'=>$username,
							'password'=>$pass_md5,
							'pass_string'=>$new_pass,
							'email'=>$mail,
							'nic'=>$nic,
							'mobilephone'=>$mobile,
							'designation'=>$designation,
							'department_id'=>$department,
							'company_id'=>$company,
							'address'=>$address,
							'block' => $access,
							'extension'=> $extension
						];
					}else{
						$data= [
							'firstname'=> $fname,
							'lastname'=>$lname,
							'username'=>$username,
							'email'=>$mail,
							'nic'=>$nic,
							'mobilephone'=>$mobile,
							'designation'=>$designation,
							'department_id'=>$department,
							'company_id'=>$company,
							'address'=>$address,
							'block' => $access,
							'extension'=> $extension
						];
					}
					$db = \Config\Database::connect();
					//
					$builder = $db->table('users');
					$builder->where('id',$userid);
					$builder->update($data);
					//
					$this->db->transComplete();
					//
					return $this->response->setStatusCode(200)->setBody('Record Updated Successfully');

				}else{
					return $this->response->setStatusCode(500,$error);
				}
			}
	    //
		public function add_user(){
			    $error = null;
				$sess_status = session()->get('status');
				if(!isLoggedIn()){
				$error = "Session Timeout";
				}
				if($sess_status != 'admin'){
				$error = "Access Denied";
				}
				$fname= $this->input->getPost('f_name');
				$lname= $this->input->getPost('l_name');
				$mail= $this->input->getPost('email');
				$nic= $this->input->getPost('nic');
				$password= $this->input->getPost('password');
				$pass=md5($password);
				$mobile= $this->input->getPost('mobile');
				$username= $this->input->getPost('username');
				$address= $this->input->getPost('address');
				$designation= $this->input->getPost('designation');
				$department= $this->input->getPost('department');
				$company= $this->input->getPost('company');
				$status= $this->input->getPost('status');
				$extension= $this->input->getPost('extension');
				//
				$validation = \config\Services::validation();
				//
				$validate = $this->validate([
					'f_name' => ['label' => 'firstname', 'rules' => 'required|trim|alpha'],
					'l_name' => ['label' => 'lastname', 'rules' => 'required|alpha'],
					'email' => ['label' => 'email', 'rules' => 'required|trim'],
					'nic' => ['label' => 'nic', 'rules' => 'required|trim'],
					'password' => 'trim|required|min_length[8]',
					'mobile' => 'trim|required|min_length[11]|max_length[11]',
					'username' => ['label' => 'username', 'rules' => 'required|trim|alpha'],
					'address' => ['label' => 'address', 'rules' => 'required|trim'],
					'status' => ['label' => 'status', 'rules' => 'required|trim'],
					'designation' => ['label' => 'designation', 'rules' => 'required|trim'],
					'department' => ['label' => 'department', 'rules' => 'required|trim'],
					'company' => ['label' => 'company', 'rules' => 'required|trim'],
					'extension' => ['label' => 'extension', 'rules' => 'required|trim'],
				]);

				//
				if(!$validate){
					$error = $validation->listErrors();
					$error = str_replace(array("\n", "\r"), '', $error);
					$error =  nl2br($error);
				}
				//
				$userModel = new Model_Users();
				$userdata = $userModel->get_users(null,$username)->get()->getRow();
				if(!empty($userdata)){
					$error = "Error : Username already exist";
				}
				//
				if(empty($error)){
					$this->db->transStart();
					$data= array(
						'firstname'=> $fname,
						'lastname'=>$lname,
						'username'=>$username,
						'password'=>$pass,
						'pass_string'=>$password,
						'email'=>$mail,
						'nic'=>$nic,
						'mobilephone'=>$mobile,
						'address'=>$address,
						'designation'=>$designation,
						'department_id'=>$department,
						'company_id'=>$company,
						'status'=> $status,
						'extension' => $extension
					);
					//
					$builder = $this->db->table('users');
					$builder->insert($data);
					//
					$insert_id = $this->db->insertID();
					//
					$modelUser = new Model_Users();
					$submenu_list = $modelUser->submenu_list();

					foreach ($submenu_list->get()->getResult() as $key => $value) {
						$data=['id' => $insert_id , 'menu_id' => $value->menu_id, 'sub_menu_id' => $value->id, 'view' => $value->submenu ];
						$builder = $this->db->table('crud_access');
						$builder->insert($data);
					}
					// 
					create_action_log('user id '.$insert_id); 
					//
					$this->db->transComplete();
					return $this->response->setStatusCode(200)->setBody('User Added Successfully');
				}
				else{
			     return $this->response->setStatusCode(500,$error);
			}
		}
		//
		public function delete_user(){

            $error = null;
			$sess_status = session()->get('status');
			$id = $this->input->getPost('id');
            //
			// if($sess_status != 'admin'){
			// 	$error = "Access Denied";
			// }
			if(!isLoggedin()){
				$error = "Session Timeout";
			}
			//
			if(empty($error)){

			 if(!empty($id)){
			//
			$db = \Config\Database::connect();
			//
			$userModel = new Model_Users();
			//
			$this->db->transStart();
			//
			$builder = $db->table('users');
			$builder->where('id',$id);
			$builder->delete();
		    //
			$builder = $db->table('crud_access');
			$builder->where('id',$id);
			$builder->delete();
			//
			create_action_log('user id '.$id);
			//
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('User Deleted Successfully');
			}
		}
		else{
			return $this->response->setStatusCode(500,$error);
	  }	
}
	    //
		public function user_access(){
			//
			$sess_status = session()->get('status');
			if(isLoggedIn() && $sess_status == 'admin' && access_crud('User Access','view')){
				$data['modelUser'] = new Model_Users();
				$query=$data['modelUser']->get_users(null,null,null,['admin','user']);
				$data['data1']=$query;
				//
				$data['data2']=$data['modelUser']->submenu_list();
				//
				return view('cpanel/user_access',$data);
			}else {
				return redirect()->to(base_url('login'));
			}
		}
		//
		public function crud_flip(){
			$request = \Config\Services::request();
			//
			$module = $request->getPost('module');
			$id = $request->getPost('user');
			$oper = $request->getPost('operation');
			// 
			$modelUser = new Model_Users();
			$row = $modelUser->crud_detail($module,$id)->getRow();
			//
			$value=$row->$oper;
			// 
			if($value==1){
				$access=0;
			}else{
				$access=1;
			}
			// 
			$data= [$oper => $access];
			//
			$db = \Config\Database::connect();
			//
			$builder = $db->table('crud_access');
			$builder->where('sub_menu_id',$module);
			$builder->where('id',$id);
			$builder->update($data);
			//
			create_action_log('user id ('.$id .') module id ('.$module.') access id ('.$access.') operation '.$oper);  
		}
		//
		public function user_profile(){
			if(isLoggedIn()){
				$id = session()->get('id');
				$modelUser = new Model_Users();
				$data['info']=$modelUser->get_users($id)->get()->getRow();
				return view('admin/user_profile',$data);
			}else {
				return redirect()->to(base_url('login'));
			}
		}
		//
		public function update_profile(){

			$error = null;
			//
			if(isLoggedIn()){
				$id= $this->input->getPost('id');
				$mobile= $this->input->getPost('mobile');
				$address= $this->input->getPost('address');
				//
				$validation =  \Config\Services::validation();
				//
				$validate = $this->validate([
					'mobile' => 'trim|required|min_length[11]|max_length[11]',
					'address' => 'trim|required',
				]);
				if(!$validate){
					$error = $validation->listErrors();
					$error = str_replace(array("\n", "\r"), '', $error);
					$error =  nl2br($error);
				}
				if(empty($error)){
					$this->db->transStart();
					$this->db->table('users')->where('id',$id)->update(['mobilephone' => $mobile, 'address' => $address]);
					create_action_log('id '.$id);  
					$this->db->transComplete();
					return $this->response->setStatusCode(200)->setBody('Profile Update Successfully');
				}
			}else {
				return $this->response->setStatusCode(500,$error);
			}
		}
		//
		public function change_password(){
			$error = null;
			if(isLoggedIn()){
				$id= $this->input->getPost('id');
				$old= $this->input->getPost('old');
				$new= $this->input->getPost('new');
				$confirm= $this->input->getPost('confirm');
				//
				$validation =  \Config\Services::validation();
				//
				$validate = $this->validate([
					'old' => ['label' => 'Old Password', 'rules' => 'trim|required'],
					'new' => ['label' => 'New Password', 'rules' => 'trim|required|min_length[5]'],
					'confirm' => ['label' => 'Confirm Password', 'rules' => 'trim|required|matches[new]'],
				]);
				if(!$validate){
					$error = $validation->listErrors();
					$error = str_replace(array("\n", "\r"), '', $error);
					$error =  nl2br($error);
				}
				if(empty($error)){
					$modelUser = new Model_Users();
					$oldpass=$modelUser->get_users($id)->get()->getRow()->pass_string;
					if($oldpass != $old){
						$error = 'Error : Invalid Old Password';
					}
				}
				if(empty($error)){
					$this->db->transStart();
					//
					$this->db->table('users')->where('id',$id)->update(['password' => md5($new), 'pass_string' => $new]);
					//
					create_action_log('id '.$id);  
					$this->db->transComplete();
					return $this->response->setStatusCode(200)->setBody('Password Changed Successfuly');
				}else{
					echo $error;
				}
			}else {
				return $this->response->setStatusCode(500,$error);
			}
		}

		public function allow_access($id){	

			$sess_status = session()->get('status');
			$uri = new \CodeIgniter\HTTP\URI(current_url());
			//
			$users = new Model_Users();
			$menu = new Model_Menu();
			$data['userInfo'] = $users->get_users($id)->get()->getRow();
			$data['data2'] = $users->submenu_list();
			
			$data['modelUser'] = new Model_Users();
			$data['id'] = $uri->getSegment(3);
			
			return view('admin/user_allow_access',$data);
		}

		public function user_allow_access(){
			//
			$sess_status = session()->get('status');
			$uri = new \CodeIgniter\HTTP\URI(current_url());
			$data['id'] = $uri->getSegment(3);
			$data['modelUser'] = new Model_Users();
			$userExist = $data['modelUser']->get_users($data['id'])->countAllResults();
			//
			if(isLoggedIn() && $sess_status == 'admin' && access_crud('User Access','view') && $userExist > 0){
				$data['userInfo'] = $data['modelUser']->get_users($data['id'])->get()->getRow();
				//
				$data['data2']=$data['modelUser']->submenu_list();
				//
				return view('cpanel/user_allow_access',$data);
			}else {
				return redirect()->to(base_url('login'));
			}

		}
		//
		public function login_history()
		{
			$sess_status = session()->get('status');
			if(isLoggedIn() && $sess_status == 'admin' && access_crud('Login History','view')){
				return view('admin/login_history');
			}else{
				return redirect()->to(base_url('login'));
			}

		}
		//
		public function login_history_datatable(){
			if(isLoggedIn()){
				$builder = $this->db->table('login_audit')->orderBy('id','DESC');
				//
				return DataTable::of($builder)
				//
				->addNumbering('no')->toJson(true);
			}
	  }

	  public function special_access($id){	

		$sess_status = session()->get('status');
		$uri = new \CodeIgniter\HTTP\URI(current_url());
		//
		$users = new Model_Users();
		$menu = new Model_Menu();
		$data['userInfo'] = $users->get_users($id)->get()->getRow();
		$data['data2'] = $users->submenu_list();
		
		$data['modelUser'] = new Model_Users();
		$data['id'] = $uri->getSegment(3);
		
		return view('admin/user_special_access',$data);
	}
	  

}
