<div class="container">
	<h1>
		<?php echo $page->title ?>
	</h1>
	
	<p>
		<?php echo $page->description ?>
	</p>
	
	<p>
		<?php echo nl2br($page->text) ?>
	</p>
	
	<footer>
		<?php echo $this->lang('published') ?> 
		<?php echo $page->user->username ?>,
		<?php echo date('Y.m.d', strtotime($page->date)) ?>, 
		<?php echo $this->lang('categories.one') ?> 
		<a href="<?php echo $this->route('category', $page->category_id) ?>">
			<?php echo $page->category->title ?> 
		</a>
	</footer>
</div>

<?php 
	$this->partial('blocks/comments/tree', [
		'header' => $this->lang('pages.comments'), 
		'title' => $page->title
	]) 
?>