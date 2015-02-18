<aside>
	<h2>Категории</h2>
	
	<ul>
<?php foreach ($categories as $category): ?> 
		<li>
			<a href="<?php echo $this->route('category', $category['id']) ?>">
				<?php echo $category['title'] ?> 
			</a>
		</li>
<?php endforeach; ?> 
	</ul>
	
	<?php $this->partial('blocks/panel') ?> 
</aside>