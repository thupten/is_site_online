<?php ?>
<div class="quick_check_form">
	<?php form_open('', array('class'=>'form', 'method'=>'post'))?>
		<div class="input-group">
		<input type="text" class="form-control" placeholder="www.google.com"
			name="url" id="url"
		/> <span class="input-group-btn">
			<button class="btn btn-primary" type="submit">Go</button>
		</span>
	</div>
	<?php echo form_error("url")?>
	</form>
</div>
