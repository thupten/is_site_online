<h3>Run a Quick Check</h3>
<p>Check if a website is down or not</p>
<div class="quick_check_form">
	<?php echo form_open('', array('class'=>'quick_check_form', 'method'=>'post'))?>
		<div class="input-group">
		<input type="text" class="form-control" placeholder="www.google.com"
			name="url" id="url" /> <span class="input-group-btn">
			<button id="quick_check_submit_button" class="btn btn-primary"
				type="submit">Go</button>
		</span>
	</div>
	<?php echo form_error("url")?>
	<?php echo form_close();?>
</div>
<div class="quick_check_result">
	<p><?php echo $this->session->userdata('check_status');?></p>
	<ul class="list-unstyled">
	<?php
	if (isset($rows)):
		foreach($rows as $row):
			$icon_code = "";
			if ($row->status > 0 && $row->status <= 399){
				// good
				$icon_code = '<span class="icon-thumbs-up" title="site is working good"></span>';
			} else{
				// server error
				$icon_code = '<span class="icon-thumbs-down" title="site is down"></span>';
			}
			?>
		<li><?php echo $row->url."&nbsp;&nbsp;&nbsp;".$icon_code;?></li>
	<?php endforeach;?>
	<?php endif;?>
	</ul>
</div>