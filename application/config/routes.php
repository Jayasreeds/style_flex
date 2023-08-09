<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

/**** Before Login ******/
$route['default_controller']		 	= 'login';
$route['forgot'] 					 	= 'login/forgot';

$route['404_override']				 	= '';
$route['translate_uri_dashes'] 			= FALSE;
$route['addbranch'] 					= 'branch/addbranch';
$route['addtype']	 					= 'size/addtype';
$route['viewprofile']	 				= 'profile/viewprofile';
$route['changepass']	 				= 'profile/changepass';
$route['addbilling']	 				= 'stock/addmodel';
$route['editbilling/(:any)']	 		= 'billing/editbilling/$1';
$route['editcustomer/(:any)']			= 'customers/editcustomer/$1';
$route['viewbill/(:any)']				= 'billing/viewbill/$1';
$route['addcustomer']			        = 'customers/addcustomer';
$route['addcategory']			        = 'category/addcategory';
$route['addsubcategory']			    = 'category/addsubcategory';
$route['editcategory/(:any)']		    = 'category/editcategory/$1';
$route['editmodel/(:any)']			    = 'model_name/editmodel/$1';

$route['addmodel']			            = 'Model_name/addmodel';
$route['addquotation']	 				= 'quotation/addquotation';
$route['editquotation/(:any)']	 		= 'quotation/editquotation/$1';
$route['viewquotation/(:any)']			= 'quotation/viewquotation/$1';
$route['billing_reports']	 			= 'reports/invoice';
$route['quotation_reports']	 			= 'reports/quotation';
$route['sendmailForm/(:any)']	 		= 'billing/sendmailForm/$1';
$route['viewtransaction/(:any)']		= 'billing/viewtransaction/$1';
$route['success-flash'] 				= 'MyFlashController/success';
$route['error-flash'] 					= 'MyFlashController/error';
$route['warning-flash'] 				= 'MyFlashController/warning';
$route['info-flash'] 					= 'MyFlashController/info';
$route['editbranch/(:any)']				= 'branch/editbranch/$1';
