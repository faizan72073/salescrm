<?php
namespace App\Controllers;

use App\Models\Model_Users;
use App\Models\Model_SMSnEmail;
use App\Models\Model_Customer;
use App\Models\Model_Setting;

//
class Login extends BaseController
{
	//
	public function index()
	{
		if (!isLoggedIn()) {
			return view('auth/login');
		} else {
			return redirect()->to(base_url('dashboard'));
		}
	}
	//
	public function forget()
	{
		return view('admin/forget');
	}

	//
	public function loginCheck()
	{
		//
		$request = \Config\Services::request();
		$validation = \Config\Services::validation();
		//
		$username = $request->getPost('username');
		$password = $request->getPost('password');
		$error = NULL;
		//
		$validate = $this->validate([
			'username' => ['label' => 'Username', 'rules' => 'required|trim'],
			'password' => ['label' => 'Password', 'rules' => 'required|trim'],
		]);
		//
		if (!$validate) {
			$error = $validation->listErrors();
			$error = str_replace(array("\n", "\r"), '', $error);
			$error = nl2br($error);
		}
		//
		if ($validate) {
			$modelUsers = new Model_Users();
			$userData = $modelUsers->get_users(null, null, $username)->get()->getRow();
			//
			if (empty($userData)) {
				$error = 'Error : No record found';
			} else if ($userData->block == 'yes') {
				$error = 'Error : Account has been blocked';
			} else if (md5($password) != $userData->password) {
				$error = 'Error : Invalid Credentials ';
			}
			//
			if ($error == NULL) {
				$modelSetting = new Model_Setting();
				$checkOTP = $modelSetting->setting('Login OTP')->get()->getRow()->value;
				$appTitle = $modelSetting->setting('App Title')->get()->getRow()->parameter;
				//
				if ($checkOTP == 'enable') {
					//
					$digits = 4;
					$code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
					// send code email
					$msg = '<div class="container">
					<div class="col-lg-12" style="border-radius: 10px; background-color: #f5f5f5; padding: 15px;font-family: sans-serif;">
					<p>
					<h2>Verify your login</h2>
					</p>
					<hr>
					<p style="color: #000">
					<div border="1px" width="60%">
					Below is your ERP one time passcode
					<br> <h2>' . $code . '</h2>
					</div>
					</div>
					</div>';
					//
					$emailnmsg = new Model_SMSnEmail();
					$emailnmsg->sendEmail($userData->email, $msg, null, 'OTP');
					//
					session()->set('id', $userData->id);
					session()->set('username', $userData->username);
					session()->set('fname', $userData->firstname);
					session()->set('lname', $userData->lastname);
					session()->set('email', $userData->email);
					session()->set('OTP', $code);
					session()->set('appTitle', $appTitle);
					if ($userData->status != 'customer') {
						session()->set('extension', $userData->extension);
					}
					//
					return $this->response->setStatusCode(200)->setBody('OTP');
				} else {
					session()->set('id', $userData->id);
					session()->set('username', $userData->username);
					session()->set('status', $userData->status);
					session()->set('fname', $userData->firstname);
					session()->set('lname', $userData->lastname);
					session()->set('email', $userData->email);
					session()->set('appTitle', $appTitle);
					if ($userData->status != 'customer') {
						session()->set('extension', $userData->extension);
					}
					//
					$this->login_audit($userData->email);
					if ($userData->status == 'admin') {
						return $this->response->setStatusCode(200)->setBody('Admin Login Successfully');
					}
					return $this->response->setStatusCode(200)->setBody('User Login Successfully');
				}

			} else {
				return $this->response->setStatusCode(401, $error);
			}
		} else {
			return $this->response->setStatusCode(404, $error);
		}
		// 				
	}
	//
	public function logout()
	{
		// update logout time
		$date = date('Y-m-d H:i:s');
		$sessionid = session_id();

		$db = \Config\Database::connect();
		$builder = $db->table('login_audit');
		$builder->set('logout_time', $date);
		$builder->where('session_id', $sessionid);
		$builder->update();
		// //
		session()->destroy();
		return redirect()->to(base_url('login'));
		//
	}
	//
	public function forgot_password()
	{
		$request = \Config\Services::request();
		$db = \Config\Database::connect();
		//
		$email = $request->getPost('fp_email');
		//
		$builder = $db->table('bo_users');
		$builder->select('mobilephone,pass_string');
		$builder->where('email', $email);
		$query = $builder->get()->getRow();

		if ($query) {
			$mobile = $query->mobilephone;
			$pass = $query->pass_string;
			//
			echo '<p style="color:green;">Your password has been sent to your email </p>';
			//
			$msg = 'You have requested for your LBI INVENTORY password retrieval . Your password is' . $pass;

			$emailnmsg = new Model_SMSnEmail();
			$emailnmsg->sendEmail($email, $msg);
			// 
		} else {
			echo '<p style="color:red;">Invalid email or no such email exist</p>';
		}
	}
	//
	public function generate_otp()
	{
		$permitted_chars = '123456789';
		$data['otp'] = substr(str_shuffle($permitted_chars), 0, 4);
		session()->set('otp', $data['otp']);
		// send OTP using email and SMS
		$modelUsers = new Model_Users();
		$email = $modelUsers->get_users(null, null, session()->get('email'))->get()->getRow()->email;
		// $msg = 'Your verification OTP Code is '.$data['otp'];
		$html = '';
		$html .= 'Below is your OTP (One Time Passcode)';
		$html .= '<h2 style="font-weight: bold;">' . $data['otp'] . '</h2>';
		$emailnmsg = new Model_SMSnEmail();
		// $emailnmsg->sendEmail($email,'OTP Verification',$html);
		return redirect()->to(base_url('login/verify-otp'));
	}
	//
	public function otp_verification()
	{

		if (empty(session()->get('OTP'))) {
			return redirect()->to(base_url('login'));
		} else if (isLoggedIn()) {
			return redirect()->to(base_url('dashboard'));
		} else {
			return view('cpanel/otp_verification');
		}
	}
	//
	public function opt_confirmation()
	{
		if (!empty(session()->get('username')) && !empty(session()->get('OTP'))) {
			$request = \Config\Services::request();
			$validation = \Config\Services::validation();
			//
			$sess_otp = session()->get('otp');
			$user_otp = $request->getPost('otp');
			$error = null;
			//
			$validate = $this->validate([
				'otp' => ['label' => 'OTP', 'rules' => 'required|trim'],
			]);

			if (!$validate) {
				$error = $validation->listErrors();
			}
			if (empty($error)) {
				if ($sess_otp == $user_otp) {
					//
					$modelUsers = new Model_Users();
					$userData = $modelUsers->get_users(null, null, session()->get('email'))->get()->getRow();
					session()->set('status', $userData->status);
					//
					session()->set('login', 1);
					$this->login_audit(session()->get('username'));
					//
					return 'success';

				} else {
					return $error = 'Error : Invalid OTP';
				}
			} else {
				return $error;
			}
		} else {
			return redirect()->to(base_url('login'));
		}
	}
	//
	public function activation()
	{
		if (!empty(session()->get('username')) && (session()->get('status')) == 'customer') {
			$modelCustomer = new Model_Customer();
			$userData = $modelCustomer->get_customer(null, session()->get('username'))->get()->getRow();
			if ($userData->active == 'no') {
				$this->send_activation_link($userData->firstname . ' ' . $userData->lastname, $userData->username, $userData->email);
				$data['flag'] = 'no';
				return view('cpanel/login_activation', $data);
			} else {
				session()->set('login', 1);
				$this->login_audit(session()->get('username'));
				return redirect()->to(base_url('login'));
			}
		} else {
			return redirect()->to(base_url('login'));
		}
	}
	//
	public function activate_account()
	{
		$uri = new \CodeIgniter\HTTP\URI(current_url());
		$email = $uri->getSegment(3);
		$email = mb_substr(base64_decode($email), 0, 100, 'utf-8');
		//
		$username = $uri->getSegment(4);
		$username = mb_substr(base64_decode($username), 0, 100, 'utf-8');
		//
		$customer = new Model_Customer();
		$exist = $customer->get_customer(null, $username, null, $email)->get()->getRow();
		//
		if (empty($exist->id) || $exist->active == 'yes') {
			return view('errors/html/error_404');
		} else {
			$db = \Config\Database::connect();
			$db->table('bo_customer')->where('username', $username)->update(['active' => 'yes']);
			$data['flag'] = 'yes';
			return view('cpanel/login_activation', $data);
		}
	}
	//
	public function send_activation_link($name, $username, $email)
	{
		if (empty($email)) {
			echo 'Error Some thing wrong';
		} else {
			$specChar = array('=', '@', '/');
			$token = str_replace($specChar, '', base64_encode($email));
			$user = str_replace($specChar, '', base64_encode($username));
			//
			$url = "http://103.121.121.25:106/login/activate_account/" . $token . "/" . $user;
			$html = '';
			$html .= '<div style="width:90%;margin:auto;padding: 20px;background-color: #efefef;border-radius:5px;">';
			$html .= 'Dear ' . $name . ',';
			$html .= '<h1 style="text-align:center;font-weight: bold;">Just one more step ...</h1>';
			$html .= '<h2 style="width:100%;text-align:center;font-weight:bold;">username : ' . $username . ' </h2>';
			$html .= '<p style="text-align:center;font-size:16px;"> Click the button below to activate your BlackOptics account</p>';
			$html .= '<div style="position:relative;height:50px"><center><a href="' . $url . '" target="_blank" style="padding: 16px;text-align:center;font-weight:bold;position:absolute; left:50%;transform:translateX(-50%);background: #000;color: #fff;text-decoration: none;font-family: sans-serif;border: 1px solid #000;border-radius: 5px;"> Activate Account </a></center></div>';
			$html .= '</div>';
			//
			$emailnmsg = new Model_SMSnEmail();
			// $emailnmsg->sendEmail($email,'ACCOUNT ACTIVATION',$html);
			return;
		}
		//
	}
	///////////////////////////////////////////////////////////////////////////
	public function login_audit($username)
	{
		$request = \Config\Services::request();
		$ip = $request->getIPAddress();
		$date = date('Y-m-d H:i:s');
		$sessionid = session_id();
		//
		$agent = $this->request->getUserAgent();
		$platform = $agent->getPlatform();
		$browser = $agent->getBrowser();
		//
		$db = \Config\Database::connect();
		$data = array('`username' => $username, 'session_id' => $sessionid, 'login_time' => $date, 'ip' => $ip, 'platform' => $platform, 'browser' => $browser);
		$builder = $db->table('login_audit');
		$builder->insert($data);
	}
	///////////////////////////////////////////////////////////////////////////
	public function test()
	{
		$html = '';
		$html .= 'Below is your OTP (One Time Passcode)';
		$html .= '<h2 style="font-weight: bold;">5644</h2>';

		var_dump($html);
	}
// controller end

}