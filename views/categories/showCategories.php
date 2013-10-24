<div class="eventHolder">
<?php foreach($this->info as $i){ ?>
<div style="float: left; width: 45%; margin-right: 10px;">
    <h1 style="margin: 0px;"><?php echo $i['name']; ?></h1>
    <div class="expandable">
        <div style="background: #efefef; padding: 10px; color: #000; border-radius: 10px; margin-top: 10px;" class="expand">Events ( <?php echo sizeof($this->categories[$i['name']]['events']); ?> )</div>
        <div style="background: #fff; color: #ababab;" class="expand_layout">
        <?php foreach($this->categories[$i['name']]['events'] as $j){ ?>
        <?php $data = json_decode($j['data']); ?>
        <div style="padding: 10px; border-bottom: 1px solid #efefef;">
            <strong><a href="?page=user/showEvent/<?php echo $j['content_id']; ?>"><?php print_r($j['name']); ?></a></strong> - <?php echo date('F d, Y', strtotime($data->date)); ?>
        </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
</div>
<script>
    $.fn.expand = function(){
        $(this).find('.expand_layout').css('height', '0px');
        $(this).find('.expand_layout').css('overflow', 'hidden');
        $(this).find('.expand').click(function(){
            var expandLayout = $(this).parent().find('.expand_layout');
            if(expandLayout.css('height') != '0px'){
                expandLayout.animate({'height':'0px'}, 500);
            } else {
                expandLayout.animate({'height':'300px'}, 500);
            }
        })
    }
    $(document).find('.expandable').each(function(){
        $(this).expand();
    })
</script>