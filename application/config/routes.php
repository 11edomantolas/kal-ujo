<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.  
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'auth';
$route['approval'] = 'approval/index';
$route['perusahaan'] = 'perusahaan/index';
$route['perusahaan/edit/(:num)'] = 'perusahaan/edit/$1';
$route['perusahaan/update/(:num)'] = 'perusahaan/update/$1';
$route['approval'] = 'approval/index';
$route['approval/approve/(:num)'] = 'approval/approve/$1';
$route['approval/reject/(:num)'] = 'approval/reject/$1';
$route['approval/print/(:any)'] = 'perusahaan/printItem/$1';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['reset-password/(:any)'] = 'auth/reset_password/$1';
$route['signature'] = 'signature/index';
$route['signature/create'] = 'signature/create';
$route['signature/store'] = 'signature/store';
$route['signature/edit/(:num)'] = 'signature/edit/$1';
$route['signature/update/(:num)'] = 'signature/update/$1';
$route['signature/delete/(:num)'] = 'signature/delete/$1';
$route['get_ujo'] = 'uangjalan/get_ujo';


// Config: routes.php
