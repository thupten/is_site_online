<?php
$this->load->view ( 'header', array (
		'title' => 'login' 
) );?>
<div class="login-box">
<?php if (isset ( $error_msg )) {
	$this->load->view ( 'log_in_block', array (
			'error_msg',
			$error_msg 
	) );
} else {
	$this->load->view ( 'log_in_block' );
}
?>
</div>
<?php $this->load->view ( 'footer' );?>

