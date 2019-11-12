<?php //session_start();
date_default_timezone_set('Africa/Lagos');
include_once("db_conx.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_email = "";
$log_password = "";
// User Verify function
function evalLoggedUser($db,$id,$e,$p){
	// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
	$res = $db->query("SELECT ip FROM users WHERE id='$id' AND email='$e' AND password='$p' LIMIT 1");
	$existCount = $res->fetchColumn();
	if ($existCount > 0) { // evaluate the count
	return true;
	}
	}
if(isset($_SESSION["userid"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
	$log_email = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION['email']);
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	// Verify the user
	$user_ok = evalLoggedUser($db,$log_id,$log_email,$log_password);
} else if(isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
	$_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['email'] =  preg_replace('#[^A-Za-z0-9]#i', '', $_COOKIE['user']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
	$log_id = $_SESSION['userid'];
	$log_email = $_SESSION['email'];
	$log_password = $_SESSION['password'];
	// Verify the user
	$user_ok = evalLoggedUser($db,$log_id,$log_email,$log_password);
	if($user_ok == true){
	}
}
?><?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>