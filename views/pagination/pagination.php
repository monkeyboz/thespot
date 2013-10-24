<style>
  .pagination{
  	clear: both;
  	height: 15px;
  }
  .pagination a{
    display: block;
    border: #efefef 1px solid;
    margin: 3px;
    float: left;
    padding: 3px;
    text-decoration: none;
    color: #000;
  }
  .pagination .selected{
    display: block;
    border: #efefef 1px solid;
    background: #000;
    color: #fff;
    margin: 3px;
    float: left;
    padding: 3px;
  }
</style>
<div id="pagination<?php echo $this->pagination['container']; ?>" class="pagination" style="clear: both;">
<?php for($pageNum = 0; $pageNum < $this->pagination['totalPages']; ++$pageNum){ ?>
  <a href="<?php echo $this->pagination['page']; ?>&pagenum=<?php echo $pageNum; ?><?php echo $this->pagination['query']; ?>" rel="<?php echo $this->pagination['query']; ?>" <?php if(isset($_GET['pagenum']) && $_GET['pagenum'] == $pageNum){ ?>class="selected"<?php }?>><?php echo ($pageNum+1); ?></a>
<?php } ?>
  <div class="bottom"></div>
</div>
<script>
  $('#pagination<?php echo $this->pagination['container']; ?> a').click(function(){
    var container = $('#<?php echo $this->pagination['container']; ?>');
    container.html('<img src="images/loading.gif" />');
    $.ajax({
      url: $(this).attr('href')+'&ajax=1',
      success: function(html){
        container.css('opacity', 0);
        container.html(html);
        container.animate({'opacity':1}, 500);
      }
    })
    return false;
  })
</script>
<script>
  $('.edit').click(function(){
    createForm($(this));
    return false;
  })
  function createForm(info){
    $.ajax({
      url: info.attr('href')+'&ajax=1',
      success: function(html){
        $('#formHolder').html(html);
        $('#formHolder').append('<div class="bottom"></div>');
        $('#overlay').css('opacity', 0).css('display','block').animate({opacity:1},500);
        $('#formShow').css('opacity', 0).css('display','block').animate({opacity:1},500);
      }
    })
  }
  $('#overlay').click(function(){
    $(this).css('display','none');
    $('#formShow').css('display','none');
    return false;
  })
  $('img').each(function(){
    if($(this).attr('src') == 'images/delete_btn.jpg'){
      $(this).addClass('delete');
      $(this).css('overlay','hidden');
    }
  })
  $('.delete').click(function(){
    $.ajax({
      url: $(this).parent().attr('href')+'?ajax=1',
      success: function(){
        
      }
    })
    $(this).parent().parent().parent().animate({height:'0px', opacity:0, padding:'0px'}, 500, function(){
      $(this).remove();
    });
    return false;
  })
</script>