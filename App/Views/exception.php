<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $title ?> 
		</title>
	</head>
	
	<body>
		<h1>
			<?php echo $title ?> 
		</h1>
		
		<p>
			<?php echo $this->lang('exception.something-wrong') ?>
			<?php var_dump($exception) ?> 
		</p>
	</body>
</html>