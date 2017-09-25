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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['.+(welcome)']='$1';

$route['saya-disembunyikan']='AN_admin';
$route['saya-disembunyikan/(.+)']='AN_admin/$1';

$route['author']='AN_author';
$route['author/(.+)']='AN_author/$1';

$route['artikel']='semua_artikel/semua';
$route['artikel/(\d+)']='semua_artikel/semua/$1';

$route['artikel/(\d+)[-\w]+']='semua_artikel/detail/$1';

$route['article']='semua_artikel/semua';
$route['article/(\d+)']='semua_artikel/semua/$1';

$route['article/(\d+)[-\w]+']='semua_artikel/detail/$1';

$route['diskusi']='semua_diskusi/semua';
$route['diskusi/(\d+)']='semua_diskusi/semua/$1';

$route['diskusi/(\d+)[-\w]+']='semua_diskusi/detail/$1';

$route['discussion']='semua_diskusi/semua';
$route['discussion/(\d+)']='semua_diskusi/semua/$1';

$route['discussion/(\d+)[-\w]+']='semua_diskusi/detail/$1';


$route['riliser']='semua_riliser/semua';
$route['riliser/(\d+)']='semua_riliser/semua/$1';

$route['riliser/(\d+)[-\w]+']='semua_riliser/detail/$1';

$route['blog']='semua_artikel/semua';
$route['blog/(\d+)']='semua_artikel/semua/$1';

$route['blog/(\d+)[-\w]+']='semua_artikel/detail/$1';


$route['kategori/(\d+)/?$']='kategori_artikel/detail/$1';
$route['kategori/(\d+)/(\d+)$']='kategori_artikel/detail/$1/$2';

$route['kategori/(\d+)[-\w]+$']='kategori_artikel/detail/$1';
$route['kategori/(\d+)[-\w]+/(\d+)$']='kategori_artikel/detail/$1/$2';


$route['category/(\d+)/?$']='kategori_artikel/detail/$1';
$route['category/(\d+)/(\d+)$']='kategori_artikel/detail/$1/$2';

$route['category/(\d+)[-\w]+$']='kategori_artikel/detail/$1';
$route['category/(\d+)[-\w]+/(\d+)$']='kategori_artikel/detail/$1/$2';

$route['tag/(\d+)/?$']='tags_artikel/detail/$1';
$route['tag/(\d+)/(\d+)$']='tags_artikel/detail/$1/$2';

$route['tag/(\d+)[-\w]+$']='tags_artikel/detail/$1';
$route['tag/(\d+)[-\w]+/(\d+)$']='tags_artikel/detail/$1/$2';


$route['label/(\d+)/?$']='tags_artikel/detail/$1';
$route['label/(\d+)/(\d+)$']='tags_artikel/detail/$1/$2';

$route['label/(\d+)[-\w]+$']='tags_artikel/detail/$1';
$route['label/(\d+)[-\w]+/(\d+)$']='tags_artikel/detail/$1/$2';

$route['page/(\d+)/?$']='page/detail/$1';
$route['page/(\d+)[-\w]+$']='page/detail/$1';


$route["contact-us"]="contact_us";
$route["hubungi-kami"]="contact_us";

$route["syarat-dan-ketentuan"]="syarat_ketentuan";
$route["terms-and-conditions"]="syarat_ketentuan";
