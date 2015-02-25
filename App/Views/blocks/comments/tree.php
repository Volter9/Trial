<section id="comments">
	<h3>
		<?php printf($header, $title) ?> 
	</h3>
	
	<?php if ($comments): ?> 
<?php 
	$this->partial('blocks/comments/comments', [
		'comments' => $comments
	]) 
?> 
	<?php else: ?> 
	<p class="no-comments">
		<?php printf($this->lang('comments.empty'), $title) ?> 
	</p>
	<?php endif; ?> 
</div>