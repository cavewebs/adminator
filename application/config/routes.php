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
|$route['default_controller'] = 'welcome';
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
$route['default_controller'] = 'site/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'site/login';
$route['logout'] = 'site/logout';
$route['users/add_to_group/(:any)'] = 'dashboard/add_to_group';
$route['users'] = 'dashboard/users';
$route['users/new'] = 'dashboard/new';
$route['users/(:any)'] = 'dashboard/view_user';
$route['users/remove/(:any)'] = 'dashboard/delete_user';
$route['remove/(:any)'] = 'dashboard/remove_user';
$route['add/(:any)/(:any)'] = 'dashboard/add_user';

// $route['users/add_to_group/(:any)'] = 'dashboard/add_to_group';
$route['groups'] = 'dashboard/groups';
$route['groups/new'] = 'dashboard/new_group';
$route['groups/(:any)'] = 'dashboard/view_group';
$route['groups/remove/(:any)'] = 'dashboard/delete_group';
$route['api/v1/auth/(:any)'] = 'api/dizcoveries';

// '/en' and '/fr' URIs -defining language characters to your website
$route['^en/(.+)$'] = "$1";
$route['^fr/(.+)$'] = "$1";
$route['^es/(.+)$'] = "$1";

// '/en' and '/fr' URIs -> use default controller

$route['^en$'] = $route['default_controller'];
$route['^fr$'] = $route['default_controller'];
$route['^es$'] = $route['default_controller'];

