<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>shares/add">Share Something</a>
	<?php endif; ?>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well">
			<h3><?php echo $item['title']; ?></h3>
			<small><?php echo $item['create_date'] . ' ' . $item['user_id']; ?></small>
			<hr />
			<p><?php echo $item['body']; ?></p>
			<br />
			<img class="img-responsive" src="<?php echo $item['image']; ?>" alt="<?php echo $item['image']; ?>" /> 
			<br />
			<a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank">Go To Website</a>
		</div>
	<?php endforeach; ?>
</div>