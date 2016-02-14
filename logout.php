<?php 
session_start();
	if(isset($_SESSION['FBID'])) {
		session_unset();
    	$_SESSION['FBID'] = NULL;
    	$_SESSION['FULLNAME'] = NULL;
    	$_SESSION['EMAIL'] =  NULL;
    	$_SESSION['current_user_id'] = NULL;	
	}
	else {
		session_unset();
		$_SESSION['current_user_id'] = NULL;
    	$_SESSION['name'] = NULL;
    	$_SESSION['email_normal'] = NULL;
    	$_SESSION['image'] =  NULL;	
	}
// destination to be changed.
header("Location: login.php");
?>
