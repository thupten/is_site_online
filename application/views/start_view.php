<?php $this->load->view('header', array('title' => 'homepage', 'show_login'=>true));?>
<div id="main">
	<div class="jumbotron">
		<div class="container">
			<h1>Your site is important</h1>
			<p class="lead">You got to know if your site is down. We will keep an
				eye on it for you.</p>
			<p>
				<a href="#" class="btn btn-primary btn-lg">Learn more&nbsp; <i
					class="icon-angle-right"
				></i></a>
			</p>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3>Features</h3>
				<ul class="list-unstyled">
					<li><i class="icon-circle-arrow-right icon-large"></i> Cool feature
						one</li>
					<li><i class="icon-circle-arrow-right icon-large"></i> Super
						feature two</li>
					<li><i class="icon-circle-arrow-right icon-large"></i> Hands down
						feature three</li>
				</ul>
			</div>

			<div class="col-md-4">
				<?php echo $recently_checked_sites_module_snippet;?>
			</div>

			<div class="col-md-4">
				<?php echo $run_a_quick_check_form;?>
			</div>
		</div>
		<div class="row">
			<h3>25 most checked websites</h3>
			<ul class="list-inline">
				<?php
				$websites = array (
						1,
						2,
						3,
						4,
						5,
						1,
						2,
						3,
						4,
						5,
						1,
						2,
						3,
						4,
						5,
						1,
						2,
						3,
						4,
						5,
						1,
						2,
						3,
						4,
						5 
				);
				foreach ( $websites as $website ) {
					echo "<li><a href=\"#\">www.google.com</a> <i class=\"icon-thumbs-up online\"></i></li>";
				}
				?>
			</ul>
		</div>
	</div>
</div>
<?php $this->load->view('footer');?>
