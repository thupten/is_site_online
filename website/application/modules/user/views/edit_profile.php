<div class="edit_profile">
	<p>Edit Profile</p>
	<?php echo validation_errors();?>
	<?php echo form_open('', 'method="post" class="form" id="edit_profile_form" name="edit_profile_form"')?>
		<div class="form_group">
		<label for="username">Username:</label><?php echo $username;?> 
	</div>

	<div class="form_group">
		<label for="password">Password</label> <input type="text"
			name="password" id="password" class="form-control"
			placeholder="current password" />
	</div>

	<div class="form_group">
		<label for="new_password">New Password</label> <input type="text"
			name="new_password" id="new_password" class="form-control"
			placeholder="new password" />
		<p>Leave empty if you don't want to change password</p>
	</div>

	<div class="form_group">
		<label for="email">Email</label> <input type="text" name="email"
			id="email" class="form-control"
			value="<?php echo set_value('email'); ?>" placeholder="email" />
			<?php echo form_error('email')?>
	   </div>

	<div class="form_group">
		<input type="hidden" name="username" id="username"
			value="<?php echo (isset($username))?$username:""?>" /> <input
			type="hidden" name="_method" id="_method" value="put" />
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
	<?php echo form_close()?>
	
	
</div>