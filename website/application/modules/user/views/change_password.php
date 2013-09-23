<?php echo form_open('','class="form"');?>

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
<?php echo form_close();?>