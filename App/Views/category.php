<p class="description">
	<?php echo $category->description ?> 
</p>

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
			<?php echo $this->lang('published') ?> 
			<?php echo $page['user'] ?> 
			<?php echo date('Y.m.d', strtotime($page['date'])) ?> <br/>
			<?php echo $this->lang('categories.one') ?> 
			<a href="<?php echo $this->route('category', $page['category_id']) ?>">
				<?php echo $page['category'] ?> 
			</a>
		</p>
	</li>
<?php endforeach; ?> 
</ul>
<?php else: ?> 
<div class="container">
	<h2>
		<?php echo $this->lang('no-pages') ?> 
	</h2>
	
	<p>
		<?php echo $this->lang('no-pages') ?> 
	</p>
</div>
<?php endif; ?> 

<?php 
	$this->partial('blocks/comments/tree', [
		'header' => $this->lang('categories.comments'),
		'title' => $category->title
	]) 
?>