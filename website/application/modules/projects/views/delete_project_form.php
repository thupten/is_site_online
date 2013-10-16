<div class="container form delete-form">
<?php echo form_open("", array('id'=>'delete_project_form', 'name'=>'delete_project_form','class'=>'form'));?>
<div class="modal-body">
		<p class="text-danger">Are you sure You want to delete following
			project?</p>
		<p><?php echo $project->name?></p>
	</div>
	<!-- /modal-body -->
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary">Confirm</button>
	</div>
<?php echo form_hidden('id', $project->id);?>
<?php echo form_hidden('_method', 'delete');?>
<?php echo form_close();?>
</div>