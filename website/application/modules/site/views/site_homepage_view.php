<div class="homepage">
	<div class="jumbotron">
		<div class="container">
			<h1>Your site is important</h1>
			<p class="lead">You got to know if your site is down. We will keep an
				eye on it for you.</p>
			<p>
				<a href="<?php echo site_url('site/about')?>"
					class="btn btn-primary btn-lg">Learn more&nbsp; <i
					class="icon-angle-right"></i></a>
			</p>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div id="box1" class="frontpage-box">
					<h3>Features for members</h3>
					<ul class="list-unstyled">
						<li><i class="icon-circle-arrow-right icon-large"></i> 100 % free
							service</li>
						<li><i class="icon-circle-arrow-right icon-large"></i> Create list
							of websites you want to check daily</li>
						<li><i class="icon-circle-arrow-right icon-large"></i> Get
							automated alert by email if your site is down</li>
						<li><i class="icon-circle-arrow-right icon-large"></i> <a
							href="<?php echo site_url('site/signup')?>">Signup now</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="frontpage-box">
				<?php echo $template['partials']['box2']?></div>
			</div>

			<div class="col-md-4">
				<div class="frontpage-box">
					<div class="quick_check_container">
						<?php echo $template['partials']['box3'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>