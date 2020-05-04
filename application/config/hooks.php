<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/



/*
	Check if the user logged in or not in the system on each
	http requests.
*/
$hook["post_controller"] = array(
	"class" => "Application_Hooks",
	"function" => "is_logged_in",
	"filename" => "Application_Hooks.php",
	"filepath" => "hooks"
);
