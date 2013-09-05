<?php echo form_open("", array('id'=>'edit_project_form', 'name'=>'edit_project_form','class'=>'form'));?>
<div class="modal-body">
	<div class="form-group">
		<label for="name"> Project Name</label> <input type="text"
			class="form-control" placeholder="Project Name" name="name" id="name"
			value="<?php echo $name;?>"
		/>
			<?php echo form_error('name')?>
	</div>
	<div class="form-group">
		<label for="url">Url</label> <input type="text" class="form-control"
			placeholder="http://www.website.com" name="url" id="url"
			value="<?php echo $url;?>"
		/>
			<?php echo form_error('url')?>
	</div>
	<div class="form-group">
		<label for="description">Description </label> <input type="text"
			class="form-control" placeholder="Description" id="description"
			name="description" value="<?php echo $description;?>"
		/>
		<?php echo form_error('description')?>
	</div>
</div>
<!-- /modal-body -->
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	<button type="submit" class="btn btn-primary">Save changes</button>
</div>
<?php echo form_hidden('id', $id);?>
<?php echo form_close();?>
