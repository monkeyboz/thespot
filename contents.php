<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>The Spot - <?php echo @$contents->title; ?></title>
<link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/style.css"></link>
<script type="text/javascript" src="<?php echo STATIC_URL; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_URL; ?>js/jquery-ui-1.8.21.custom.min.js"></script>
<link rel="stylesheet" href="<?php echo STATIC_URL; ?>js/ui-lightness/jquery-ui-1.8.21.custom.css"></link>

<body>
	<div id="content">
		<div id="logo">
			<a href="<?php echo LINK_URL; ?>home"><img src="<?php echo STATIC_URL; ?>images/logo.jpg"/></a>
            <ul>
            	<a href="<?php echo LINK_URL; ?>home">Home</a>
                <li>
                	<a href="<?php echo LINK_URL; ?>categories/showCategories">Categories</a>
                    <ul>
                    	<li><a href="<?php echo LINK_URL; ?>categories/showCategories/calendar">Calendars</a></li>
                        <li><a href="<?php echo LINK_URL; ?>categories/showCategories/group">Groups</a></li>
                    </ul>
                </li>
                <li>
                	<a href="<?php echo LINK_URL; ?>user/artists">Users</a>
                    <ul>
                    	<li><a href="<?php echo LINK_URL; ?>user/general">General Users</a></li>
                        <li><a href="<?php echo LINK_URL; ?>user/artist">Artists</a></li>
                        <li><a href="<?php echo LINK_URL; ?>user/model">Models</a></li>
                        <li><a href="<?php echo LINK_URL; ?>user/actor">Actors</a></li>
                        <li><a href="<?php echo LINK_URL; ?>user/promoter">Promoters</a></li>
                        <li><a href="<?php echo LINK_URL; ?>user/producer">Producers/Directors</a></li>
                    </ul>
                </li>
                <li>
                	<a href="<?php echo LINK_URL; ?>user/content">Content</a>
                    <ul>
                    	<li><a href="<?php echo LINK_URL; ?>photos">Photos</a></li>
                        <li><a href="<?php echo LINK_URL; ?>content/music">Music</a></li>
						<li><a href="<?php echo LINK_URL; ?>content/video">Videos</a></li>
                        <li><a href="<?php echo LINK_URL; ?>content/blurb">Blurbs</a></li>
                        <li><a href="<?php echo LINK_URL; ?>content/article">Articles</a></li>
                        <li><a href="<?php echo LINK_URL; ?>content">More ...</a></li>
                    </ul>
                </li>
            </ul>
            <script>
				var curr = null;
				$.fn.accordian = function(){
					$(this).data('subHeight', $(this).find('ul').height());
					$(this).find('ul').css('height','0px').css('overflow', 'hidden');
					curr = $(this).find('ul');
					$(this).click(function(){
						var test = false;
						if($(this).find('ul li').html() == null){ test = true; curr = null }
						curr.animate({'height':'0px'}, 500);
						curr = $(this).find('ul');
						$(this).find('ul').animate({'height':$(this).data('subHeight')+'px'}, 500);
						return test;
					})
				}
				$('#logo ul li').each(function(){ $(this).accordian() });
			</script>
            <div style="background: #ff6600;"><?php $contents->render('login/signin', false); ?></div>
			<div style="clear: both; padding: 10px;"></div>
            <script type="text/javascript"><!--
				google_ad_client = "ca-pub-3792069331807752";
				/* Personal Website */
				google_ad_slot = "2178419576";
				google_ad_width = 200;
				google_ad_height = 200;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
        <div style="float: left; width: 829px;">
        	<div id="search">
                <form action="<?php echo LINK_URL; ?>search" method="POST" id="search">
                    <input type="text" name="query"/>
                    <input type="submit" value="GO" name="submit"/>
                </form>
                <div style="clear: both;"></div>
            </div>
			<?php echo $contents->contents; ?>
        </div>
		<?php if(DEBUG == 1){ ?>
		<div style="clear: both; padding: 20px; background: #efefef;">
			<h1>DEBUG</h1>
			<?php echo $contents->debug; ?>
		</div>
		<?php } ?>
	<div id="footer">
		<a href="<?php echo LINK_URL; ?>pages/contact">Contact Us</a> | 
		<a href="<?php echo LINK_URL; ?>pages/privacy">Privacy Policy</a> | 
		<a href="<?php echo LINK_URL; ?>categories/list">Categories</a> | 
		<a href="<?php echo LINK_URL; ?>users/signup">Signup</a> 
		<div style="float: right;">&copy; Copyright 2012 The Spot. All rights reserved</div>
	</div>
	</div>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35574991-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>