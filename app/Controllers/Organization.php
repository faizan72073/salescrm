<?php

namespace App\Controllers;

use App\Models\Model_Organization;
use App\Models\Model_Tools;
use \Hermawan\DataTables\DataTable;

class Organization extends BaseController
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
		if(isLoggedIn() && access_crud('Organizations','view')){
			$tool = new Model_Tools();
			$data['country'] = $tool->get_country();

			return view('admin/organizationlist', $data);
		}else{
			return redirect()->to(base_url('403'));
		}
	}
	//
	public function get_state()
	{
		$id = $this->input->getPost('id');
		//
		$tool = new Model_Tools();
		$data['state'] = $tool->get_state(null, $id)->get()->getResult();
		//
		return json_encode($data);
	}
	//
	public function get_cities()
	{
		$id = $this->input->getPost('id');
		//
		$tool = new Model_Tools();
		$data['cities'] = $tool->get_cities()->where('state_id', $id)->get()->getResult();
		//
		return json_encode($data);
	}
	//
	public function show_organization()
	{
		$sess_status = session()->get('id');
		if (isLoggedIn() && access_crud('Organizations','view')) {

			$organizationModel = new Model_Organization();
			$ToolModel = new Model_Tools();
			$query = $organizationModel->get_organization();
			//
			$ser = 0;
			foreach ($query->get()->getResult() as $value) {
				$country = $ToolModel->get_country($value->country)->get()->getRow();
				$state = $ToolModel->get_state($value->state)->get()->getRow();
				$city = $ToolModel->get_cities($value->city)->get()->getRow();

				$countryname = $country->name;
				$statename = $state->name;
				$cityname = $city->name;

				$organization = $value->organization;
				$address_1 = $value->address_1;
				$address_2 = $value->address_2;
				$zipcode = $value->zipcode;
				$industry = $value->industry;
				$id = $value->id;
				//
				$ser++;

				?>
				<tr>
					<td><?php echo $ser; ?></td>
					<td><?php echo $organization; ?></td>
					<td><?php echo $address_1; ?></td>
					<td><?php echo $address_2; ?></td>
					<td><?php echo $countryname; ?></td>
					<td><?php echo $statename; ?></td>
					<td><?php echo $cityname; ?></td>
					<td><?php echo $zipcode; ?></td>
					<td><?php echo $industry; ?></td>
					<td>
						<a href="javascript:void(0);" class="mr-3 text-primary UpdOrganizationBtn" data-toggle="tooltip"
							data-placement="top" title="" data-original-title="Edit" data-organizationid="<?php echo $id; ?>"><i
								class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delOrganizationBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Delete" data-organizationid="<?php echo $id; ?>"><i
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
	public function update_organization_from()
	{

		$organizationid = $this->input->getPost('id');
		// 
		$organizationModel = new Model_Organization();
		$value = $organizationModel->get_organization($organizationid)->get()->getRow();
		//
		// dd($data);
		//
		$id = $value->id;
		$organization = $value->organization;
		$address_1 = $value->address_1;
		$address_2 = $value->address_2;
		$country = $value->country;
		$state = $value->state;
		$city = $value->city;
		$zipcode = $value->zipcode;
		$industry = $value->industry;
		//
		$tool = new Model_Tools();
		$data = $tool->get_country()->get()->getResult();
		$data2 = $tool->get_state()->where('country_id', $country)->get()->getResult();
		$data3 = $tool->get_cities()->where('state_id', $state)->get()->getResult();
		?>
		<input type="hidden" name="organizationid" value="<?php echo $id; ?>">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Organization</label>
						<input type="text" class="form-control" name="organization" id="exampleFormControlInput1"
							value="<?php echo $value->organization; ?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Address 1</label>
						<input type="text" class="form-control" name="address_1" id="exampleFormControlInput1"
							value="<?php echo $value->address_1; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Address 2</label>
						<input type="text" class="form-control" name="address_2" id="exampleFormControlInput1"
							value="<?php echo $value->address_2; ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Country</label>
						<select class="form-control" name="country" id="country">
							<?php
							foreach ($data as $item) {
								?>
								<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $value->country) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">State</label>
						<select class="form-control" name="state" id="state">
							<?php
							foreach ($data2 as $item) {
								?>
								<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $value->state) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
								<?php
							}
							?>
						</select>

					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">City</label>
						<select class="form-control" name="city" id="city">
							<?php
							foreach ($data3 as $item) {
								?>
								<option value="<?php echo $item->id; ?>" <?php echo ($item->id == $value->city) ? 'selected' : ''; ?>>
									<?php echo $item->name; ?></option>
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
						<label for="exampleFormControlInput1">Zip Code</label>
						<input type="text" class="form-control" name="zipcode" id="exampleFormControlInput1"
							value="<?php echo $value->zipcode; ?>">
					</div>
				</div>

				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Industry</label>
						<select class="form-control" name="industry" id="exampleFormControlInput1"
							value="<?php echo $value->industry; ?>">
							<option value="textile">textile</option>
							<option value="wool">wool</option>
							<option value="bussiness">bussiness</option>
							<option value="infra">infra</option>
						</select>

					</div>
				</div>
			</div>
		</div>

		<?php

	}
	//
	public function add_organization()
	{
		//
		$error = null;
		$sess_status = session()->get('status');
		$id = session()->get('id');
		$organization = $this->input->getPost('organization');
		$address_1 = $this->input->getPost('address_1');
		$address_2 = $this->input->getPost('address_2');
		$country = $this->input->getPost('country');
		$state = $this->input->getPost('state');
		$city = $this->input->getPost('city');
		$zipcode = $this->input->getPost('zipcode');
		$industry = $this->input->getPost('industry');
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Organizations','create')) {
			$error = "Access Denied";
		}
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'organization' => ['label' => 'organization', 'rules' => 'required|trim'],
			'address_1' => ['label' => 'address 1', 'rules' => 'required|trim'],
			'address_2' => ['label' => 'address 2', 'rules' => 'required|trim'],
			'country' => ['label' => 'country', 'rules' => 'required|trim'],
			'state' => ['label' => 'state', 'rules' => 'required|trim'],
			'city' => ['label' => 'city', 'rules' => 'required|trim'],
			'zipcode' => ['label' => 'zipcode', 'rules' => 'required|trim'],
			'industry' => ['label' => 'industry', 'rules' => 'required|trim'],
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
				'organization' => $organization,
				'address_1' => $address_1,
				'address_2' => $address_2,
				'country' => $country,
				'state' => $state,
				'city' => $city,
				'zipcode' => $zipcode,
				'industry' => $industry
			);
			//
			$builder = $this->db->table('organization');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Organization Id (".$insert_id.")");

			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Organization Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}
	//
	public function delete_organization()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('sess_id');
		$id = $this->input->getPost('id');
		//
		if (!isLoggedin()) {
			$error = "Session Timeout";
		}
		//
		if(!access_crud('Organizations','delete')) {
			$error = "Access Denied";
		}
		//
		if (empty($error)) {

			if (!empty($id)) {
				//
				$db = \Config\Database::connect();
				//
				$this->db->transStart();
				//
				$builder = $db->table('organization');
				$builder->where('id', $id);
				$builder->delete();
				//
				$builder = $db->table('crud_access');
				$builder->where('id', $id);
				$builder->delete();
				//
				create_action_log("Organization Id (".$id.")");
				//
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('Organization Deleted Successfully');
			}
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	//
	public function update_organization()
	{

		$error = null;
		$id = session()->get('id');
		$organizationid = $this->input->getPost('organizationid');
		//
		$sess_status = session()->get('status');
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		//
		// if ($sess_status != 'admin') {
		// 	$error = "Access Denied";
		// }
		//
		if(!access_crud('Organizations','update')) {
			$error = "Access Denied";
		}
		//
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'organization' => ['label' => 'organization', 'rules' => 'required|trim'],
			'address_1' => ['label' => 'address 1', 'rules' => 'required|trim'],
			'address_2' => ['label' => 'address 2', 'rules' => 'required|trim'],
			'country' => ['label' => 'country', 'rules' => 'required|trim'],
			'state' => ['label' => 'state', 'rules' => 'required|trim'],
			'city' => ['label' => 'city', 'rules' => 'required|trim'],
			'zipcode' => ['label' => 'zipcode', 'rules' => 'required|trim'],
			'industry' => ['label' => 'industry', 'rules' => 'required|trim'],

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
			$organization = $this->input->getPost('organization');
			$address_1 = $this->input->getPost('address_1');
			$address_2 = $this->input->getPost('address_2');
			$country = $this->input->getPost('country');
			$state = $this->input->getPost('state');
			$city = $this->input->getPost('city');
			$zipcode = $this->input->getPost('zipcode');
			$industry = $this->input->getPost('industry');
			//
			$data = array(
				'organization' => $organization,
				'address_1' => $address_1,
				'address_2' => $address_2,
				'country' => $country,
				'state' => $state,
				'city' => $city,
				'zipcode' => $zipcode,
				'industry' => $industry
			);
			$builder = $this->db->table('organization');
			$builder->where('id', $organizationid);
			$builder->update($data);

			create_action_log("Organization Id (".$organizationid.")");
			//
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Organization Updated Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}

}