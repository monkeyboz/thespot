<?php $info = $this->info[0]; ?>
<div class="userHolder">
	<h2>Artist</h2>
	<a href="?page=user/display/<?php echo $info['username']; ?>">
		<div class="imgHolder">
			<img src="<?php echo $this->getUserPic($info['user_id']); ?>" style="width: 100%;"/>
		</div>
		<div style="float: left; width: 110px;">
			<h4 style="font-size: 15px;"><?php echo $info['username']; ?></h4>
		</div>
	</a>
</div>
<div style="float: left; margin-top: 10px;">
	<a href="?page=user/display/<?php echo $info['username']; ?>">
		<h2><?php echo $info['name']; ?></h2>
		<div class="imgHolder" style="width: 600px;">
			<img src="<?php echo $this->getReleasePic($info['release_id']); ?>" style="width: 100%; margin-bottom: 10px;"/>
		</div>
		<h2>Track List</h2>
		<ol>
		<?php foreach($this->tracks as $k=>$t){ ?>
					<li style="margin-bottom: 5px;"><?php echo $t['name']; ?></li>
		<?php } ?>
		</ol>
	</a>
</div>