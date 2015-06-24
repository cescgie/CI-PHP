<body>
	<div class="content">
		<h1>Simple CRUD Application</h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php echo anchor('person/add/','add new data',array('class'=>'add')); ?>
	</div>
</body>
</html>