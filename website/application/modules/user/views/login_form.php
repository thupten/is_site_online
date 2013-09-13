<div class="login_form_module nav navbar-right">
	<?php echo form_open('',array('id'=>'login_form', 'name'=>'login_form', 'class'=>'navbar-form'))?>
		<div class="form-group">
		<input type="text" name="username" id="username" class="form-control"
			value="<?php echo set_value('username')?>"
			placeholder="your@email.account" /><?php echo form_error('password', '<span class="error text-danger">', '</span>'); ?>
	</div>
	<div class="form-group">
		<input type="password" name="password" id="password"
			class="form-control" placeholder="password" /><?php echo form_error('password', '<span class="error text-danger">', '</span>'); ?>
	</div>
	<?php
	if ($redirect_url != ""){
		echo form_hidden('redirect_url', $redirect_url);
	}
	?>
	<button type="submit" class="btn btn-success" id="signin_btn">Sign in</button>
	<span class="text-danger"><?php echo (isset($error->error_message)) ? $user->error_message:""?></span>
	<?php echo form_close()?>
	<div class="pull-right">
		<a class="" href="<?php echo site_url('user/forgot_credentials')?>">Forgot
			credentials</a>&nbsp;&nbsp;&nbsp;&nbsp;New user? <a class=""
			href="<?php echo site_url('user/signup')?>">Sign up</a>
	</div>
</div>