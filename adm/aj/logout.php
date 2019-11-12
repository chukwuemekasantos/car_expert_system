<?php
include_once("inc/check_login_status.php");
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			// GET USER IP ADDRESS
			$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
session_start();
// Set Session data to an empty array
$_SESSION = array();
// Expire their cookie files
if(isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
	setcookie("id", '', strtotime( '-5 days' ), '/');
    setcookie("user", '', strtotime( '-5 days' ), '/');
	setcookie("pass", '', strtotime( '-5 days' ), '/');
}
// Destroy the session variables
session_destroy();
// Double check to see if their sessions exists
	header("location:index.php");
	exit();
?>