<?php $info = $this->info; ?>
<?php 
if($this->type == 'edit'){
    $link = '?page=user/editComment/'.$info['comments_id'];
} else {
    $link = '?page=user/addComment/'.$info['content_type'].'/'.$info['content_id'];
} ?>
<form action="<?php echo $link; ?>" method="POST">
	<div>
		<h4>Add Comment</h4>
		<textarea name="comment[description]" style="height: 100px; width: 97%; margin-bottom: 10px;"><?php echo $info['description']; ?></textarea>
		<input type="hidden" name="comment[user_id]" value="<?php echo $_SESSION['user_id']; ?>"/>
		<input type="hidden" name="comment[content_id]" value="<?php echo $info['content_id']; ?>"/>
		<input type="hidden" name="comment[content_type]" value="<?php echo $info['content_type']; ?>"/>
	</div>
	<input type="submit" value="Submit Comment" name="submit" class="comment<?php echo $info['content_type']; ?>"/>
</form>
<script>
    $('.comment<?php echo $info['content_type']; ?>').click(function(){
        var ajaxCommentHolder = $(this);
        var data = '';
        var type = '<?php echo $this->type; ?>';
        
        ajaxCommentHolder.parent().find('input').each(function(){
            data += $(this).attr('name')+'='+$(this).val()+'&';
        })
        data += 'comment[description]='+ajaxCommentHolder.parent().find('textarea').val()+'&';
        
        $.ajax({
            url: '<?php echo $link; ?>&ajax=1',
            data: data,
            type: 'POST',
            success: function(html){
                if(type == 'edit'){
                    ajaxCommentHolder.parent().parent().parent().find('.editHolder').html(html);
                } else {
                    $('.comment_holder').html(html);
                }
            }
        })
        return false;
    });
</script>