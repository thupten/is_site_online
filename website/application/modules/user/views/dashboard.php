<ul class="nav navbar-nav pull-right">
	<?php if(isset($user)):?>
	<li><a href="to/the/preference/page"><?php echo isset($user)? $user->username:""?></a></li>
	<li><a href=<?php echo site_url('user/logout')?>>Logout</a></li>
	<?php else:?>
	<li><a href="<?php echo site_url('site/login')?>">Login</a></li>
	<li><a href="<?php echo site_url('site/signup')?>">Sign up</a></li>
	<?php endif;?>
</ul>

