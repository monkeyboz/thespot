<style>
<!--
	.input{
		background: url(images/form_background_2.jpg);
		width: 258px;
		height: 27px;
		border: 0px solid #fff;
		padding-left: 10px;
		color: #fff;
		float: left;
	}
	.infoHolder{
		margin-bottom: 10px;
	}
	.labels{
		float: left;
		width: 100px;
	}
	.bottom{
		clear: both;
	}
	.error{
		float: left;
		margin-left: 10px;
		color: #ff0000;
	}
	#bottomInfo{
		padding: 20px;
		background: #bb0000;
		margin-top: 30px;
		text-align: center;
	}
	#submit{
		background: url(images/submit_button.jpg);
		width: 146px;
		height: 45px;
		border: 0px solid #fff;
	}
-->
</style>
<?php if(!isset($_GET['ajax'])){ ?>
<img src="images/main_page_top.jpg" style="margin-bottom: 30px;"/>
<?php } ?>
<div id="dataInfo">
	<form action="" method="POST" id="getInfo">
		<div class="infoHolder">
			<div class="labels">First Name <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[first_name]" value="<?php echo $this->info['first_name']; ?>"/>
			<?php $this->showError('first_name'); ?>
			<div class="bottom"></div>
		</div>
		<div class="infoHolder">
			<div class="labels">Last Name <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[last_name]" value="<?php echo $this->info['last_name']; ?>"/>
			<?php $this->showError('last_name'); ?>
			<div class="bottom"></div>
		</div>
		<div class="infoHolder">
			<div class="labels">Email <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[email]" value="<?php echo $this->info['email']; ?>"/>
			<?php $this->showError('email'); ?>
			<div class="bottom"></div>
		</div>
		<div class="infoHolder">
			<div class="labels">Zipcode <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[zipcode]" value="<?php echo $this->info['zipcode']; ?>"/>
			<?php $this->showError('zipcode'); ?>
			<div class="bottom"></div>
		</div>
		<div class="infoHolder">
			<div class="labels">City <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[city]" value="<?php echo $this->info['city']; ?>"/>
			<?php $this->showError('city'); ?>
			<div class="bottom"></div>
		</div>
		<div class="infoHolder">
			<div class="labels">State <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[state]" value="<?php echo $this->info['state']; ?>"/>
			<?php $this->showError('state'); ?>
			<div class="bottom"></div>
		</div>
		<div class="infoHolder">
			<div class="labels">County <span style="color: #ff0000;">*</span></div>
			<input type="text" class="input" name="user[county]" value="<?php echo $this->info['county']; ?>"/>
			<?php $this->showError('county'); ?>
			<div class="bottom"></div>
		</div>
		<div style="width: 100%; text-align: center;"><input type="submit" name="submit" value="" id="submit"/></div>
	</form>
	<div class="bottom"></div>
</div>
<?php if(!isset($_GET['ajax'])){ ?>
<div id="bottomInfo">
	<img src="images/rounded_corners.jpg" />
	<img src="images/rounded_corners.jpg" style="margin: 0px 30px;"/>
	<img src="images/rounded_corners.jpg" />
</div>
<?php } ?>
<script>
	$('form').submit(function(){
		var data = '';
		$('input').each(function(){
			data += $(this).attr('name')+'='+$(this).val()+'&';
		})
		$('#dataInfo').html('<img src="images/loading.gif"/>');
		$.ajax({
			url: '?page=captureInfo/getInfo&ajax=1',
			data: data,
			type: 'POST',
			success: function(html){
				$('#dataInfo').stop();
				$('#dataInfo').animate({opacity:1}, 500);
				$('#dataInfo').html(html);
			}
		})
		return false;
	})
	$('input[name=zipcode]').change(function(){
		$.ajax({
			url: '?page=captureInfo/getZipInfo&ajax=1',
			data: 'data='+$(this).val(),
			type: 'POST',
			success: function(html){
				
			}
		})
	})
	$('input[name=submit]').click(function(){
		var data = '';
		$('input').each(function(){
			data += $(this).attr('name')+'='+$(this).val()+'&';
		})
		$('#dataInfo').html('<img src="images/loading.gif"/>');
		$.ajax({
			url: '?page=captureInfo/getInfo&ajax=1',
			data: data,
			type: 'POST',
			success: function(html){
				$('#dataInfo').stop();
				$('#dataInfo').animate({opacity:1}, 500);
				$('#dataInfo').html(html);
			}
		})
		return false;
	})
</script>