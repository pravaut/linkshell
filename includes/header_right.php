<div class="right">
<?php include 'nav.php';
	 
    if (logged_in() === true) {
		include 'widget/top_memberarea_loggedin.php';
	} else {
		include 'widget/top_memberarea_loggedout.php'; 
	}
	?>
</div>