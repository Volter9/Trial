<!DOCTYPE html>
<html>
	<head>
		<?php $this->partial('blocks/head') ?>
	</head>
	
	<body>
		<header>
			<?php $this->partial('blocks/header') ?>
		</header>
		
		<article>
			<?php $this->partial('blocks/sidebar') ?>
			<?php $this->partial($view) ?>
		</article>
		
		<?php $this->partial('blocks/footer') ?>
	</body>
</html>