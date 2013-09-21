<div class="login_form_block">
<?php echo validation_errors();?>
	<div class="row">
		<div class="col-md-4">
			<?php echo form_open('', array('id' => 'login_form'));?>
			<div class="form-group">
				<label for="username">Username</label> <input type="text"
					name="username" id="username" class="form-control"
					placeholder="your@email.account" />
			</div>
			<div class="form-group">
				<label for="password">Password</label> <input type="password"
					name="password" id="password" class="form-control"
					placeholder="password" />
			</div>
			<div class="form-group">
				<?php echo (isset($redirect_uri))?form_hidden('redirect_uri', $redirect_uri):"";?>
				<button type="submit" class="btn btn-success" id="signin_btn">Sign
					in</button>
			</div>
			<?php echo form_close();?>
			<p class="text-danger"><?php echo $this->session->flashdata('login_message')?></p>
			<div class="row">
				<div class="col-md-7">
					Forgot credentials? <a class=""
						href="<?php echo site_url('user/forgot_credentials')?>">click here</a><br />
				</div>
				<div class="col-md-5">
					New user? <a class="" href="<?php echo site_url('site/signup');?>">Sign
						up</a>
				</div>
			</div>

		</div>
	</div>
</div>