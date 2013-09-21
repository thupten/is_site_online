<?php echo form_open("", array('id'=>'edit_project_form', 'name'=>'edit_project_form','class'=>'form'));?>
<div class="modal-body">
	<div class="form-group">
		<label for="name"> Project Name</label> <input type="text"
			class="form-control" placeholder="Project Name" name="name" id="name"
			maxlength="30" value="<?php echo $project->name?>" />
			<?php echo form_error('name','<p class="text-danger">','</p>')?>
	</div>
	<div class="form-group">
		<label for="url">Url</label> <input type="text" class="form-control"
			placeholder="http://www.website.com" name="url" id="url"
			maxlength="50" value="<?php echo $project->url;?>" />
			<?php echo form_error('url','<p class="text-danger">','</p>')?>
	</div>
	<div class="form-group">
		<label for="description">Description </label>
		<textarea class="form-control" name="description" id="description"
			rows="7" cols="50" placeholder="description" maxlength="200"><?php echo $project->description;?></textarea>
		<?php echo form_error('description','<p class="text-danger">','</p>')?>
	</div>
</div>
<!-- /modal-body -->
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Save changes</button>
</div>
<?php echo form_hidden('id', $project->id);?>
<?php echo form_hidden('_method', 'put');?>
<?php echo form_close();?>
