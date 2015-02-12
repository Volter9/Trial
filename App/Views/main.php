<!DOCTYPE html>
<html>
	<head>
		<?php $this->renderPartial('blocks/head') ?>
	</head>
	
	<body>
		<article>
			<?php $this->renderPartial('blocks/sidebar') ?>
			<?php $this->renderPartial($view) ?>
		</article>
		
		<?php $this->renderPartial('blocks/footer') ?>
	</body>
</html>