<style>
	.layout{
		clear: both;
	}
	.layout a{
		font-size: 12px;
		font-weight: bold;
		display: block;
		float: left;
		padding: 10px;
	}
	.admin_table{
		width: 100%;
	}
	.admin_table .header td{
		background: #fff;
		color: #000;
		padding: 10px;
	}
	.admin_table .row td{
		border-bottom: 1px solid #efefef;
		padding: 10px;
	}
	.clear{
		clear: both;
	}
</style>
<div class="layout">
	<a href="?page=admin">Admin</a><a href="?page=admin/createCategory">Create Category</a>
	<div class="clear"></div>
</div>
<table class="admin_table">
	<tr class="header">
		<td>Name</td>
		<td>ID</td>
		<td>Actions</td>
	</tr>
	<?php foreach($this->categories as $c){ ?>
	<tr class="row">
		<td><?php echo $c['name']; ?></td>
		<td><?php echo $c['id']; ?></td>
		<td><a href="?page=admin/editCategory/<?php echo $c['id']; ?>">Edit</a> | <a href="?page=admin/deleteCategory/<?php echo $c['id']; ?>">Delete</a></td>
	</tr>	
	<?php } ?>
</table>