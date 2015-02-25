<div class="container">
	<h1>
		<?php echo $user->username ?>
	</h1>
	
	<?php if ($pages): ?> 
	<h3>
		<?php echo $this->lang('users.pages') ?>
	</h3>
	
	<ul>
		<?php foreach ($pages as $page): ?> 
		<li>
			<a href="<?php echo $this->route('page', $page['id']) ?>">
				"<?php echo $page['title'] ?>" 
			</a>
			<?php echo $this->lang('published') ?> 
			<?php echo date('Y.m.d', strtotime($page['date'])) ?> 
		</li>
		<?php endforeach; ?> 
	</ul>
	<?php endif; ?>
	
	<footer>
		<?php echo $user->username ?> 
		<?php echo $this->lang('users.registered') ?> 
		<?php echo date('Y.m.d', strtotime($user->registered_at)) ?> 
	</footer>
</div>

<?php 
	$this->partial('blocks/comments/tree', [
		'header' => $this->lang('users.comments'), 
		'title' => $user->username
	]) 
?>