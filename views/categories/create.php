<?php $info = $this->info[0]; ?>
<?php $link = '?page=categories/create'; 
    if($this->id != null){
        $link .= '/'.$this->id;
    }
?>
<div style="padding: 10px;">
    <form action="<?php echo $link; ?>" method="POST">
    <div>
        <div>Name</div>
        <input type="text" name="categories[name]" value="<?php echo $info['name']; ?>"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Create Category"/>
    </div>
    </form>
</div>
