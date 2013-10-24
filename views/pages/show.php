<?php $info = $this->info[0]; ?>
<h1 style="text-transform: uppercase;"><?php echo $info['name']; ?></h1>
<div style="background: #fff; padding: 20px;">
<?php echo htmlspecialchars_decode($info['description']); ?>
</div>