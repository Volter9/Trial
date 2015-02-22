<?php if (isset($pages) && $pages): ?> 
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
			Опубликовал <?php echo $page['user'] ?> 
			<?php echo date('Y.m.d', strtotime($page['date'])) ?> <br/>
			Категория 
			<a href="<?php echo $this->route('category', $page['category_id']) ?>">
				<?php echo $page['category'] ?> 
			</a>
		</p>
	</li>
<?php endforeach; ?> 
</ul>
<?php else: ?> 
<p class="no-pages">Страницы не были найдены!</p>
<?php endif; ?> 