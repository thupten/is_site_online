<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo site_url('site/index')?>">Mysite.com</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo site_url('site/about')?>">About</a></li>
			</ul>
			<div id="login"><?php
	 			echo Modules::run('user/dashboard');
			?></div>
		</div>
	</div>
</nav>
<div id="main">
	<!--  start of main -->