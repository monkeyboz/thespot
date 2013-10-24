<?php $info = $this->info; ?>
<link href="js/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : 'js/uploadify.swf',
    'script'    : '?page=inventory/uploadFile/<?php echo $_SESSION['user_id']; ?>',
    'cancelImg' : 'js/cancel.png',
    'folder'    : 'tmp/<?php echo $_SESSION['user_id']; ?>/',
    'user_id'	: '<?php echo $_SESSION['user_id']; ?>',
    'multi'		: true,
    'auto'      : true,
    'fileExt'   : '*.jpg',
    <?php if(isset($this->id)){ ?>'onAllComplete' : function(){
	$.ajax({
				url: '?page=inventory/moveUploaded/<?php echo $this->id; ?>&ajax=1',
				success: function(html){
					$('#showImages').html('<div style="clear: both; color: #00ff00;">Images Uploaded</div>');
					$('#showImages').append(html);
				}
			})
        },
    <?php } else { ?>
	'onAllComplete' : $('#showImages').html('<div style="clear: both; color: #00ff00;">Images Uploaded</div>'),
    <?php } ?>
    'method'	: 'post',
  });
});
</script>
<form action="" method="POST" >
	<div style="width: 100%; margin-right: 20px; float: left; border-top: #003a62 solid 1px; border-bottom: #016aac solid 1px; margin: 10px 0px;"></div>
	<h2>Upload Images</h2>
	<div style="width: 100%; margin-right: 20px; float: left; border-top: #003a62 solid 1px; border-bottom: #016aac solid 1px; margin: 10px 0px;"></div>
		<div id="images" style="clear: both">
			<input id="file_upload" name="file_upload" type="file" />
			<div id="showImages"></div>
		</div>
	</div>
	<div>
		<textarea name="media[description]" style="width: 100%; height: 100px;"></textarea>
	</div>
	<div style="padding: 10px; background: #fff;">
		<input type="submit" value="SAVE CHANGES AND GOTO PHOTOS" name="submit" style="width: 260px;"/>
	</div>
</form>
<div id="showImages"></div>
<script>
	$.ajax({
		url: '?page=inventory/moveUploaded<?php if(isset($this->id)){ echo '/'.$this->id; }?>&ajax=1',
		timeout: 5000,
		success: function(html){
			$('#showImages').html(html);
		}
	})
</script>