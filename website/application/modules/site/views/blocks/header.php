<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo site_url('site/index')?>">veryusefulinfo.com</a>
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
