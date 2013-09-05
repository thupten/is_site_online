<?php
//output in the view should be snippets, not full page
$this->load->view('header');
?>
<div class="container" id="main">
	<?php if($container_id == 'main'){
		echo $content;
	}?>
</div>

<?php $this->load->view('footer');?>