<div class="signup">
	<h3>Sign up</h3>
	<?php echo form_open('', 'method="post" id="signup_form" name="signup_form"')?>
	<div class="form-group">
		<label for="username" class="control-label">Username</label>
		<input type="text" name="username" id="username" class="form-control"
			value="<?php echo set_value('username')?>" placeholder="username" />
			<?php echo form_error('username','<span class="text-danger">','</span>')?>
	</div>


	<div class="form-group">
		<label for="password" class="control-label">Password</label>

		<input type="password" name="password" id="password"
			class="form-control" placeholder="password" />
			<?php echo form_error('password','<span class="text-danger">','</span>')?>
	</div>


	<div class="form-group">
		<label for="password1" class="control-label">Password</label>

		<input type="password" name="password1" id="password1"
			class="form-control" placeholder="password once more" />
			<?php echo form_error('password1','<span class="text-danger">','</span>')?></div>


	<div class="form-group">
		<label for="email" class="control-label">Email</label> <input
			type="text" name="email" id="email" class="form-control"
			value="<?php echo set_value('email'); ?>" placeholder="email" />
			<?php echo form_error('email','<span class="text-danger">','</span>')?>
	</div>

	<div class="form-group">
		<?php echo form_hidden('redirect_uri', $redirect_uri);?>

			<button type="submit" class="btn btn-primary">Sign up</button>

	</div>
	<?php echo form_close();?>
</div>