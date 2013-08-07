<?php include 'includes/overall/overall_header.php'; 
if (empty($_POST) === false) {
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fields marked with an asterisk are required';
			break 1;
		}
	}
	
	if (empty($errors) ==true) {
		if (user_exists($_POST['username']) == true) {
			$errors[] = 'sorry, the username \'' . $_POST['username'] . '\' is already taken.';
		}
		if (strlen($_POST['password']) < 6) {
			$errors[] = 'your password needs to be more then 6 characters';
		}
		
	}
}

print_r($errors);
?>

<div style="height:20px;"></div>
<section>
<div class="inpagewindow"></div>
<div class="pad">

<div class="right pad-box2">	    	
    <form action="" method="post">
	<ul>
		<li>
			Username:*<br />
			<input type="text" name="username">
		</li>
		<li>
			Password:*<br />
			<input type="password" name="password">
		</li>
		<li>
			Password again:*<br />
			<input type="password" name="password_again">
		</li>
		<li>
			First name:*<br />
			<input type="text" name="first_name">
		</li>
		<li>
			Last name:<br />
			<input type="text" name="last_name">
		</li>
		<li>
			Email:*<br />
			<input type="text" name="email">
		</li>
		<li>
		<br />
		<input type="submit" value="Register">
		</li>
	</ul>
	</form>
</div>
<br style="clear:both;">
</div>
</section>
<?php include 'includes/overall/overall_footer.php'; ?>