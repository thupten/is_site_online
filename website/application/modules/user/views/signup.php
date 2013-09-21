<div class="signup">
	<p>Sign up</p>
	<?php echo form_open('', 'method="post" class="form" id="signup_form" name="signup_form"')?>
		<div class="form_group">
		<label for="username">Username</label> <input type="text"
			name="username" id="username" class="form-control"
			value="<?php echo set_value('username')?>" placeholder="username" />
			<?php echo form_error('username','<span class="text-danger">','</span>')?>
	</div>

	<div class="form_group">
		<label for="password">Password</label> <input type="password"
			name="password" id="password" class="form-control"
			placeholder="password" />
			<?php echo form_error('password','<span class="text-danger">','</span>')?>
	</div>

	<div class="form_group">
		<label for="password1">Password</label> <input type="password"
			name="password1" id="password1" class="form-control"
			placeholder="password once more" />
			<?php echo form_error('password1','<span class="text-danger">','</span>')?>
	</div>

	<div class="form_group">
		<label for="email">Email</label> <input type="text" name="email"
			id="email" class="form-control"
			value="<?php echo set_value('email'); ?>" placeholder="email" />
			<?php echo form_error('email','<span class="text-danger">','</span>')?>
	</div>

	<div class="form_group">
		<?php echo form_hidden('redirect_uri', $redirect_uri);?>
		<button type="submit" class="btn btn-primary">Sign up</button>
	</div>
	<?php echo form_close();?>
</div>