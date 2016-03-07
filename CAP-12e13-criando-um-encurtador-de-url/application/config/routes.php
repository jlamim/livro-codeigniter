<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = "Urls";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = "User/Login";
$route['logout'] = "User/Logout";
$route['user'] = "User/Index";
$route['user/register'] = "User/Register";
$route['minhas-urls'] = "User/Urls";
$route['alterar-senha'] = "User/UpdatePassw";
$route['(:any)'] = "Urls/Go";
