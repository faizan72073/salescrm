<?php

namespace App\Controllers;

use App\Models\Model_Customer;
use App\Models\Model_Package;

class Dashboard extends BaseController
{
	public function __construct()
	{

		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();

	}
	public function index()
	{
		$sess_status = session()->get('status');
		if(isLoggedIn() && access_crud('Dashboard','view')){
			return view('admin/dashboard');
		}else{
			return redirect()->to(base_url('403'));
		}
	}

}