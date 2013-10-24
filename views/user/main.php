<?php $users = $this->info['users']; ?>
<script src="js/hover.js" type="text/javascript"></script>

<div style="border-bottom: 1px solid #efefef; padding-bottom: 10px;">
	<?php foreach($users as $u){ ?>
		<?php $this->showUser($u); ?>
	<?php } ?>
	<div style="clear: both;"></div>
</div>