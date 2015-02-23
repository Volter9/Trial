<ul>
<?php foreach ($categories as $category): ?> 
	<li>
		<a href="<?php echo $this->route('category', $category['id']) ?>">
			<?php echo $category['title'] ?> 
		</a>
		<?php if (isset($category['sub'])): ?> 
<?php 
	$this->partial('blocks/categories', [
		'categories' => $category['sub']
	]) 
?> 
		<?php endif; ?> 
	</li>
<?php endforeach; ?> 
</ul>
