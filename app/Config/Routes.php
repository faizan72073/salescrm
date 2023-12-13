<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/503', 'Settings::page_503');
$routes->get('/forget', 'Login::forget');
$routes->get('/otp', 'Login::otp');
$routes->get('/change_password', 'Login::change_password');
$routes->get('/pdf/(:num)', 'Tools::pdf/$1');
//
$routes->group('/', ['filter' => 'MaintenanceFilter'], static function ($routes) {

$routes->get('/login', 'Login::index');
$routes->get('/login/verify-otp', 'Login::otp_verification');

$routes->get('/user-data', 'User::sales_user_data');

});
//
$routes->group('/', ['filter' => 'AuthFilter'], static function ($routes) {

    //user allow access
    $routes->get('/user/allow-access/(:num)', 'User::allow_access/$1');
    $routes->get('/user/special-access/(:num)', 'User::special_access/$1');
    // $routes->get('/user/special-access-pipeline/(:num)', 'User::special_access/$1');
    // $routes->get('/user/allow-access/{id}', 'User::user_allow_access');
    //
    $routes->get('/', 'Dashboard::index');
    $routes->get('', 'Dashboard::index');
    $routes->get('/search', 'Search::search');
    $routes->get('/settings', 'Settings::index');
    $routes->get('/cpanel', 'Dashboard::index');
    $routes->get('/dashboard', 'Dashboard::index');

    // Reminder
    $routes->get('/tools/notification', 'Tools::notification');

    $routes->get('/tools/all_reminders', 'Tools::all_reminders');

    // Contacts
    $routes->get('/contacts/contacts-list', 'Contacts::index');


    // Organization
    $routes->get('/organization/organization-list', 'Organization::index');

    //deal
    // $routes->get('/deal', 'Deal::index');

    //Lead
    $routes->get('/lead', 'Lead::index');

    //Lead
    $routes->get('/cofc', 'Lead::lead_cofc_stage');

    //this route is used temporary user delete it after work done
    $routes->get('/lead/edit/(:num)', 'Lead::edit_leads/$1');

    //pipeline
    $routes->get('/pipeline', 'Pipeline::index');

    //pipeline2
    $routes->get('/pipeline2', 'Pipeline::pipeline');

    //
    //login History
    $routes->get('/user/login-history', 'User::login_history');
    //
    $routes->get('/403', 'Settings::page_403');
    //
    $routes->get('/dashboard-menu-management', 'Dashboard_menu::index');

    // user
    $routes->get('/user/user-list', 'User::index');
    $routes->get('/user/user-access-control', 'User::user_access');
    $routes->get('/user/user-profile', 'User::user_profile');
    //
    $routes->get('/customer/customer-list', 'Customer::customer_list');
    $routes->get('/customer/create', 'Customer::create');
    $routes->get('/customer/online', 'Customer::online_users');
    $routes->get('/customer/offline', 'Customer::offline_users');
    $routes->get('/customer/profile', 'Customer::profile');
    $routes->get('/customer/package-upgrade-request', 'Customer::customer_package_upgrade_request');
    //
    $routes->get('/taxation', 'Taxation::index');
    $routes->get('/taxation/create', 'Taxation::create');
    $routes->get('/taxation/update', 'Taxation::update');
    $routes->get('/taxation/delete', 'Taxation::delete');
    //
    // $routes->get('/package', 'Package::index');
    // $routes->get('/package/create', 'Package::create');
    // $routes->get('/package/update', 'Package::update');
    $routes->get('/package/internet', 'Package::internet_pkg_list');
    $routes->get('/package/tv', 'Package::tv_pkg_list');
    $routes->get('/package/phone', 'Package::phone_pkg_list');
    $routes->get('/package-internet/create', 'Package::create_int_pkg');
    $routes->get('/package-phone/create', 'Package::create_phone_pkg');
    $routes->get('/package-tv/create', 'Package::create_tv_pkg');
    //
    $routes->get('/project/city', 'Project::city');
    $routes->get('/project/area', 'Project::area');
    $routes->get('/project/project', 'Project::project');
    //
    $routes->get('/network/olt', 'Network::olt');
    //
    $routes->get('/field/ndt', 'Field::ndt');
    $routes->get('/field/adt', 'Field::adt');
    //
    $routes->get('/elastix/get_active_calls', 'Elastix::get_active_calls');

    // Site 
    $routes->get('/site-home/slider', 'Site_Home::slider');
    $routes->get('/site-home/payment', 'Site_Home::payment');
    $routes->get('/site-home/contact', 'Site_Home::contact');
    $routes->get('/site-home/query_form', 'Site_Home::query_form');

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}