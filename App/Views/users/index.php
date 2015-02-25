<div class="users">
	<ul>
	<?php foreach ($users as $user): ?> 
		<li>
			<a href="<?php echo $this->route('user', $user['id']) ?>">
				<?php echo $user['username'] ?> 
			</a>
			
			<span class="right">
				<?php echo $this->lang('users.group') ?>: 
				<?php echo $user['title'] ?>, 
				<?php echo $this->lang('users.registered') ?>: 
				<?php echo date('Y.m.d', strtotime($user['registered_at'])) ?> 
			</span>
		</li>
	<?php endforeach; ?> 
	</ul>
</div>