<?php foreach($this->info as $t){ ?>
<div class="userHolder">
	<a href="?page=releases/show/<?php echo $t['release_id']; ?>">
		<div class="imgHolder">
			<img src="<?php echo $this->getReleasePic($t['release_id']); ?>" style="width: 100%;"/>
		</div>
		<div style="float: left; width: 110px;">
			<h4 style="font-size: 15px;"><?php echo $t['name']; ?></h4>
			<div><?php echo $t['username']; ?></div>
		</div>
	</a>
</div>
<?php } ?>