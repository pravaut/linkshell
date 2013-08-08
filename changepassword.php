<?php include 'includes/overall/overall_header.php';
protect_page();
 
if (empty($_POST) === false) {
    $required_fields = array('current_password', 'password', 'password_again');
        foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fields marked with an asterisk are required';
			break 1;
		}
	}

    if (md5($_POST['current_password']) === $user_data['password']) {
        if (trim($_POST['password']) !== trim($_POST['password_again'])) {
            $errors[] = 'your new passwords do not match';
        } else if (strlen($_POST['password']) < 6) {
            $errors[] = 'your new password needs to be be greater then 6 characters long';
        }
    } else {
        $errors[] = 'your current password is incorrect';
    }

    
}

?>


<div style="height:20px;"></div>
<section>
<div class="inpagewindow"></div>
<div class="pad">

<?php include 'includes/side.php'; ?>

<div class="right pad-box2">
    <h2>Change Password</h2>

<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
    echo 'your password has been changed';
} else {
if (empty($_POST) === false && empty($errors) === true){
    change_password($session_user_id, $_POST['password']);
    header('Location: changepassword.php?success');
} else if (empty($errors) === false) {
    echo output_errors($errors);
}
?>
    
    <form action="" method="post">
        <ul>
            <li>
            Current password:*<br />
            <input type="password" name="current_password">
            </li>
            <li>
            New password:*<br />
            <input type="password" name="password">
            </li>
            <li>
            retype new password:*<br />
            <input type="password" name="password_again">
            </li>
            <li>
            <input type="submit" value="change password">
            </li>
        </ul>
    </form>	    	
    
</div>
<br style="clear:both;">
</div>
</section>

<?php 
}
include 'includes/overall/overall_footer.php'; 
?>