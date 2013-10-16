<div class="edit_profile container">
<?php //var_dump($user);?>
	<h3>Edit Profile</h3>
	<?php echo validation_errors();?>
	<?php echo form_open('', 'method="post" class="form-horizontal" id="edit_profile_form" name="edit_profile_form"')?>
	<div class="form-group">
		<label class="col-lg-2 control-label" for="username">Username</label>
		<div class="col-lg-10">
			<div id="username"><?php echo $user->username;?></div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-2 control-label" for="change_password">Password</label>
		<a class="col-lg-10" id="change_password"
			href="<?php echo site_url('user/change_password');?>">Change password</a>
	</div>


	<div class="form-group">
		<label class="col-lg-2 control-label" for="email">Email</label>
		<div class="col-lg-3 ">
			<input class="form-control" type="text" name="email" id="email"
				value="<?php echo $user->email; ?>" placeholder="email" />
			<?php echo form_error('email')?></div>
	</div>

	<div class="col-lg-offset-2 col-lg-10">
		<div class="checkbox">
			<label><?php echo form_checkbox('email_alert','1',$user->preference->send_alert);?>Send
				me alerts by email</label>
		</div>
	</div>
	<div class="col-lg-offset-2 col-lg-10">
		<div class="checkbox">
			<label><?php echo form_checkbox('email_promo','1',$user->preference->send_promo);?>Send
				me promotions, tips and news</label>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-5">
			<input type="hidden" name="_method" id="_method" value="put" />
			<button type="submit" class="btn btn-primary">Update</button>
		</div>
	</div>
	<?php echo form_close()?>
</div>