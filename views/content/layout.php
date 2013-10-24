<?php $info = $this->info; ?>
<script type="text/javascript" src="js/masonry/jquery.masonry.min.js"></script>
<script>
    $(document).ready(function(){
		$('#userContentHolder').imagesLoaded( function(){
			$('#userContentHolder').masonry({
				itemSelector : '.userContentHolder',
				columnWidth : 100	
			})
		})
	})
</script>
<div id="userContentHolder">
<?php foreach($info as $c){ ?>
	<?php $impressions = $this->query('SELECT SUM(count) AS count FROM impressions WHERE type="content" and type_id='.$c['content_id']); ?>
    <div class="userContentHolder">
        <a href="?page=user/content/show/<?php echo $c['content_id']; ?>"><?php echo $this->getContent($c['content_id']); ?>
        <h3 style="margin-bottom: 5px;"><?php echo $c['name']; ?></h3>
        <div><?php echo substr($c['description'], 0, 100); ?>...</div></a>
		<div style="padding: 5px; background: #525252; color: #efefef; margin-top: 5px;">
			views <?php echo $impressions[0]['count']; ?>
		</div>
        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $c['user_id']){ ?>
        <div><a href="?page=user/deleteContent/<?php echo $c['content_id']; ?>">Delete</a></div>
        <?php } ?>
    </div>
<?php } ?>
</div>