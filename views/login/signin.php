<?php if(!isset($_SESSION['user_id'])){ ?>
<a href="<?php echo LINK_URL; ?>user/signup">Sign-Up</a> <a href="<?php echo LINK_URL; ?>user/login">Log-In</a>
<?php }  else { ?>
<a href="<?php echo LINK_URL; ?>user/display/<?php echo $_SESSION['username']; ?>">Profile</a> <a href="<?php echo LINK_URL; ?>logout">Log-out</a>
<?php } ?>