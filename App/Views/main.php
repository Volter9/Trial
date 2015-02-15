<!DOCTYPE html>
<html>
	<head>
		<?php $this->renderPartial('blocks/head') ?>
	</head>
	
	<body>
		<header>
			<?php $this->renderPartial('blocks/header') ?>
		</header>
		
		<article>
			<?php $this->renderPartial('blocks/sidebar') ?>
			<?php $this->renderPartial($view) ?>
		</article>
		
		<?php $this->renderPartial('blocks/footer') ?>
	</body>
</html>