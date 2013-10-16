<ul class="nav navbar-nav pull-right">
	<?php if(isset($user)):?>
	<li><a href=<?php echo site_url('projects/index')?>>My Sites</a></li>
	<li><a href="<?php echo site_url('user/edit_profile')?>"><?php echo isset($user)? strtoupper($user->username):""?></a></li>
	<li><a href=<?php echo site_url('user/logout')?>>Logout</a></li>
	<?php else:?>
	<li><a href="<?php echo site_url('site/login')?>">Login</a></li>
	<li><a href="<?php echo site_url('site/signup')?>">Sign up</a></li>
	<?php endif;?>
</ul>

