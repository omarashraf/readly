<?php
	include('selectDB.php');


	// 'users' table's data.

	//$users_email_arr = array();
	//$users_password_arr = array();


	function checkEmail($email) {
		if(strpos($email, '@') && strpos($email, '.')) {
			return true;
		}
		return false;
	}

	function checkPassword($password) {
		if(strlen($password) >= 8 && (strpos($password, '1') || strpos($password, '2') || strpos($password, '3') || strpos($password, '4') ||
			strpos($password, '5') || strpos($password, '6') || strpos($password, '7') || strpos($password, '8') || strpos($password, '9') ||
			strpos($password, '0'))) {
			return true;
		}
		return false;
	}

	function validLoginData($email, $password) {
		$check_user_sql = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "'";
		$users = mysql_query($check_user_sql);
		if(mysql_num_rows($users) > 0) {
			return true;
		}
		return false;
	}

	function validFBLoginData($email) {
		$check_user_sql = "SELECT * FROM users WHERE email = '" . $email . "'";
		$users = mysql_query($check_user_sql);
		if(mysql_num_rows($users) > 0) {
			return true;
		}
		return false;
	}

?>
