<div class="login_form_module">
	<?php echo validation_errors();?>
	<form id="login_form" name="login_form" method="post">
		<div class="form-group">
			<label for="username">Username</label> <input type="text"
				name="username" id="username" class="form-control"
				value="<?php echo set_value('username')?>"
				placeholder="your@email.account" />
		</div>
		<div class="form-group">
			<label for="password">Password</label> <input type="password"
				name="password" id="password" class="form-control"
				placeholder="password" />
		</div>
		<button type="submit" class="btn btn-success" id="signin_btn">Sign in</button>
	</form>
	<p class="text-danger"><?php echo $this->session->flashdata('login_message')?></p>

	<div class="col-md-6">
		<a class="" href="<?php echo site_url('user/forgot_credentials')?>">Forgot
			credentials</a><br />
	</div>
	<div class="col-md-6">
		New user? <a class="" href="<?php echo site_url('user/signup')?>">Sign
			up</a>
	</div>

</div>