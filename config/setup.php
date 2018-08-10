<?php
error_reporting(0);

include('config/connection.php');

DEFINE('D_TEMPLATE', 'template');
DEFINE('D_VIEW', 'views');

include('functions/sandbox.php');
include('functions/data.php');
include('functions/template.php');

$debug = data_setting_value($dbc, 'debug-status');

$path = get_path();

$site_title = 'AtomCMS 2.0';

if(!isset($path['call_parts'][0]) || $path['call_parts'][0] == '' ) {
	
	header('Location: home');
	
}

$page = data_post($dbc, $path['call_parts'][0]);
$view = data_post_type($dbc, $page['type']);




?>