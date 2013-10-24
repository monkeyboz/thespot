<div>
	<div>
		<strong>Welcome Back <?php echo $_SESSION['username']; ?></strong>
	</div>
	<?php $messages = $this->info['messages']; ?>
	<?php print_r($messages); ?>
</div>