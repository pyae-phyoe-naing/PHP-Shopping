<?php
function setSession($key, $message)
{
	if (isset($_SESSION[$key])) {
		$_SESSION[$key] = '';
	}
	$_SESSION[$key] = $message;
}
function getSession($key)
{

	if (!empty($_SESSION[$key])){
		echo $_SESSION[$key];
	}
}
function pretty($arr)
{
	echo "<pre>" . print_r($arr, true) . "</pre>";
}
function redirect($path)
{
	header("Location:$path");
}
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
function validate($errors, $value)
{
	if (isset($errors[$value])) {
		echo "<small class='text text-danger'><strong>" . $errors[$value] . "</strong></small>";
	} else {
		echo '';
	}
}
