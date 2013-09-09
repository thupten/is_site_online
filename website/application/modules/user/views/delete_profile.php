<div class="edit_profile">
	<p>Edit Profile</p>
	<?php echo validation_errors();?>
    	<?php echo form_open('', 'method="post" class="form" id="delete_profile_form" name="delete_profile_form"')?>
        <div class="form_group">
		<label for="username">Username:</label><?php echo $username;?> 
    	</div>

	<div class="form_group">
		<label for="password">Password</label> <input type="text"
			name="password" id="password" class="form-control"
			placeholder="current password" />
	</div>
	<input type="hidden" name="username" id="username"
		value="<?php echo $username?>" /> <input type="hidden" name="_method"
		id="_method" value="delete" />
	<button type="submit">Delete Account Permanently</button>
	<p class="text-danger">This action cannot be reversed</p>
	<?php echo form_close()?>
</div>