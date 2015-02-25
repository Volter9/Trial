<?php 

/**
 * Recursive comments view
 * 
 * @var array $comments
 */

?>

<ul class="comments">
<?php foreach ($comments as $comment): ?> 
	<li>
		<div class="comment">
			<p class="header">
				<?php echo $comment['username'] ?> 
				
				<small>
					<?php echo $this->lang('published') ?> 
					<?php echo date('Y.m.d', strtotime($comment['date'])) ?> 
				</small>
			</p>
			
			<p>
				<?php echo nl2br($comment['text']) ?> 
			</p>
		</div>
		
		<?php if (isset($comment['sub'])): ?> 
<?php 
	$this->partial('blocks/comments/comments', [
		'comments' => $comment['sub']
	]) 
?> 
		<?php endif; ?> 
	</li>
<?php endforeach; ?> 
</ul>
