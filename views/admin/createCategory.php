<?php $info = $this->info['page']; ?>
<style>
    input{
        height: 25px;
        border: #000 1px solid;
        margin-bottom: 10px;
    }
</style>
<div style="padding: 10px;">
    <a href="?page=admin/list">Admin Home</a> | <a href="?page=admin/showCategories">Show Category</a>
</div>
<form action="" method="POST" style="background: #000; padding: 20px;">
    <div style="clear: both; margin: 10px 0px;"><div style="float: left; width: 100px;">Name </div><input type="text" name="category[name]" value="<?php echo $info['name']; ?>"/></div>
    <div style="clear: both; margin: 10px 0px;"><input type="submit" value="submit" /></div>
    <div style="clear: both; margin: 10px 0px;"></div>
</form>