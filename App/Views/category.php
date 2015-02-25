<p>
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
<p class="no-pages">
	<?php echo $this->lang('no-pages') ?> 
</p>
<?php endif; ?> 

<section id="comments">
	<h3>
		<?php printf($this->lang('categories.comments'), $category->title) ?> 
	</h3>
	
	<?php if ($comments): ?> 
<?php $this->partial('blocks/comments') ?> 
	<?php else: ?> 
	<p>
		<?php printf($this->lang('comments.empty'), $category->title) ?> 
	</p>
	<?php endif; ?> 
</div>