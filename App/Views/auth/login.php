<div class="container">
	<h1>
		<?php echo $this->lang('auth.login') ?> 
	</h1>
	
	<?php if (is_array($errors)): ?> 
		<div class="errors">
			<h3>
				<?php echo $this->lang('auth.errors') ?>:
			</h3>
			
		<?php foreach ($errors as $error): ?> 
			<?php echo $error[0] ?><br/>
		<?php endforeach; ?> 
		</div>
	<?php endif; ?> 
	
	<form class="form" method="post">
		<label>
			<?php echo $this->lang('auth.fields.username') ?>:
			<input name="username" placeholder="<?php echo $this->lang('auth.fields.username') ?>" type="text"/>
		</label>
		
		<label>
			<?php echo $this->lang('auth.fields.password') ?>:
			<input name="password" placeholder="<?php echo $this->lang('auth.fields.password') ?>" type="password"/>
		</label>
		
		<button>
			<?php echo $this->lang('auth.submit') ?> 
		</button>
	</form>
</div>