<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";

$route['catalog($)'] = "catalog/all";
$route['catalog/(:any)'] = "catalog/$1";
$route['ajax/(:any)'] = "ajax/index/$1";
$route['product/(:any)'] = "product/index/$1";
$route['reviews/(\d+)'] = "reviews/index/$1";

// $route['catalog/(\w+)\/?(\d+)'] = "catalog/view_category/$1/new/$2";
// $route['catalog/(\w+)\/?(\w+)\/?(\d+)'] = "catalog/view_category/$1/$2/$3";
// $route['catalog/(\w+)\/?(\w+)\/?'] = "catalog/view_category/$1/$2";

// $route['catalog/(\w+)\/?'] = "catalog/view_category/$1";
// $route['catalog/(\w+)\/?(\d+)'] = "catalog/view_category/$1/new/$2";
// $route['catalog/(\w+)\/?(\w+)\/?(\d+)'] = "catalog/view_category/$1/$2/$3";
// $route['catalog/(\w+)\/?(\w+)\/?'] = "catalog/view_category/$1/$2";

$route['register\/?'] = "account/register";
$route['login\/?'] = "account/login";
$route['logout\/?'] = "account/logout";

$route['admin/product/(:any)'] = "admin/products/product/$1";
$route['admin/products/add'] = "admin/products/add";
$route['admin/products/(:any)'] = "admin/products/index/$1";

$route['admin/firm/(:any)'] = "admin/firms/firm/$1";
$route['admin/firms/add'] = "admin/firms/add";
$route['admin/firms/(:any)'] = "admin/firms/index/$1";


$route['admin/logout'] = "admin/login/logout";
$route['admin/admins/add'] = "admin/admins/add";
$route['admin/admins/editinfo/(:any)'] = "admin/admins/editinfo/$1";
$route['admin/admins/editpass/(:any)'] = "admin/admins/editpass/$1";
$route['admin/admins/(:any)'] = "admin/admins/index/$1";

$route['admin/review/(:any)'] = "admin/reviews/review/$1";
$route['admin/reviews/(:any)'] = "admin/reviews/index/$1";

// $route['admin/slide/add'] = "admin/slide/add";
$route['admin/slider/add'] = "admin/slider/add";
$route['admin/slider/ajax'] = "admin/slider/ajax";
$route['admin/slider/edit/(:any)'] = "admin/slider/edit/$1";


$route['admin/orders/edit/(:any)'] = "admin/orders/edit/$1";
$route['admin/orders/(:any)'] = "admin/orders/index/$1";

$route['admin/slider/(:any)'] = "admin/slider/index/$1";
$route['admin/index/denied'] = "admin/index/denied";

$route['search'] = "catalog/search";
$route['search/(:any)'] = "catalog/search/$1";
$route['admin$'] = "admin/index";


//$route['catalog/([a-z]+)(\/?)(\d*)(\/?)([a-z]*)'] = "catalog/view_category/$1/$5/$3";
$route['404_override'] = 'my404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
