<?php $info = $this->info; ?>
<div>
	<form action="" method="POST"  enctype="multipart/form-data">
		<div>
			<div>Name</div>
			<input type="text" name="release[name]" value="<?php echo $info['name']; ?>"/><?php $this->showError('name', 'releases'); ?>
		</div>
		<div>
			<div>iTunes Link</div>
			<input type="text" name="release[itunes]" value="<?php echo $info['itunes']; ?>"/><?php $this->showError('itunes', 'releases'); ?>
		</div>
		<div>
			<div>Amazon</div>
			<input type="text" name="release[amazon]" value="<?php echo $info['amazon']; ?>"/><?php $this->showError('amazon', 'releases'); ?>
		</div>
		<div>
			<div>Amazon</div>
			<select name="release[user_id]">
				<option value="">Select Artist</option>
				<?php foreach($this->users as $u){ ?>
				<option value="<?php echo $u['user_id']; ?>"><?php echo $u['username']; ?></option>
				<?php } ?>
			</select>
		</div>
		<a href="" class="tracks">Click Here to Create Tracks</a>
		<div id="track_info">
		<?php $count = 0;?>
		<?php foreach($this->tracks as $k=>$t){ ?>
			<input type="text" name="tracks[]" value="<?php echo $t['name']; ?>"/>
		<?php $count = $k; } ?>
		</div>
		<input type="file" name="file"/>
		<input type="submit" value="Submit" name="submit"/>
	</form>
</div>
<script>
	$('.tracks').click(function(){
		$('#track_info').append('<input type="text" name="tracks[]" />');
		return false;
	})
</script>