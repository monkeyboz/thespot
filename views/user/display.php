<?php $user = $this->info['user']; ?>
<script src="js/hover.js" type="text/javascript"></script>

<div class="userNav">
	<a href="?page=user/content/<?php echo $user['username']; ?>">Content</a>
	<a href="?page=user/wall/<?php echo $user['username']; ?>">Wall Post</a>
	<a href="?page=user/showCalendar/<?php echo $user['username']; ?>">Calendar</a>
	<?php if(isset($_SESSION['username']) && $_SESSION['username'] == $user['username']){ ?>
	<a href="?page=user/change">Edit Profile</a>
	<?php } ?>
</div>
<div>
	<div style="float: left; width: 820px;">
	    <div style="float: left; width: 200px; margin-right: 20px; padding: 10px; background: #525252;">
        <img src="<?php echo $this->getUserPic($user['user_id']); ?>" style="width: 100%;"/>
	    <?php if(isset($_SESSION['user_id'])){ 
	        if($this->checkRelations($user['user_id'], 'friend')){
	        ?>
            <a href="?page=user/addFriend/<?php echo $user['user_id']; ?>" style="background: #000; padding: 5px;">+ Friend</a>
        <?php } } else { ?>
            <a href="?page=user/signup" style="background: #000; padding: 5px;">+ Friend</a>
        <?php } ?>
        </div>
        <div style="float: left; float: left; width: 580px;">
            <h2 style="margin-bottom: 10px;"><?php echo $user['username']; ?></h2>
            <div><?php echo $user['description']; ?></div>
            <div id="userinfo">
                <strong><?php echo $user['city']?>, <?php echo $user['state']; ?></strong>
            </div>
        </div>
	</div>
	<div style="float: left; width: 820px;">
		<div style="clear: both;">
		    <h2>Friends</h2>
		    <?php $friends = $this->query('SELECT * FROM user_relations AS r JOIN users AS u ON r.user_id=u.user_id WHERE r.type="friend" AND r.user_id='.$user['user_id']); 
		      foreach($friends AS $f){
		          $friend = $this->query('SELECT * FROM users WHERE user_id='.$f['content_id']);
		          $this->showUser($friend[0]);
		      } ?>
		    <div style="clear: both;"></div>
		</div>
		<div style="clear: both;">
            <h2>Events This Month</h2>
            <?php $event = $this->query('SELECT * FROM user_relations AS r JOIN contents AS u ON r.content_id=u.content_id WHERE (r.type="event" AND r.user_id='.$user['user_id'].') AND u.data LIKE "%\"date\":\"'.date('m').'%"');
               $userParticipating = $this->query('SELECT * FROM contents WHERE data LIKE "%'.$user['username'].'%" and data LIKE "%\"date\":\"'.date('m').'%"');
               $event = array_merge($event, $userParticipating);
              foreach($event AS $e){ $data = json_decode($e['data']); ?>
                <div style="margin-bottom: 3px; padding: 5px; background: #000;">
                    <div style="float: right;"><?php echo date('l, F d Y g:i A', strtotime($data->date)); ?></div>
                    <a href="?page=user/showEvent/<?php echo $e['content_id']; ?>"><?php echo $e['name']; ?></a>
                    At <a href="?page=categories/venue/<?php echo $data->placeName; ?>"><?php echo $data->placeName; ?></a> in <a href="?page=categories/city/<?php echo $data->city; ?>"><?php echo $data->city; ?></a>
                </div>
            <?php } ?>
            <div style="clear: both;"></div>
        </div>
		<div>
			<h2 style="margin-bottom: 0px;">Comments</h2>
			<?php include('./controllers/helper/show.php'); ?>
		</div>
	</div>
</div>
<?php $this->impressions('user', $user['user_id']); ?>