<!DOCTYPE html>
<html>
	<head>
	<!-- @begin HTML голова -->
<?php $this->partial('blocks/head') ?> 
	<!-- @end HTML голова -->
	</head>
	
	<body>
		<header>
		<!-- @begin Шапка -->
<?php $this->partial('blocks/header') ?> 
		<!-- @end Шапка -->
		</header>
		
		<article>
		<!-- @begin Сайдбар -->
<?php $this->partial('blocks/sidebar') ?> 
		<!-- @end Сайдбар -->
			<section class="pages">
				<h1><?php echo $title ?></h1>
				<!-- @begin Главный вид (<?php echo $view ?>) -->
<?php $this->partial($view) ?> 
				<!-- @end Главный вид -->
			</section>
		</article>

<!-- @begin Подвал -->
<?php $this->partial('blocks/footer') ?> 
<!-- @end Подвал -->
	</body>
</html>