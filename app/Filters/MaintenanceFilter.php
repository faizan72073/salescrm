<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Model_Setting;
use CodeIgniter\HTTP\Request;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        ///// Cheching Maintanance Mode
        $modelSetting = new Model_Setting();
        $checkOTP = $modelSetting->setting('Maintenance Mode')->get()->getRow();
        //
        $myIP = $request->getIPAddress();
        //
        if ($checkOTP->value == 'enable' && (strpos($checkOTP->parameter, $myIP) === false )  ) {
            return redirect()->to(base_url('503'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}








?>