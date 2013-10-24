<div class="comment_holder">
	<?php foreach($this->comments['holder'] as $c){ ?>
	<div style="border-bottom: 1px solid #efefef; padding: 10px 0px;">
		<div style="float: left; width: 100px;">
			<a href="?page=user/display/<?php echo $c['username']; ?>"><div style="border: 5px solid #525252;"><img src="<?php echo $this->getUserPic($c['user_id']); ?>" width="100%;"/></div></a>
		</div>
		<div style="margin-left: 120px;" class="editHolder">
			<?php echo $c['description']; ?>
			<div style="margin-top: 10px; font-weight: bold; font-size: 14px;"><?php echo strtoupper($c['username']); ?> - <?php echo $c['city']; ?>, <?php echo $c['state']; ?> - <?php echo date('M d, Y', strtotime($c['date'])); ?></div>
		    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $c['user_id']){ ?>
                <div style="clear: both; margin-top: 10px;">
                    <a href="?page=user/deleteComment/<?php echo $c['comments_id']; ?>" style="color: #00AEFF;" class="delete">Delete</a> | 
                    <a href="?page=user/editComment/<?php echo $c['comments_id']; ?>" style="color: #00AEFF;" class="edit">Edit</a> | 
                </div>
            <?php } ?>
            <a href="?page=user/likeComment/<?php echo $c['comments_id']; ?>" style="color: #00AEFF;">Like</a>
		</div>
		<div style="clear: both;"></div>
	</div>
	<?php } ?>
	<div class="comment">
		<a href="?page=user/addComment/<?php echo $this->comments['content_type']; ?>/<?php echo $this->comments['content_id']; ?>" class="add">Add a comment</a>
	</div>
</div>
<script type="text/javascript" src="./js/edit.js"></script>