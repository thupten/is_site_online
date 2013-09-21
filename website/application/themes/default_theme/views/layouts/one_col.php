<?php doctype('html5');?>
<html>
<head>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css"
	rel="stylesheet" />

<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet" />

<link href="<?php echo base_url();?>assets/css/styles.css"
	rel="stylesheet" />


<script type="text/javascript"
	src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
	<?php echo $template['title']?>
</title>
</head>
<body>
<?php
echo $template ['partials'] ['header'];
echo ($this->session->flashdata('message'))? "<div class=\"alert alert-info\">".$this->session->flashdata('message')."</div>":"";
echo $template ['body'];
echo $template ['partials'] ['footer'];
