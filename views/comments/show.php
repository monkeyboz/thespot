<style>
    .editHolder{
        float: left; 
        width: 663px; 
        margin-left: 10px;
    }
</style>
<div style="float: left; width: 820px;">
	<h1>Wall Posts</h1>
	<div class="comment_holder">
	<?php foreach($this->comments['holder'] as $c){ ?>
	<div style="clear: both; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 3px solid #efefef;">
		<div style="float: left; width: 120px; margin-right: 10px; border: 4px solid #ababab;">
			<a href="?page=user/display/<?php echo $c['username']; ?>">
				<div style="width: 120px; margin-right: 20px;">
					<img src="<?php echo $this->getUserPic($c['user_id']); ?>" style="width: 100%"/>
				</div>
			</a>
			<div style="clear: both;"></div>
		</div>
		<div class="editHolder">
				<h3 style="font-family: impact; font-size: 20px; margin: 0px; text-transform: uppercase;">
				Posted In: <?php echo $c['content_type']; ?>
				</h3>
				<div>
					<?php 
					switch($c['content_type']){
						case 'user':
							$holder = $this->query('SELECT username FROM users WHERE user_id='.$c['user_id']);
							break;
					} ?>
				</div>
			<?php echo $this->addParagraphs($c['description']); ?>
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
	</div>
	<div class="comment">
		<a href="?page=user/addComment/<?php echo $this->comments['content_type']; ?>/<?php echo $this->comments['content_id']; ?>" class="edit">Post on Wall</a>
	</div>
</div>
<script type="text/javascript" src="./js/edit.js"></script>