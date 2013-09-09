<?php doctype('html5');?>
<html>
<head>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css"
	rel="stylesheet"
/>

<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet"
/>

<link
	href="<?php echo base_url();?>assets/css/styles.css"
	rel="stylesheet"
/>


<script type="text/javascript"
	src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"
></script>
<script type="text/javascript"
	src="<?php echo base_url();?>assets/js/bootstrap.min.js"
></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
	<?php if(isset($title)):echo $title;endif;?>
</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('start')?>">Mysite.com</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo site_url('member/index')?>">Home</a></li>
					<li><a href="<?php echo site_url('start/about')?>">About</a></li>
					<li><a href="<?php echo site_url('start/contact')?>">Contact</a></li>
				</ul>
				<div id="login"><?php echo Modules::run('user/login');?></div>
			</div>
		</div>
	</nav>
	<div id="main">
		<!--  start of main -->