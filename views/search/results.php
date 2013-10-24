<div style="float: left; width: 665px;">
<h2>Pages</h2>
<?php foreach($this->search['pages'] as $c){ ?>
<div>
	<a href="?page=pages/<?php echo $c['name']; ?>">
		<div class="title" style="background: #000; font-size: 20px; color: #fff; margin: 10px 0px; font-weight: bold; padding: 10px;"><?php echo $c['name']; ?></div>
		<div><?php echo $c['description']; ?></div>
		<div style="color: #6e6e6e; text-align: right;"><?php echo date('Y-m-d', strtotime($c['date'])); ?></div>
		<div style="clear: both;"></div>
	</a>
</div>
<?php } ?>

<h2>Users</h2>
<?php $users = $this->search['users']; ?>
<?php foreach($users as $u){ ?>
	<?php $this->showUser($u); ?>
<?php } ?>
<div style="clear: both;"></div>

<h2>Content</h2>
<?php foreach($this->search['content'] as $c){ ?>
<div>
	<a href="?page=user/content/show/<?php echo $c['content_id']; ?>">
		<?php echo $this->getContent($c['content_id']); ?>
		<div class="title" style="background: #000; font-size: 20px; color: #fff; margin: 10px 0px; font-weight: bold; padding: 10px;"><?php echo $c['name']; ?></div>
		<div><?php echo $c['description']; ?></div>
		<div style="color: #6e6e6e; text-align: right;"><?php echo date('Y-m-d', strtotime($c['created'])); ?></div>
		<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $c['user_id']){ ?>
		<div><a href="?page=user/deleteContent/<?php echo $c['content_id']; ?>">Delete</a></div>
		<?php } ?>
	</a>
</div>
<?php } ?>
<div style="clear: both;">
</div>

<h2>Comments</h2>
<?php foreach($this->search['comments'] as $c){ ?>
<div class="content" style="margin-bottom: 10px;">
    <a href="?page=user/content/show/<?php echo $c['content_id']; ?>">
        <div><?php echo $c['description']; ?></div>
        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $c['user_id']){ ?>
        <div><a href="?page=user/deleteComment/<?php echo $c['comment_id']; ?>">Delete</a></div>
        <?php } ?>
    </a>
    <div style="clear: both;"></div>
</div>
<?php } ?>
<div style="clear: both;"></div
</div>