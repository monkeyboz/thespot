<?php $content = $this->content[0]; $data = json_decode($content['data']); ?>
<link rel="stylesheet" href="./css/events.css"></script>
<div class="eventHolder">
    <h2 style="margin: 10px;"><?php echo $content['name']; ?></h2>
    <div><?php if(isset($_SESSION['user_id'])){ 
            if($this->checkRelations($content['content_id'], 'event')){ ?>
            <a href="?page=user/addEvent/<?php echo $content['content_id']; ?>" style="background: #000; padding: 5px;">Add Event</a>
        <?php } } else { ?>
            <a href="?page=user/signup" style="background: #000; padding: 5px;">Add Event</a>
        <?php } ?>
    </div>
    <div class="featuring">Featuring 
        <?php foreach($this->users as $user){ ?>
            <a href="?page=user/display/<?php echo $user; ?>"><?php echo $user; ?></a>
        <?php } ?>
    </div>
    <div style="margin-bottom: 10px; background: #000; padding: 10px; color: #fff;"
        <strong>Date:</strong> <?php echo date('Y-m-d h:i:s', strtotime($data->date)); ?> | 
        <strong>City:</strong> <a href="?page=categories/city/<?php echo $data->city; ?>"><?php echo $data->city; ?></a> | 
        <strong>Venue:</strong> <a href="?page=categories/venue/<?php echo $data->placeName; ?>"><?php echo $data->placeName; ?></a>
    </div>
    <div style="margin-bottom: 10px; padding: 10px;"><?php echo $content['description']; ?></div>
</div>