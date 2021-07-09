<?php

####### Replace URL
function set_url( $url )
{
    echo("<script>history.replaceState({},'','$url');</script>");
}

##################
function setSession($key, $message)
{
	if (isset($_SESSION[$key])) {
		$_SESSION[$key] = '';
	}
	$_SESSION[$key] = $message;
}
function checkSession($key){
	if(isset($_SESSION[$key])){
		return true;
	}
	return false;
}
function getSession($key)
{

	if (!empty($_SESSION[$key])){
		echo $_SESSION[$key];
	}
}
## print pretty
function pretty($arr)
{
	echo "<pre>" . print_r($arr, true) . "</pre>";
}
## back with Session 
function back($status,$message,$path){
    setSession($status, $message);
    redirect($path);
    die();
}
## redirect
function redirect($path)
{
	header("Location:$path");
}
## generate slug
function slug($str)
{
	return time() . str_replace(' ', '-', $str);
}

// For security
function escape($html)
{
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

// For Validation
function validate($errors, $value,$place="text-center")
{
	if (isset($errors[$value])) {
		echo "<small class='text text-danger $place'><strong>" . $errors[$value] . "</strong></small>";
	} else {
		echo '';
	}
}
