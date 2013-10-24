<?php $info = $this->info['page']; ?>
<style>
	input{
		height: 25px;
		border: #000 1px solid;
		margin-bottom: 10px;
	}
</style>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<div style="padding: 10px;">
	<a href="?page=admin/list">Admin Home</a> | <a href="?page=pages/list">List Pages</a>
</div>
<form action="" method="POST" style="background: #fff; padding: 20px;">
	<div style="clear: both; margin: 10px 0px;"><div style="float: left; width: 100px;">Name </div><input type="text" name="page[name]" value="<?php echo $info['name']; ?>"/></div>
	<div style="clear: both; margin: 10px 0px;"><textarea name="page[description]" class="ckeditor" style=" margin: 10px 0px;"><?php echo $info['description']; ?></textarea></div>
	<div style="clear: both; margin: 10px 0px;"><div style="float: left; width: 100px;">Parent Page </div><select name="page[parent_id]">
		<option value="0">-no parent-</option>
	<?php foreach($this->info['parents'] as $p){ ?>
		<option <?php if($p['id'] == $info['parent_id']){ ?> selected <?php } ?>value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
	<?php } ?>
	</select></div>
	<div style="clear: both; margin: 10px 0px;"><input type="submit" value="submit" /></div>
	<div style="clear: both; margin: 10px 0px;"></div>
</form>