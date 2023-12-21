<?php
namespace App\Controllers;

use App\Models\Model_Setting;
use App\Models\Model_Pipeline;
use App\Models\Model_Reason;
use App\Models\Model_Tools;
use App\Models\Model_EmailSMTP;
use CodeIgniter\HTTP\Request;

class Settings extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();
	}
	//--------------------------------------------------------------------
	public function index()
	{
		if (session()->get('status') == 'admin') {
			$modelSetting = new Model_Setting();
			$data['loginOTP'] = $modelSetting->setting('Login OTP')->get()->getRow();
			$data['mMode'] = $modelSetting->setting('Maintenance Mode')->get()->getRow();
			$data['appTitle'] = $modelSetting->setting('App Title')->get()->getRow();
			$data['footerText'] = $modelSetting->setting('Footer Text')->get()->getRow();
			$data['currency'] = $modelSetting->setting('Currency')->get()->getRow();
			//
			$pipelineModel = new Model_Pipeline();
			$data['pipeline'] = $pipelineModel->get_pipeline()->orderBy('p_order');

			$lostreason = new Model_Reason();
			$data['lostreason'] = $lostreason->get_lostReason();

			$EmailSMTP = new Model_EmailSMTP();
			$data['EmailSMTP'] = $EmailSMTP->email_settings()->get()->getRow();

			$tool = new Model_Tools();
			$data['country'] = $tool->get_country();
			$data['state'] = $tool->get_state();
			//
			$data['email_templates'] = $modelSetting->get_email_template()->where('status', 'Active');

			return view('admin/settings', $data);

		} else {
			return redirect()->to(base_url('403'));
		}

		return view('admin/settings');
	}
	//--------------------------------------------------------------------
	public function page_403()
	{
		if (isLoggedIn()) {
			return view('errors/html/error_403');
		}else{
			return redirect()->to(base_url('login'));		
		}
	}
	//
	public function page_404()
	{
		if (isLoggedIn()) {
			return view('errors/html/error_404');
		}else{
			return redirect()->to(base_url('login'));		
		}
	}
	//--------------------------------------------------------------------
	public function page_503()
	{
		//Cheching Maintanance Mode
		$modelSetting = new Model_Setting();
		$checkOTP = $modelSetting->setting('Maintenance Mode')->get()->getRow();

		$myIP = $this->request->getIPAddress();

		if ($checkOTP->value == 'enable' && (strpos($checkOTP->parameter, $myIP) === false)) {
			return view('errors/html/error_503');
		} else {
			return redirect()->to(base_url('login'));
		}

	}
	//--------------------------update------------------------------------------
	public function update()
	{
		$loginOTP = $this->input->getPost('loginOTP');
		$mMode = $this->input->getPost('mMode');
		$mModeIPs = $this->input->getPost('mModeIPs');
		$appTitle = $this->input->getPost('appTitle');
		$footerText = $this->input->getPost('footerText');
		$appLogo = $this->input->getFile('appLogo');
		$backImage = $this->input->getFile('backImage');
		$smLogo = $this->input->getFile('smLogo');
		$currency = $this->input->getPost('currency');
		//
		$error = null;
		if (!isLoggedIn()) {
			$errors = 'Error : Please Login';
		}
		//
		if (empty($error)) {
			$modelSetting = new Model_Setting();
			$modelSetting->settingUpdate('Login OTP', $loginOTP);
			$modelSetting->settingUpdate('Maintenance Mode', $mMode, $mModeIPs);
			$modelSetting->settingUpdate('App Title', null, $appTitle);
			$modelSetting->settingUpdate('Footer Text', null, $footerText);
			$modelSetting->settingUpdate('Currency', null, $currency);
			//
			if (!empty($_FILES['appLogo']['name'])) {
				if (file_exists('./assets/images/logo.png')) {
					unlink('./assets/images/logo.png'); // delete old if exist
				}
				$appLogo->move('./assets/images', 'logo.png');
			}
			//
			if (!empty($_FILES['backImage']['name'])) {
				if (file_exists('./assets/images/bank/loginBackground.jpg')) {
					unlink('./assets/images/bank/loginBackground.jpg'); // delete old if exist
				}
				$backImage->move('./assets/images/bank', 'loginBackground.jpg');
			}
			//
			if (!empty($_FILES['smLogo']['name'])) {
				if (file_exists('./assets/images/logo-sm.png')) {
					unlink('./assets/images/logo-sm.png'); // delete old if exist
				}
				$smLogo->move('./assets/images', 'logo-sm.png');
			}
			//
			return $this->response->setStatusCode(200)->setBody('Changes Update Successfully');
		} else {
			return $this->response->setStatusCode(401, $error);
		}
	}
	//-----------------------------------------Searching----------------------------------------------------
	public function search()
	{
		$error = null;
		$html = null;
		if (!isLoggedIn()) {
			$error = 'Oops!';
		}
		if (empty($error)) {
			$text = $this->input->getPost('text');

			$modelSetting = new Model_Setting();
			$data = $modelSetting->general_search($text);

			foreach ($data->get()->getResult() as $value) {
				$html .= '<a href="' . base_url('/customer/update') . '/' . $value->id . '" class="dropdown-item notify-item active">
			<div class="notify-icon"><i class="fa fa-search"></i></div>
			<p class="notify-details">' . $value->username . '<span class="text-muted">' . $value->firstname . ' ' . $value->lastname . '</span></p>
			</a> ';
			}
			//
			return $html;
		} else {
			$html = '<a href="javascript:void(0);" class="dropdown-item notify-item active">
		<center>No record found</center>
		</a> ';
			return $html;
		}
	}
	//add pipeline code start here
	public function add_pipeline()
	{
		$error = null;
		$sess_status = session()->get('status');
		if ($sess_status != 'admin') {
			$error = 'Access Denied';
		}
		//
		if (!isLoggedIn()) {
			$error = 'Session Timeout';
		}
		//
		$request = \Config\Services::request();
		$db = \Config\Database::connect();
		//
		$pipeline_name = $request->getPost('name');
		$pipeline_name = ucfirst($pipeline_name);
		$pipeline_description = $request->getPost('description');
		//
		$validation = \Config\Services::validation();
		//
		$validate = $this->validate([
			'name' => 'trim|required',
			'description' => 'trim|required',
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$pipelineModel = new Model_Pipeline();
		$pipeline_data = $pipelineModel->get_pipeline(null, $pipeline_name)->get()->getRow();
        //
		if (!empty($pipeline_data)) {
			$error = "Error : Pipeline Already Exist";
		}
		//
		$pipelineModel = new Model_Pipeline();
		$pipelinedata = $pipelineModel->get_pipeline()->orderBy('p_order', 'DESC')->get()->getRow();
		if ($pipelinedata) {
			$pipeline_order = $pipelinedata->p_order + 1;
		} else {
			$pipeline_order = 0;
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'name' => strtoupper($pipeline_name),
				'p_order' => $pipeline_order,
				'description' => $pipeline_description,
			);
			//
			$builder = $db->table('pipeline');
			$builder->insert($data);
			//
			$insert_id = $this->db->insertID();
			//
			create_action_log('Pipeline Id ('.$insert_id.')');
			//
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Pipeline Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}
	//This function is user for Ordering Pipeline Order
	public function pipeline_sorting_action()
	{

		$error = null;
		$sess_status = session()->get('status');
		$id = session()->get('id');
		if ($sess_status != 'admin') {
			$error = 'Access Denied';
		}
		//
		if (!isLoggedIn()) {
			$error = 'Session Timeout';
		}
		//
		if (empty($error)) {
			$pipeline = $this->input->getPost('pipeline');
			if (!empty($pipeline)) {
				if (count($pipeline) > 0) {
					foreach ($pipeline as $key => $value) {
						$this->db->table('pipeline')->where('id', $value)->update(['p_order' => $key]);
					}
				}
			}
			// create_action_log("Pipeline id (".$value.") changed pipeline order");
			// return $this->response->setStatusCode(200)->setBody('Order Changed Successfuly');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	//delete pipeline code start here
	public function delete_Pipeline()
	{
		$error = null;
		$sess_status = session()->get('status');
		$id = session()->get('id');
		if ($sess_status != 'admin') {
			$error = 'Access Denied';
		}
		//
		if (!isLoggedIn()) {
			$error = 'Session Timeout';
		}
		//
		if (empty($error)) {
			//
			$id = $this->input->getPost('id');
			if (!empty($id)) {
				//
				$db = \Config\Database::connect();
				//
				$PipelineModel = new Model_Pipeline();
				//
				$this->db->transStart();
				//
				$builder = $db->table('pipeline');
				$builder->where('id', $id);
				$builder->delete();

				create_action_log("user Id (".$id.")");
				//
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('Pipeline Deleted Successfuly');
			}
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	// this code is used to add or update lost reson if reason exist it update otherwise add new reason
	public function lost_reason()
	{

		$error = null;
		$reason = $this->input->getpost('reason');
		$id = $this->input->getpost('id');
		// dd($id);
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		//
		if (!isLoggedin()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access denied";
		}
		//
		$validation = \config\Services::validation();

		$validate = $this->validate([
			'reason.*' => ['label' => 'Reason', 'rules' => 'required|trim'],

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
			foreach ($reason as $key => $valueReason) {

				if ($id[$key] == 'new') {
					$builder = $this->db->table('lostreason')->insert(['reason' => $reason[$key]]);
				} else {
					$builder = $this->db->table('lostreason')->where('id', $id[$key])->update(['reason' => $reason[$key]]);
				}
			}
			create_action_log("user Id (".$sess_id.") lost reason");
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Reason Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}

	//delete reason code start here

	public function delete_reason()
	{
        $error = null;
		//
		$id = $this->input->getPost('id');
		$sess_id = session()->get('id');
		if (!empty($id)) {
			//
			$db = \Config\Database::connect();
			//
			$reasonModel = new Model_Reason();
			//
			$this->db->transStart();
			//
			$builder = $db->table('lostreason');
			$builder->where('id', $id);
			$builder->delete();

			create_action_log("user Id (".$sess_id.")");
			//
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Reason Deleted Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}


	public function add_product()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$product_name = $this->input->getPost('product_name');
		$product_code = $this->input->getPost('product_code');
		$product_category = $this->input->getPost('product_category');
		$unit = $this->input->getPost('unit');
		$unit_price = $this->input->getPost('unit_price');
		$discount = $this->input->getPost('discount');
		$total_tax = $this->input->getPost('total_tax');
		//
		$product_name = ucfirst($product_name);
		$product_category = ucfirst($product_category);
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'product_name' => ['label' => 'Product name', 'rules' => 'required|trim'],
			'product_code' => ['label' => 'Product code', 'rules' => 'required|trim'],
			'product_category' => ['label' => 'Product category', 'rules' => 'required|trim'],
			'unit' => ['label' => 'unit', 'rules' => 'required|trim'],
			'unit_price' => ['label' => 'Unit price', 'rules' => 'required|trim'],
			'total_tax' => ['label' => 'Total tax', 'rules' => 'required|trim'],
			'discount' => ['label' => 'Discount', 'rules' => 'required|trim'],
		]);

		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$modelSetting = new Model_Setting();
		$product_data = $modelSetting->get_products(null, $product_name)->get()->getRow();

		if (!empty($product_data)) {
			$error = "Error : Product Already Exist";
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'product_name' => $product_name,
				'product_code' => $product_code,
				'category_id' => $product_category,
				'unit' => $unit,
				'unit_price' => $unit_price,
				'total_tax' => $total_tax,
				'discount' => $discount,
			);
			//
			$builder = $this->db->table('products');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Product Id (".$insert_id.")");

			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Product Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}

	public function show_products()
	{
		$sess_status = session()->get('status');
		if (isLoggedIn() && $sess_status == 'admin') {

			$modelSetting = new Model_Setting();
			$query = $modelSetting->get_products();
			//
			$ser = 0;
			foreach ($query->get()->getResult() as $value) {

				$name = $modelSetting->get_categories($value->category_id)->get()->getRow();
				$category_name = $name->category_name;

				$product_name = $value->product_name;
				$product_code = $value->product_code;
				$unit = $value->unit;
				$unit_price = $value->unit_price;
				$discount = $value->discount;
				$total_tax = $value->total_tax;
				$id = $value->id;
				//
				$ser++;
				?>
				<tr>
					<td>
						<?php echo $ser; ?>
					</td>
					<td>
						<?php echo $product_name; ?>
					</td>
					<td>
						<?php echo $product_code; ?>
					</td>
					<td>
						<?php echo $category_name; ?>
					</td>
					<td>
						<?php echo $unit; ?>
					</td>
					<td>
						<?php echo $unit_price; ?>
					</td>
					<td>
						<?php echo $discount; ?>
					</td>
					<td>
						<?php echo $total_tax; ?>
					</td>
					<td>
						<a href="javascript:void(0);" class="mr-3 text-primary updProductBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Edit" data-productid="<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delProductBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Delete" data-productid="<?php echo $id; ?>"><i
								class="fa fa-trash-alt"></i></a>
						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
				 -->
					</td>
				</tr>
			<?php }
		}
	}

	public function delete_product()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$id = $this->input->getPost('id');
		//
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
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
				$builder = $db->table('products');
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
				return $this->response->setStatusCode(200)->setBody('Product Deleted Successfully');
			}
		} else {
			return $this->response->setStatusCode(500, $error);
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
	public function update_Product_from()
	{

		$product_id = $this->input->getPost('id');
		// 
		$modelSetting = new Model_Setting();
		$categories = $modelSetting->get_categories();
		$value = $modelSetting->get_products($product_id)->get()->getRow();
		//
		$id = $value->id;
		$category_id = $value->category_id;
		$product_name = $value->product_name;
		$product_code = $value->product_code;
		$unit = $value->unit;
		$unit_price = $value->unit_price;
		$discount = $value->discount;
		$total_tax = $value->total_tax;
		?>
		<input type="hidden" name="product_id" value="<?php echo $id; ?>">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Product Name</label>
						<input type="text" class="form-control" name="product_name" id="exampleFormControlInput1"
							value="<?= $product_name; ?>">
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Product Code</label>
						<input type="text" class="form-control" name="product_code" id="exampleFormControlInput1" required=""
							value="<?= $product_code; ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Product Category</label>
						<select class="form-control" name="product_category" id="category_name">
							<option>select product category</option>
							<?php
							foreach ($categories->get()->getResult() as $value) {

								?>
								<option value="<?php echo $value->id; ?>" <?php echo ($value->id == $category_id) ? 'selected' : ''; ?>><?php echo $value->category_name; ?></option>
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
				<div class="col-md-3 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Unit</label>
						<input type="number" class="form-control" name="unit" id="exampleFormControlInput1" required=""
							value="<?= $unit; ?>">
					</div>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Unit Price</label>
						<input type="number" class="form-control" name="unit_price" id="exampleFormControlInput1" required=""
							value="<?= $unit_price; ?>">
					</div>
				</div>

				<div class="col-md-3 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Discount</label>
						<input type="number" min="1" class="form-control" name="discount" id="exampleFormControlInput1" required="" value="<?= $discount; ?>">
					</div>
				</div>

				<div class="col-md-3 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Total tax in %</label>
						<input type="number" class="form-control" name="total_tax" id="exampleFormControlInput1" required=""
							value="<?= $total_tax; ?>">
					</div>
				</div>
			</div>
		</div>
		</div>

		<?php

	}

	public function update_products()
	{

		$error = null;
		$product_id = $this->input->getPost('product_id');
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$product_name = $this->input->getPost('product_name');
		$product_code = $this->input->getPost('product_code');
		$product_category = $this->input->getPost('product_category');
		$unit = $this->input->getPost('unit');
		$unit_price = $this->input->getPost('unit_price');
		$total_tax = $this->input->getPost('total_tax');
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'product_name' => ['label' => 'Product name', 'rules' => 'required|trim'],
			'product_code' => ['label' => 'Product code', 'rules' => 'required|trim'],
			'product_category' => ['label' => 'Product category', 'rules' => 'required|trim'],
			'unit' => ['label' => 'unit', 'rules' => 'required|trim'],
			'unit_price' => ['label' => 'Unit price', 'rules' => 'required|trim'],
			'total_tax' => ['label' => 'Total tax', 'rules' => 'required|trim'],
		]);

		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		// $modelSetting = new Model_Setting();
		// $product_data = $modelSetting->get_products(null,$product_name)->get()->getRow();

		// if(!empty($product_data)){
		//     $error = "Error : Product Already Exist";
		// }
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'product_name' => $product_name,
				'product_code' => $product_code,
				'category_id' => $product_category,
				'unit' => $unit,
				'unit_price' => $unit_price,
				'total_tax' => $total_tax,

			);
			//
			$builder = $this->db->table('products')->where('id', $product_id)->update($data);
			create_action_log("product Id (".$product_id.")");

			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Product Update Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}

	public function add_category()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$category_name = $this->input->getPost('category_name');
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([

			'category_name' => ['label' => 'select Category', 'rules' => 'required|trim'],

		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$modelSetting = new Model_Setting();
		$category_data = $modelSetting->get_categories(null, $category_name)->get()->getRow();

		if (!empty($category_data)) {

			$error = "Error : Catagory Already Exist";
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'category_name' => $category_name,
			);
			//
			$builder = $this->db->table('categories');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Category Id (".$insert_id.")");
			$this->db->transComplete();

			return $this->response->setStatusCode(200)->setBody('category Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}

	public function show_categories()
	{
		$sess_status = session()->get('status');
		if (isLoggedIn() && $sess_status == 'admin') {

			$modelSetting = new Model_Setting();
			$query = $modelSetting->get_categories();
			//
			$ser = 0;
			foreach ($query->get()->getResult() as $value) {
				$category_name = $value->category_name;

				$id = $value->id;
				//
				$ser++;
				?>
				<tr>
					<td>
						<?php echo $ser; ?>
					</td>
					<td>
						<?php echo $category_name; ?>
					</td>

					<td>
						<a href="javascript:void(0);" class="mr-3 text-primary updcategoryBtn" data-toggle="tooltip"
							data-placement="top" title="" data-original-title="Edit" data-categoryid="<?php echo $id; ?>"><i
								class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delcategoryBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Delete" data-categoryid="<?php echo $id; ?>"><i
								class="fa fa-trash-alt"></i></a>
						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
				 -->
					</td>
				</tr>
			<?php }
		}
	}



	public function delete_category()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$id = $this->input->getPost('id');
		//
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
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
				$builder = $db->table('categories');
				$builder->where('id', $id);
				$builder->delete();
				//
				$builder = $db->table('crud_access');
				$builder->where('id', $id);
				$builder->delete();
				//
				create_action_log("user id (".$sess_id.")");
				//
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('Category Deleted Successfully');
			}
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	}

	public function update_category_from()
	{

		$category_id = $this->input->getPost('id');
		// 
		$modelSetting = new Model_Setting();
		$value = $modelSetting->get_categories($category_id)->get()->getRow();
		//
		$id = $value->id;
		$category_name = $value->category_name;

		?>
		<input type="hidden" name="category_id" value="<?php echo $id; ?>">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Category Name</label>
						<input type="text" class="form-control" name="category_name" id="exampleFormControlInput1" required=""
							value="<?= $category_name; ?>">
					</div>
				</div>
			</div>
		</div>


		</div>
		<?php
	}
	//
	public function pipeline_update_form()
	{

		$pip_id = $this->input->getPost('id');
		// 
		$modelPipeline = new Model_Pipeline();
		$value = $modelPipeline->get_pipeline($pip_id)->get()->getRow();
		//
		$id = $value->id;
		$pipelinename = $value->name;
		$pipeliedescription = $value->description;

		?>
		<input type="hidden" name="pipieline_id" value="<?php echo $id; ?>">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Pipeline Names</label>
						<input type="text" class="form-control" name="pipeline_name" id="exampleFormControlInput1" required=""
							value="<?= $pipelinename; ?>">
					</div>
				</div>

				<div class="col-md-12 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Pipeline Description</label>
						<input type="text" class="form-control" name="pipieline_description" id="exampleFormControlInput1" required=""
							value="<?= $pipeliedescription; ?>">
					</div>
				</div>
			</div>
		</div>

		</div>
		<?php
	}

	public function update_pipeline()
	{
		$error = null;
		$pip_id = $this->input->getPost('pipieline_id');
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$pipeline_name = $this->input->getPost('pipeline_name');
		$pipeline_description = $this->input->getPost('pipieline_description');
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'pipeline_name' => 'trim|required',
			'pipieline_description' => 'trim|required',
		]);

		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'name' => $pipeline_name,
				'description' => $pipeline_description,
			);
			//
			$builder = $this->db->table('pipeline')->where('id', $pip_id)->update($data);
			create_action_log("Pipeline Id (".$pip_id.")");
			$this->db->transComplete();
			
			return $this->response->setStatusCode(200)->setBody('pipeline Update Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	public function update_category()
	{

		$category_id = $this->input->getPost('category_id');
		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$category_name = $this->input->getPost('category_name');

		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'category_name' => ['label' => 'category name', 'rules' => 'required|trim'],
		]);

		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$modelSetting = new Model_Setting();
		$category_data = $modelSetting->get_categories(null, $category_name)->get()->getRow();

		if (!empty($category_data)) {

			$error = "Error : Catagory Already Exist";
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'category_name' => $category_name,
			);
			//
			$builder = $this->db->table('categories')->where('id', $category_id)->update($data);
			create_action_log("Category Id (".$category_id.")");
			$this->db->transComplete();

			return $this->response->setStatusCode(200)->setBody('Category Update Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}


	}

	public function fetch_categories()
	{

		$modelSetting = new Model_Setting();
		$categories = $modelSetting->get_categories();
		?>
		<select class="form-control required" name="product_category" id="category_name">

			<?php
			foreach ($categories->get()->getResult() as $value) {
				?>
				<option value="<?php echo $value->id; ?>"><?php echo $value->category_name; ?></option>

				<?php
			}
			?>
		</select>

		<?php
	}
	public function fetch_lead_product_categories()
	{

		$modelSetting = new Model_Setting();
		$categories = $modelSetting->get_categories();
		?>
		<select class="form-control required" name="category" id="name">

			<?php
			foreach ($categories->get()->getResult() as $value) {
				?>
				<option value="<?php echo $value->id; ?>"><?php echo $value->category_name; ?></option>

				<?php
			}
			?>
		</select>

		<?php
	}


	public function add_company()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$company_name = $this->input->getPost('company_name');
		$company_name = ucfirst($company_name);
		$country = $this->input->getPost('country');
		$state = $this->input->getPost('state');
		$city = $this->input->getPost('city');
		$description = $this->input->getPost('description');
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'company_name' => ['label' => 'company name', 'rules' => 'required|trim'],
			'country' => ['label' => 'country', 'rules' => 'required|trim'],
			'state' => ['label' => 'state', 'rules' => 'required|trim'],
			'city' => ['label' => 'city', 'rules' => 'required|trim'],
			'description' => ['label' => 'description', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$modelSetting = new Model_Setting();
		$company_data = $modelSetting->get_company(null, $company_name)->get()->getRow();

		if (!empty($company_data)) {
			$error = "Error : company name Already Exist";
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'company_name' => $company_name,
				'country' => $country,
				'state' => $state,
				'city' => $city,
				'description' => $description,
			);
			//
			$builder = $this->db->table('company');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("Company Id (".$insert_id.")");
			$this->db->transComplete();
	
			return $this->response->setStatusCode(200)->setBody('company Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}
	public function update_company_from()
	{

		$companyid = $this->input->getPost('id');
		// 
		$modelSetting = new Model_Setting();
		$value = $modelSetting->get_company($companyid)->get()->getRow();
		//
		// dd($data);
		//
		$id = $value->id;
		$company_name = $value->company_name;
		$country = $value->country;
		$state = $value->state;
		$city = $value->city;
		$description = $value->description;
		//
		$tool = new Model_Tools();
		$data = $tool->get_country()->get()->getResult();
		$data2 = $tool->get_state()->where('country_id', $country)->get()->getResult();
		$data3 = $tool->get_cities()->where('state_id', $state)->get()->getResult();
		?>
		<input type="hidden" name="companyid" value="<?php echo $id; ?>">

		<div class="col-md-12 col-xs-12">
			<div class="form-group">
				<label for="exampleFormControlInput1">Company</label>
					<input class="form-control" name="company_name" id="exampleFormControlInput1" value="<?= $company_name ?>">
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
				<div class="col-md-12 col-xs-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Description</label>
						<input type="text" class="form-control" name="description" id="exampleFormControlInput1"
							value="<?php echo $value->description; ?>">
					</div>
				</div>

			</div>
		</div>
	<?php
	}
//
public function update_company()
{
	$error = null;
	$id = $this->input->getPost('companyid');
	$sess_status = session()->get('status');
	$sess_id = session()->get('id');
	//
	if (!isLoggedIn()) {
		$error = "Session Timeout";
	}
	if ($sess_status != 'admin') {
		$error = "Access Denied";
	}
	//
	$company_name = $this->input->getPost('company_name');
	$country = $this->input->getPost('country');
	$state = $this->input->getPost('state');
	$city = $this->input->getPost('city');
	$description = $this->input->getPost('description');
	//
	$company_name = ucfirst($company_name);
	//
	$validation = \config\Services::validation();
	//
	$validate = $this->validate([
		'company_name' => ['label' => 'company name', 'rules' => 'required|trim'],
		'country' => ['label' => 'country', 'rules' => 'required|trim'],
		'state' => ['label' => 'state', 'rules' => 'required|trim'],
		'city' => ['label' => 'city', 'rules' => 'required|trim'],
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
		$this->db->transStart();
		$data = array(
			'company_name' => $company_name,
			'country' => $country,
			'state' => $state,
			'city' => $city,
			'description' => $description,
		);
		//
		$builder = $this->db->table('company')->where('id',$id);
		$builder->update($data);
		create_action_log("Company Id (".$id.")");
		$this->db->transComplete();
		
		return $this->response->setStatusCode(200)->setBody('Company Updated Successfully');
	} else {
		return $this->response->setStatusCode(500, $error);
	}

}

public function delete_company()
{

	$error = null;
	$sess_status = session()->get('status');
	$id = $this->input->getPost('id');
	$sess_id = session()->get('id');
	//
	// if ($sess_status != 'admin') {
	// 	$error = "Access Denied";
	// }
	if (!isLoggedin()) {
		$error = "Session Timeout";
	}
	//
	// if(!access_crud('company','delete')) {
	// 	$error = "You Don`t Have Access To Delete That";
	// }
	//
	if (empty($error)) {

		if (!empty($id)) {
			//
			$db = \Config\Database::connect();
			//
			$this->db->transStart();
			//
			$builder = $db->table('company');
			$builder->where('id', $id);
			$builder->delete();
			//
			$builder = $db->table('crud_access');
			$builder->where('id', $id);
			$builder->delete();
			//
			create_action_log("Company Id (".$id.")");
			//
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('Company Deleted Successfully');
		}
	} else {
		return $this->response->setStatusCode(500, $error);
	}

}


public function show_company()
	{
		$sess_status = session()->get('id');
	

		    $modelSetting = new Model_Setting();
			$ToolModel = new Model_Tools();
			$query = $modelSetting->get_company();
			//
			$ser = 0;
			foreach ($query->get()->getResult() as $value) {
				$country = $ToolModel->get_country($value->country)->get()->getRow();
				$state = $ToolModel->get_state($value->state)->get()->getRow();
				$city = $ToolModel->get_cities($value->city)->get()->getRow();

				$countryname = $country->name;
				$statename = $state->name;
				$cityname = $city->name;

				$company_name = $value->company_name;
				$description = $value->description;
				$id = $value->id;
				//
				$ser++;

				?>
				<tr>
					<td><?php echo $ser; ?></td>
					<td><?php echo $company_name; ?></td>
					<td><?php echo $countryname; ?></td>
					<td><?php echo $statename; ?></td>
					<td><?php echo $cityname; ?></td>
					<td><?php echo $description; ?></td>
					<td>
						<a href="javascript:void(0);" class="mr-3 text-primary UpdCompanyBtn" data-toggle="tooltip"
							data-placement="top" title="" data-original-title="Edit" data-companyid="<?php echo $id; ?>"><i
								class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delCompanyBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Delete" data-companyid="<?php echo $id; ?>"><i
								class="fa fa-trash-alt"></i></a>
						<!-- <a href="<?php base_url() ?>/user/allow-access/<?php echo $id; ?>" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="allow access"><i class="ri-lock-line"></i></a> -->

						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
					 -->
					</td>
				</tr>
			<?php }
		}



		public function add_department()
		{
	
			$error = null;
			$sess_status = session()->get('status');
			$sess_id = session()->get('id');
			if (!isLoggedIn()) {
				$error = "Session Timeout";
			}
			if ($sess_status != 'admin') {
				$error = "Access Denied";
			}
			$department_name = $this->input->getPost('department_name');
			$department_name = ucfirst($department_name);
			
			//
			$validation = \config\Services::validation();
			//
			$validate = $this->validate([
				'department_name' => ['label' => 'department name', 'rules' => 'required|trim'],

			]);
	
			//
			if (!$validate) {
				$error = $validation->listErrors();
				$error = str_replace(array("\n", "\r"), '', $error);
				$error = nl2br($error);
			}
			//
			$modelSetting = new Model_Setting();
			$department_data = $modelSetting->get_department(null, $department_name)->get()->getRow();
	
			if(!empty($department_data)) {
				$error = "Error : department name Already Exist";
			}
			//
			if (empty($error)) {
				$this->db->transStart();
				$data = array(
					'department' => $department_name,

				);
				//
				$builder = $this->db->table('department');
				$builder->insert($data);
				$insert_id = $this->db->insertID();
				create_action_log("Department Id (".$insert_id.")");
				$this->db->transComplete();
			
				return $this->response->setStatusCode(200)->setBody('Department Added Successfully');
			} else {
				return $this->response->setStatusCode(500, $error);
			}
	
		}
		public function update_department_from()
		{
	
			$departmentid = $this->input->getPost('id');
			// 
			$modelSetting = new Model_Setting();
			$value = $modelSetting->get_department($departmentid)->get()->getRow();
			//
			// dd($data);
			//
			$id = $value->id;
			$department_name = $value->department;
			?>
			<input type="hidden" name="departmentid" value="<?php echo $id; ?>">
	
			<div class="col-md-12 col-xs-12">
				<div class="form-group">
					<label for="exampleFormControlInput1">Department</label>
						<input class="form-control" name="department_name" id="exampleFormControlInput1" value="<?= $department_name ?>">
				</div>
			</div>
			
		<?php
		}
	//
	public function update_department()
	{
		$error = null;
		$id = $this->input->getPost('departmentid');
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$department_name = $this->input->getPost('department_name');
		$department_name = ucfirst($department_name);
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
			'department_name' => ['label' => 'department name', 'rules' => 'required|trim'],

		]);
	
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		// $modelSetting = new Model_Setting();
		// $department_data = $modelSetting->get_department(null, $department_name)->get()->getRow();

		// if(!empty($department_data)) {
		// 	$error = "Error : department name Already Exist";
		// }
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'department' => $department_name,
			);
			//
			$builder = $this->db->table('department')->where('id',$id);
			$builder->update($data);
			create_action_log("Department Id (".$id.")");
			$this->db->transComplete();
		
			return $this->response->setStatusCode(200)->setBody('department updated Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	
	}
	
	public function delete_department()
	{
	
		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$id = $this->input->getPost('id');
		//
		// if ($sess_status != 'admin') {
		// 	$error = "Access Denied";
		// }
		if (!isLoggedin()) {
			$error = "Session Timeout";
		}
		//
		// if(!access_crud('company','delete')) {
		// 	$error = "You Don`t Have Access To Delete That";
		// }
		//
		if (empty($error)) {
	
			if (!empty($id)) {
				//
				$db = \Config\Database::connect();
				//
				$this->db->transStart();
				//
				$builder = $db->table('department');
				$builder->where('id', $id);
				$builder->delete();
				//
				$builder = $db->table('crud_access');
				$builder->where('id', $id);
				$builder->delete();
				//
				create_action_log("Department Id (".$id.")");
				//
				$this->db->transComplete();
				return $this->response->setStatusCode(200)->setBody('Department Deleted Successfully');
			}
		} else {
			return $this->response->setStatusCode(500, $error);
		}
	
	}
	
	
	public function show_department()
		{
			$sess_status = session()->get('id');
	
				$modelSetting = new Model_Setting();
				$query = $modelSetting->get_department();
				//
				$ser = 0;
				foreach ($query->get()->getResult() as $value) {

	
					$department_name = $value->department;
					$id = $value->id;
					//
					$ser++;
	
					?>
					<tr>
						<td><?php echo $ser; ?></td>
						<td><?php echo $department_name; ?></td>

						<td>
							<a href="javascript:void(0);" class="mr-3 text-primary UpddepartmentBtn" data-toggle="tooltip"
								data-placement="top" title="" data-original-title="Edit" data-departmentid="<?php echo $id; ?>"><i
									class="fa fa-edit"></i></a>
							<a href="javascript:void(0);" class="text-danger deldepartmentBtn" data-toggle="tooltip" data-placement="top"
								title="" data-original-title="Delete" data-departmentid="<?php echo $id; ?>"><i
									class="fa fa-trash-alt"></i></a>
							<!-- <a href="<?php base_url() ?>/user/allow-access/<?php echo $id; ?>" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="allow access"><i class="ri-lock-line"></i></a> -->
	
							<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
						 -->
						</td>
					</tr>
				<?php }
			}


	public function add_country(){

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$country = $this->input->getPost('country');
		$country = ucfirst($country);
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
			'country' => ['label' => 'country', 'rules' => 'required|trim'],

		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$ToolModel = new Model_Tools();
		$country_data = $ToolModel->get_country(null,$country)->get()->getRow();
        //
		if(!empty($country_data)) {
			$error = "Error : Country Already Exist";
		}
		//
		if(empty($error)){
			$this->db->transStart();
			$data = array(
				'name' => $country,
			);
			//
			$builder = $this->db->table('country');
			$builder->insert($data);
			// dd($builder);
			$insert_id = $this->db->insertID();
			create_action_log("Country Id (".$insert_id.")");
			$this->db->transComplete();
		
			return $this->response->setStatusCode(200)->setBody('Country Added Successfully');
		} 
		else {
			return $this->response->setStatusCode(500, $error);
		}

	}	
	
	public function add_state(){

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$country = $this->input->getPost('country');
		$state = $this->input->getPost('state');
		$state = ucfirst($state);
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		//
		
		// dd($country);
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'country' => ['label' => 'country', 'rules' => 'required|trim'],
			'state' => ['label' => 'state', 'rules' => 'required|trim'],

		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$ToolModel = new Model_Tools();
		$state_data = $ToolModel->get_state(null,null,$state)->get()->getRow();
        //
		if (!empty($state_data)) {
			$error = "Error : State Already Exist";
		}
		//
		if(empty($error)){
			$this->db->transStart();
			$data = array(
				'country_id' => $country,
				'name' => $state,
			);
			//
			$builder = $this->db->table('state');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("State Id (".$insert_id.")");
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('State Added Successfully');
		} 
		else {
			return $this->response->setStatusCode(500, $error);
		}

	}	

	public function add_city(){

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		$state = $this->input->getPost('state');
		$city = $this->input->getPost('city');
		$city = ucfirst($city);
		//
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		//
		// dd($country);
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'state' => ['label' => 'state', 'rules' => 'required|trim'],
			'city' => ['label' => 'city', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$ToolModel = new Model_Tools();
		$city_data = $ToolModel->get_cities(null,null,$city)->get()->getRow();
        //
		if (!empty($city_data)) {
			$error = "Error : City Already Exist";
		}
		//
		if(empty($error)){
			$this->db->transStart();
			$data = array(
				
				'state_id' => $state,
				'name' => $city,
			);
			//
			$builder = $this->db->table('city');
			$builder->insert($data);
			$insert_id = $this->db->insertID();
			create_action_log("City Id (".$insert_id.")");
			$this->db->transComplete();
			return $this->response->setStatusCode(200)->setBody('City Added Successfully');
		} 
		else {
			return $this->response->setStatusCode(500, $error);
		}

	}	

	public function add_email_template()
	{

		$error = null;
		$sess_status = session()->get('status');
		$sess_id = session()->get('id');
		if (!isLoggedIn()) {
			$error = "Session Timeout";
		}
		if ($sess_status != 'admin') {
			$error = "Access Denied";
		}
		$template = $this->input->getPost('template');
		$template_name = $this->input->getPost('template_name');
		$template_status = $this->input->getPost('template_status');
		$template_subject = $this->input->getPost('template_subject');
		$template_description = $this->input->getPost('template_description');
		
		//
		$validation = \config\Services::validation();
		//
		$validate = $this->validate([
			'template' => ['label' => 'template', 'rules' => 'required|trim'],
			'template_name' => ['label' => 'template_name', 'rules' => 'required|trim'],
			'template_status' => ['label' => 'template_status', 'rules' => 'required|trim'],
			'template_subject' => ['label' => 'template_subject', 'rules' => 'required|trim'],
			'template_description' => ['label' => 'description', 'rules' => 'required|trim'],
		]);

		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		$modelSetting = new Model_Setting();
		$template_data = $modelSetting->get_email_template(null, $template_name)->get()->getRow();

		if (!empty($template_data)) {
			$error = "Error : Template name Already Exist";
		}
		//
		if (empty($error)) {
			$this->db->transStart();
			$data = array(
				'template' => $template,
				'template_name' => $template_name,
				'status' => $template_status,
				'subject' => $template_subject,
				'description' => $template_description,
			);
			//
			$builder = $this->db->table('email_template');
			$builder->insert($data);

			$this->db->transComplete();
			create_action_log("user Id (".$sess_id.")");
			return $this->response->setStatusCode(200)->setBody('Template Added Successfully');
		} else {
			return $this->response->setStatusCode(500, $error);
		}

	}

	public function get_template_detail(){

		$id = $this->input->getPost('id');
        //
		$modelSetting = new Model_Setting();
		$data = $modelSetting->get_email_template()->where('id',$id)->get()->getRow();

		return json_encode($data);
	}



	public function show_country_state_city()
	{
		    $sess_status = session()->get('id');
			//
		    $modelSetting = new Model_Setting();
			$ToolModel = new Model_Tools();
			//
			// $query = $modelSetting->get_cities();
			$query = $ToolModel->get_country_state_city();

			// dd($query);
			//
			$ser = 0;
			foreach ($query as $value) {

				$countryname = $value->name;
				$state_name = $value->state_name;
				$city_name = $value->city_name;
				$id = $value->id;
				//
				$ser++;

				?>
				<tr>
					<td><?php echo $ser; ?></td>
					<td><?php echo $countryname; ?></td>
					<td><?php echo $state_name; ?></td>
					<td><?php echo $city_name; ?></td>
					<!-- <td> -->
						<!-- <a href="javascript:void(0);" class="mr-3 text-primary UpdCompanyBtn" data-toggle="tooltip"
							data-placement="top" title="" data-original-title="Edit" data-companyid="<?php echo $id; ?>"><i
								class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="text-danger delCompanyBtn" data-toggle="tooltip" data-placement="top"
							title="" data-original-title="Delete" data-companyid="<?php echo $id; ?>"><i
								class="fa fa-trash-alt"></i></a> -->
						<!-- <a href="<?php base_url() ?>/user/allow-access/<?php echo $id; ?>" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="allow access"><i class="ri-lock-line"></i></a> -->

						<!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="10" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
					 -->
					<!-- </td> -->
				</tr>
			<?php }
		}
		public function update_smtp_setting(){

			$error = null;
			$sess_status = session()->get('status');
			$sess_id = session()->get('id');
			if (!isLoggedIn()) {
				$error = "Session Timeout";
			}
			if ($sess_status != 'admin') {
				$error = "Access Denied";
			}
			$smtpid = $this->input->getPost('smtpid');
			$email = $this->input->getPost('email');
			$password = $this->input->getPost('password');
			$sent_title = $this->input->getPost('sent_title');
			$host = $this->input->getPost('host');
			$port = $this->input->getPost('port');
			$sent_email = $this->input->getPost('sent_email');
			$reply_email = $this->input->getPost('reply_email');
			
			//
			$validation = \config\Services::validation();
			//
			$validate = $this->validate([
				'email' => ['label' => 'email', 'rules' => 'required|trim'],
				'password' => ['label' => 'password', 'rules' => 'required|trim'],
				'sent_title' => ['label' => 'sent_title', 'rules' => 'required|trim'],
				'host' => ['label' => 'host', 'rules' => 'required|trim'],
				'port' => ['label' => 'port', 'rules' => 'required|trim'],
				'sent_email' => ['label' => 'sent email', 'rules' => 'required|trim'],
				'reply_email' => ['label' => 'reply email', 'rules' => 'required|trim'],
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
					'email' => $email,
					'password' => $password,
					'sent_title' => $sent_title,
					'host' => $host,
					'port' => $port,
					'sent_email' => $sent_email,
					'reply_email' => $reply_email,
				);
				//
				$builder = $this->db->table('email_settings');
				$builder->update($data);
	
				$this->db->transComplete();
				create_action_log("SMTP Id (".$smtpid.")");
				return $this->response->setStatusCode(200)->setBody('SMTP Settings Changed Successfully');
			}
		}	

}