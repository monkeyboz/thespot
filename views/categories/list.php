<?php $info = $this->info; ?>
<div class="adminNav">
    <a href="?page=categories/create">Create Categories</a>
</div>
<table class="adminTable">
    <tr>
        <th>Name</th>
        <th>Id</th>
        <th>Action</th>
    </tr>
<?php foreach($info as $i){ ?>
    <?php $id = $i['id']; ?>
    <tr>
        <td><?php echo $i['name']; ?></td>
        <td><?php echo $i['id']; ?></td>
        <td>
            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $i['user_id']){ ?><a href="?page=categories/edit/<?php echo $id; ?>">Edit</a> | 
            <a href="?page=categories/delete/<?php echo $id; ?>">Delete</a>
			<?php } ?>
        </td>
    </tr>
<?php } ?>
</table>