<div class="container">

<?php echo form_open('','class="form-horizontal"');?>
	<div class="form-group">
		<label for="username" class="col-lg-2 contol-label">Username</label>
		<div class="col-lg-3">
			<input type="text" name="username" id="username" class="form-control"
				placeholder="username"
				value="<?php echo isset($user)?$user->username:''?>" />
				<?php echo form_error('username','<p class="text-danger">','</p>')?>
		</div>

	</div>
	<div class="form-group">
		<label for="old_password" class="col-lg-2 contol-label">Old password</label>
		<div class="col-lg-3">
			<input type="password" name="old_password" id="old_password"
				class="form-control" placeholder="old password" />
					<?php echo form_error('old_password','<p class="text-danger">','</p>')?>
			</div>
	</div>
	<div class="form-group">
		<label for="new_password" class="col-lg-2 contol-label">New password</label>
		<div class="col-lg-3">
			<input type="password" name="new_password" id="new_password"
				class="form-control" placeholder="new password" /><?php echo form_error('new_password','<p class="text-danger">','</p>')?>
			</div>
	</div>

	<div class="form-group">
		<label for="new_password1" class="col-lg-2 contol-label">Confirm new
			password Again</label>
		<div class="col-lg-3">
			<input type="password" name="new_password1" id="new_password1"
				class="form-control" placeholder="new password" />
					<?php echo form_error('new_password1','<p class="text-danger">','</p>')?>
			</div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 col-lg-offset-2">
			<input type="submit" class="btn btn-danger" value="Change password" />
		</div>
	</div>
<?php echo form_close();?>
</div>