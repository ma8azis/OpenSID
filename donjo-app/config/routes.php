<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['sitemap\.xml'] = "Sitemap/index";
$route['feed\.xml'] = "Feed/index";
$route['ppid'] = "Api_informasi_publik/ppid";
