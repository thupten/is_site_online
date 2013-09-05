<div class="nav-bar pull-right">
<p class="navbar-text">User: <?php echo $this->session->userdata('logged_in_user');?></p>
<?php echo anchor('member/logout','Logout',array('class'=>'btn navbar-btn btn-success btn-sm'));?>
</div>