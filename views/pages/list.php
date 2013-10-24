<style>
	#userHeader{
		background: #000;
		font-weight: bold;
		clear: both;
		color: #fff;
		height: 20px;
		padding: 3px;
	}
	#userHeader div{
		padding: 3px;
		float: left;
		display: block;
	}
	.userinfo{
		padding: 3px;
		clear: both;
		border-bottom: 1px solid #ababab;
		background: #fff;
	}
	.userColumn, .passColumn{
		float: left;
		margin-left: 10px;
		width: 175px;
	}
	.descColumn{
		float: left;
		width: 275px;
		margin-right: 40px;
	}
	.odd{
		background: #efefef;
	}
	.expire{
		background: #ff0000;
	}
	a{
		text-decoration: none;
		color: #000;
	}
</style>
<div id="pagesHolder">
<div style="color: #fff; padding: 10px;">
	<a href="?page=pages/create" style="color: #fff;">Create New Page</a>
</div>
<?php include('views/pagination/pagination.php'); ?>
<div id="userHeader">
	<div class="userColumn">Page Name</div>
	<div class="descColumn">Description</div>
	<div class="passColumn">Parent</div>
	<div class="passColumn"></div>
	<div style="clear: both;"></div>
</div>
<div style="clear: both;">
<?php $count = 0; foreach($this->info as $i){ ?>
<div class="userinfo <?php if($count % 2) echo 'odd'; ?>">
	<a href="?page=pages/change/<?php echo $i['page_id']; ?>">
	<div class="userColumn"><?php echo $i['name']; ?></div>
	<div class="descColumn"><?php echo substr($i['description'], 0, 100); ?>...</div>
	<div class="passColumn"><?php echo $i['parent_id']; ?></div>
	<div class="passColumn"><a href="?page=pages/remove/<?php echo $i['page_id']; ?>">Delete</a></div>
	</a>
	<div style="clear: both;"></div>
</div>
<?php ++$count; } ?>
</div>
<?php include('views/pagination/pagination.php'); ?>
</div>