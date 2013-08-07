<div class="left">
	<?php 
	if (logged_in() === true) {
		include 'widget/Loggedin.php';
	} else {
		include 'widget/login.php'; 
	}
	include 'widget/user_count.php';
	?>
</div>