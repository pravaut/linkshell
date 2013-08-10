<?php
function activate($email, $email_code) {
    $email      = mysql_real_escape_string($email);
    $email_code = mysql_real_escape_string($email_code);

    if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `user` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"), 0) == 1) {
        mysql_query("UPDATE `user` SET `active` = 1 WHERE `email` = '$email'");
        return true;
    }else {
        return false;
    }
}    

function change_password($user_id, $password) {
    $user_id = (int)$user_id;
    $password = md5($password);

    mysql_query("UPDATE `user` SET `password` = '$password' WHERE `user_id` = $user_id");

}   

function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	mysql_query("INSERT INTO `user` ($fields) VALUES ($data)");
    email($register_data['email'], 'Activate your account', "Hello " . $register_data['first_name'] . ",\n\nYou need to activate your account, so use the link below:\n\nhttp://test.shadow-guard.co.uk/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n-shadow guard");
}

function user_count() {
	return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `user` WHERE `active` = 1"), 0);
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		
		$fields = '`' .  implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `user` WHERE `user_id` = $user_id"));
		
		return $data;
	}
}

function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}
function user_exists($username) {
	$email = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `user` WHERE `username` = '$username'"), 0) == 1) ? true : false;
}

function email_exists($email) {
	$username = sanitize($email);
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `user` WHERE `email` = '$email'"), 0) == 1) ? true : false;
}

function user_active($username) {
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `user` WHERE `username` = '$username' AND `active` = 1"), 0) == 1) ? true : false;
}
function user_id_from_username($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `user_id` FROM `user` WHERE `username` = '$username'"), 0, 'user_id');
}

function login($username, $password) {
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = md5($password);
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `user` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}
?>