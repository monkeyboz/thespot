<link rel="stylesheet" href="./css/events.css"></script>
<div id="eventHolder">
<?php foreach($this->info as $data){ ?>
    <div class="event">
        <?php $json = json_decode($data['data']) ?>
        <h2><a href="?page=user/showEvent/<?php echo $data['content_id']; ?>"><?php echo $data['name']; ?></a></h2>
        <div class="info">
            <strong>Date:</strong> <?php echo date('D M d, Y', strtotime($json->date)); ?>
            <strong>City:</strong> <a href="?page=categories/city/<?php echo $json->city; ?>"><?php echo $json->city; ?></a> 
            <strong>Place:</strong> <a href="?page=categories/venue/<?php echo $json->placeName; ?>"><?php echo $json->placeName; ?></a>
        </div>
        <div style="background: #000; padding: 5px; color: #fff; margin-top: 5px;">
        Starring: 
        <?php foreach($json->users as $u){ ?>
            <a href="?page=user/display/<?php echo $u; ?>"><?php echo $u; ?></a>, 
        <?php } ?>
        </div>
    </div>
<?php } ?>
</div>