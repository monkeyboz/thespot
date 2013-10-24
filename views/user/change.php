<?php $info = $this->info[0]; ?>
<form action="" method="POST" enctype="multipart/form-data">
<div style="width: 150px; float: left; margin: 10px;">
	<img src="<?php echo $this->getUserPic($this->id).'?p='.rand(); ?>" style="width: 150px;"/>
</div>
<div style="float: left; margin: 10px; width: 200px;">
		<div>
			<div>
				Username
			</div>
			<input type="text" name="user[username]" value="<?php echo $info['username']; ?>"/><?php $this->showError('username'); ?>
		</div>
		<div>
			<div>
				Email
			</div>
			<input type="text" name="user[email]" value="<?php echo $info['email']; ?>"/><?php $this->showError('email'); ?>
		</div>
		<div>
			<div>
				Address
			</div>
			<input type="text" name="user[address]" value="<?php echo $info['address']; ?>"/><?php $this->showError('address'); ?>
		</div>
		<div>
			<div>
				City
			</div>
			<input type="text" name="user[city]" value="<?php echo $info['city']; ?>"/><?php $this->showError('city'); ?>
		</div>
		<div>
			<div>
				State
			</div>
			<input type="text" name="user[state]" value="<?php echo $info['state']; ?>"/><?php $this->showError('state'); ?>
		</div>
		<div>
			<div>
				Zip
			</div>
			<input type="text" name="user[zip]" value="<?php echo $info['zip']; ?>"/><?php $this->showError('zip'); ?>
		</div>
		<div>
			<div>
				Profile Pics
			</div>
			<input type="file" name="profile"/>
		</div>
		<input type="submit" name="submit" value="Signup"/>
</div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<div style="float: left; margin: 10px;">
	<div>
		<div>Description</div>
		<textarea id="settingup" class="ckeditor" name="description[description]" style="width: 390px; height: 200px;"><?php echo $this->description['description']; ?></textarea>
        <div>
			Twitter Account
		</div>
	</div>
</div>
</form>