<?php foreach($this->info as $k=>$i){ ?>
<div style="padding: 10px; background: #fff; color: #000; margin-bottom: 10px;"><?php echo date('Y', strtotime($k)); ?></div>
<?php foreach($i as $j){ ?>
<div style="clear: both; padding: 10px;">
	<div style="float: left;"><a href="?page=portfolio/show/<?php echo $j['id']; ?>"><?php echo $j['name']; ?></a></div>
</div>
<?php } ?>
<?php } ?>