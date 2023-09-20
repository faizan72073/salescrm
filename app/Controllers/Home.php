<?php

namespace App\Controllers;
// use App\Models\Model_Package;
// use App\Models\Model_Radius;
// use App\Models\Model_Customer;
// use App\Models\Model_Elastix;

class Home extends BaseController
{
	public function index()
	{
		return view('admin/index');
    }
	
}
