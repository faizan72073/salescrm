<?php

namespace App\Controllers;

use App\Models\Model_Customer;
use App\Models\Model_Package;
use App\Models\Model_Leads;

class Search extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->input = \Config\Services::request();
	}

	public function search(){

		$searchQuery = $this->request->getGet('search');
		$getsearchdata = new Model_Leads();
		$searchdata = $getsearchdata->get_Leads()->like('deal_title', "%$searchQuery%")->get()->getResult();
		if(!empty($searchdata)){
			dd($searchdata);
		}
		else{
			echo "No Data found";			
		}

	}	

}