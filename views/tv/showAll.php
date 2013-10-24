<?php foreach($this->info as $i){ ?>
<div class="userHolder">
	<a href="?page=user/content/show/<?php echo $i['content_id']; ?>"><h4><?php echo $i['name']; ?></h4></a>
	<strong><?php echo $i['description']?></strong>
	<div>Created On: <?php echo date('Y-m-d', strtotime($i['created'])); ?></div>
</div>
<?php } ?>