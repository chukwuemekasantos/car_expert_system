<?php
function randStrGen($len){
	$result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789$";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}
function randStrGen1($len){
	$result = "";
    $chars = "ABCDEFGHI1234567890";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}
function randStrGen2($len){
	$result = "";
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}
function randStrGen3($len){
	$result = "";
    $chars = "1234567890";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}
?>