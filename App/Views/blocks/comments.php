<?php 

/**
 * Recursive comments view
 * 
 * @var array $comments
 */

?>

<ul>
<?php foreach ($comments as $comment): ?> 
	<li>
		<?php echo $comment['text'] ?>
		
		<?php if (isset($comment['sub'])): ?> 
<?php 
	$this->partial('blocks/comments', [
		'comments' => $comment['sub']
	]) 
?> 
		<?php endif; ?> 
	</li>
<?php endforeach; ?> 
</ul>
