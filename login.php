<?php
include 'includes/overall/overall_header.php';
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'you need to enter a user name and password';
	} else if (user_exists($username) === false) {
		$errors[] = 'we can not find you in the database';
	} else if  (user_active($username) === false) {
		$errors[] = 'you have not activated your account!';
	} else {
	
		if (strlen($password) > 32) {
			$errors[] = 'password too long';
		}
		
		$login = login($username, $password);
		if ($login === false) {
			$errors[] = 'that user name or password is incorrect';
		} else {
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}
	}
	
	
} else {
	header('Location: register.php');
}
?>
<div style="height:20px;"></div>
<section>
<div class="inpagewindow"></div>
<div class="pad">
<?php include 'includes/side.php'; ?>

<div class="right pad-box2" style="height:160px;">
<?php
if (empty($errors) === false) {
?>
	<h2>we tried to log you in, but...</h2>
	<?php
	echo output_errors($errors);
	}
	?>
</div>

<div style="clear:both;"></div>
<div class="right" style="margin-top:-28px; position:relative; z-index:3;">
    
        
</div>
<br style="clear:both;">
</div>
</section>
<?php include 'includes/overall/overall_footer.php'; ?>