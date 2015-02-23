<?php 

/**
 * Main template
 * 
 * @var string $view
 */ 
 
?>
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

			<section class="pages">
				<h1><?php echo $title ?></h1>
				
<?php $this->partial($view) ?> 
			</section>
		</article>

<?php $this->partial('blocks/footer') ?> 
	</body>
</html>