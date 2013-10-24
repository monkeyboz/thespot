<div>
	<?php $info = $this->info; ?>
	<form action="" method="POST">
		<div>
			<div>Username </div>
			<input type="text" name="login[username]" value="<?php echo $info['username']; ?>"/><?php $this->showError('username'); ?>
		</div>
		<div>
			<div>Email </div>
			<input type="text" name="login[email]" value="<?php echo $info['email']; ?>"/><?php $this->showError('email'); ?>
		</div>
		<div>
			<input type="submit" name="submit" value="Submit"/>
		</div>
	</form>
</div>