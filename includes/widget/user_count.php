<div class="widget">
	<h2>users</h2>
	<div class="inner">
		<?php
		$user_count = user_count();
		$suffix = ($user_count != 1) ? 's' : ''; ?>
		we currently have <?php echo user_count(); ?> active user<?php echo $suffix; ?>.
	</div>
</div>