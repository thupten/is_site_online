<?php
$form_attr = array('class'=>'navbar-form navbar-right', 'id'=>'login_form');  
echo form_open('start/verify_login', $form_attr);
?>
	<div class="form-group">
		<input type="text" name="username" id="username" class="form-control" placeholder="your@email.account"/>
	</div>
	<div class="form-group">
			<input type="password" name="password" id="password" class="form-control" placeholder="password"/>
	</div>
	<button type="submit" class="btn btn-success" id="signin_btn">Sign in</button>
<?php echo form_close();?>