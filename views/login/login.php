<?php $info = $this->info; ?>
<div>
	<form action="" method="POST">
		<div>
			<div>Username </div></div><input type="text" name="user[username]" value="<?php echo $info['username']; ?>"/><?php $this->showError('username'); ?>
		</div>
		<div>
			<div>Password </div><input type="password" name="user[password]" value="<?php echo $info['password']; ?>"/><?php $this->showError('password'); ?>
		</div>
		<input type="submit" name="submit" value="Submit"/>
	</form>
	<div><a href="?page=user/forgot">Forgot Password</a></div>
	<div><a href="?page=user/signup">Signup</a></div>
</div>