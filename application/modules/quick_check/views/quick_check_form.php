<?php ?>
<div class="quick_check_form">
	<h3>Run a quick check</h3>
	<?php form_open('', array('class'=>'form', 'method'=>'post'))?>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="www.google.com"
				name="url" id="url" /> <span class="input-group-btn">
				<?php echo form_error("url")?>
				<button class="btn btn-primary" type="submit">Go</button>
			</span>
		</div>
	</form>
</div>
