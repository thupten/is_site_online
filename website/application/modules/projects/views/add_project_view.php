<?php echo form_open("", array('id'=>'new_project_form', 'name'=>'new_project_form','class'=>'form'));?>
<div class="modal-body">
	<div class="form-group">
		<label for="name"> Project Name</label> <input maxlength="30"
			type="text" class="form-control" placeholder="Project Name"
			name="name" id="name" value="<?php echo set_value('name');?>" />
				<?php echo form_error('name','<p class="text-danger">','</p>')?>
				</div>
	<div class="form-group">
		<label for="url">Url</label> <input maxlength="50" type="text"
			class="form-control" placeholder="http://www.website.com" name="url"
			id="url" value="<?php echo set_value('url');?>" />
				<?php echo form_error('url','<p class="text-danger">','</p>')?>
				</div>
	<div class="form-group">
		<label for="description">Description </label>
		<textarea class="form-control" name="description" id="description"
			rows="7" cols="50" placeholder="description" maxlength="200"><?php echo set_value('description');?></textarea>
	</div>
</div>
<!-- /modal-body -->
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Save</button>
</div>
<?php echo form_close();?>
