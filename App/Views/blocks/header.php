<div class="left">
	<h1>
		<a href="<?php echo $this->route('home') ?>">
			<?php echo $this->lang('website') ?> 
		</a>
	</h1>
</div>

<div class="right">
	<ul>
		<li>
			<a href="<?php echo $this->route('users') ?>">
				<?php echo $this->lang('users.all') ?> 
			</a>
		</li>
		<li>
			<a href="<?php echo $this->route('pages') ?>">
				<?php echo $this->lang('pages.all') ?> 
			</a>
		</li>
		<li>
			<a href="#">
				<?php echo $this->lang('auth.login') ?> 
			</a>
		</li>
	</ul>
</div>