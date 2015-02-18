<?php if (isset($pages)): ?> 
<ul class="pages">
<?php foreach ($pages as $page): ?> 
	<li>
		<h2>
			<a href="<?php echo $this->route('page', $page['id']) ?>">
				<?php echo $page['title'] ?> 
			</a>
		</h2>
		
		<p>
			<?php echo $page['description'] ?> 
		</p>
		
		<p class="info">
			Опублиовал <?php echo $page['user_id'] ?> |
			<?php echo date('Y.m.d', strtotime($page['date'])) ?> |
			Категория <?php echo $page['category_id'] ?> 
		</p>
	</li>
<?php endforeach; ?> 
</ul>
<?php else: ?> 
<p class="no-pages">Страницы не были найдены!</p>
<?php endif; ?> 