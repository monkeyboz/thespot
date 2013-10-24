<?php $info = $this->info; ?>
<style>
    .calendar{
        padding: 10px;
    }
    .calendar a{
        color: #000;
    }
</style>
<div class="calendar">
    <a href="?page=user/createCalendar">Create Calendar</a>
</div>
<table style="width: 820px;">
    <tr>
        <td>Name</td>
        <td>Date</td>
        <td>Place</td>
        <td>Action</td>
    </tr>
    <?php foreach($info as $i){ ?>
    <?php $json = json_decode($i['data']); ?>
    <tr>
        <td><?php echo $i['name']; ?></td>
        <td><?php echo date('M d, Y h:i:s', strtotime($json->date)); ?></td>
        <td><?php echo $json->placeName; ?></td>
        <td>
		<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $i['user_id']){ ?>
		<a href="?page=user/editCalendar/<?php echo $i['content_id']; ?>" style="color: #ababab;">Edit</a> | <a href="?page=user/deleteCalendar/<?php echo $i['content_id']; ?>" style="color: #ababab;">Delete</a>
		<?php } ?></td>
    </tr>
    <?php } ?>
</table>