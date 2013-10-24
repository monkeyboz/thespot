<?php 
	$content = $this->info[0]; 
	$this->comments['content_id'] = $content['content_id'];
?>
<div>
	<div style="margin-top: 10px; float: left; float: left; margin-bottom: 50px; width: 820px;">
		<h2><?php echo $content['name']; ?></h2>
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_preferred_1"></a>
        <a class="addthis_button_preferred_2"></a>
        <a class="addthis_button_preferred_3"></a>
        <a class="addthis_button_preferred_4"></a>
        <a class="addthis_button_compact"></a>
        <a class="addthis_counter addthis_bubble_style"></a>
        </div>
        <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507bd2722ce0b5ba"></script>
        <!-- AddThis Button END -->
		<div style="margin-top: 10px; margin-bottom: 20px;">
			<?php echo $this->getContent($content['content_id']); ?>
		</div>
		<div style="float: left; min-width: 800px;">
			<?php $username = $this->query('SELECT username, user_id FROM users WHERE user_id='.$content['user_id']); ?>
            <div style="float: right;"><?php echo date('D, F j, Y h:i a', strtotime($content['created'])); ?></div>
			<strong>Submitted By <a href="?page=user/display/<?php echo $username[0]['username']; ?>"><?php echo $username[0]['username']; ?></a></strong>
			<div style="clear: both; margin-top: 10px;">
            	<img src="<?php echo $this->getUserPic($username[0]['user_id']); ?>" style="float: left; width: 150px; margin-right: 10px; border:5px solid #525252;"/>
            	<?php $related = $this->likeContent($username[0]['user_id'], $content); if(!is_array($related) > 0) echo $related; ?>
				<?php echo $this->addParagraphs(str_replace('\\', '', $content['description'])); ?>
            </div>
		</div>
		<div style="clear: both;"></div>
        <div>
			<h2 style="margin-bottom: 0px;">Comments</h2>
			<?php include('./controllers/helper/show.php'); ?>
		</div>
	</div>
	<?php $this->impressions('content', $content['content_id']); ?>
</div>