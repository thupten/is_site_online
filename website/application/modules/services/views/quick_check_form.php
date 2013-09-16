<h3>Run a Quick Check</h3>
<div class="quick_check_form">
	<?php echo form_open('services/get_run_quick_check_form', array('class'=>'quick_check_form', 'method'=>'post'))?>
		<div class="input-group">
		<input type="text" class="form-control" placeholder="www.google.com"
			name="url" id="url" /> <span class="input-group-btn">
			<button class="btn btn-primary" type="submit">Go</button>
		</span>
	</div>
	<?php echo form_error("url")?>
	<?php echo form_close();?>
</div>
