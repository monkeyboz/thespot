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
<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $this->id){ ?>
<?php $upload = $video = $this->info['upload']; ?>
<style>
    #video{
        display: none;
    }
    #music{
        display: none;
    }
	#article{
		display: none;	
	}
</style>
<div id="contentHolder">
	<div id="contentNav">
		<a href="upload" id="navFile" class="selected" ref="">File</a>
		<a href="video" id="navVideo" ref="">Video</a>
		<a href="music" id="navMusic" ref="">Music</a>
		<a href="article" id="navArticle" ref="">Article</a>
		<div style="clear: both;"></div>
	</div>
	<script>
        $('#contentNav a').click(function(){
            $('#contentNav a').each(function(){
                $('#'+$(this).attr('href')).css('display', 'none')
                $(this).removeClass('selected');
            })
            $('#'+$(this).attr('href')).css('display', 'block')
            $(this).addClass('selected');
            return false;
        })
    </script>
	<div id="upload">
		<form action="" method="POST" enctype="multipart/form-data">
			<div>
				<h4>Name</h4>
				<input type="text" name="content[name]" value="<?php echo $upload['name']; ?>" class="title"/>
			</div>
			<div>
				<h4>Description</h4>
				<textarea name="content[description]"><?php echo $upload['description']; ?></textarea>
			</div>
			<div>
				<h4>File</h4>
				<input type="file" name="file"/>
			</div>
			<input type="hidden" name="content[user_id]" value="<?php echo $this->id; ?>"/>
			<input type="hidden" name="content[type]" value="image"/>
			<input type="submit" name="submit" value="Upload" class="submit"/>
		</form>
	</div>
	<div id="video">
		<form action="" method="POST">
			<div>
				<h4>Name</h4>
				<input type="text" name="content[name]" value="<?php echo $video['name']; ?>" class="title"/>
			</div>
			<div>
				<h4>Description</h4>
				<textarea name="content[description]"><?php echo $video['description']; ?></textarea>
			</div>
			<div>
				<h4>Video (place youtube url here)</h4>
				<textarea name="content[data]"><?php echo $video['data']; ?></textarea>
			</div>
			<input type="hidden" name="content[user_id]" value="<?php echo $this->id; ?>"/>
			<input type="hidden" name="content[type]" value="video"/>
			<input type="submit" name="submit" value="Submit Video" class="submit"/>
		</form>
	</div>
	<div id="music">
		<form action="" method="POST" enctype="multipart/form-data">
			<div>
				<h4>Name</h4>
				<input type="text" name="content[name]" value="<?php echo $upload['name']; ?>" class="title"/>
			</div>
			<div>
				<h4>Description</h4>
				<textarea name="content[description]"><?php echo $upload['description']; ?></textarea>
			</div>
			<div>
				<h4>File</h4>
				<input type="file" name="file"/>
			</div>
			<input type="hidden" name="content[user_id]" value="<?php echo $this->id; ?>"/>
			<input type="hidden" name="content[type]" value="music"/>
			<input type="submit" name="submit" value="Upload" class="submit"/>
		</form>
	</div>
	<div id="article">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <h4>Name</h4>
                <input type="text" name="content[name]" value="<?php echo $upload['name']; ?>" class="title"/>
            </div>
            <div>
                <h4>Description</h4>
                <textarea name="content[description]" style="width: 100%; height: 200px;"><?php echo $upload['description']; ?></textarea>
            </div>
            <input type="hidden" name="content[user_id]" value="<?php echo $this->id; ?>"/>
            <input type="hidden" name="content[type]" value="article"/>
            <input type="submit" name="submit" value="Submit" class="submit"/>
        </form>
    </div>
</div>
<?php } ?>
<div style="clear: both;">
    <div id="userContentHolder">
    <?php foreach($this->info['content'] as $c){ ?>
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
</div>