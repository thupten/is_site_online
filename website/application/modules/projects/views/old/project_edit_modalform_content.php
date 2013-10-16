<?php
$project = $result [0];
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Edit Project</h4>
		</div>
		<!-- /modal-header -->
		<form class="modal-form" name="edit_project_form"
			id="edit_project_form" method="post" action="#"
			edit-project-form-action="<?php echo site_url('member/edit_project'."/".$project['id'])?>">
			<div class="modal-body">
				<input type="hidden" name="edit_project_id" id="edit_project_id"
					value="<?php echo $project['id']?>" />
				<div class="form-group">
					<label for="edit_project_name">Project Name</label><input
						type="text" class="form-control" placeholder="Project Name"
						name="edit_project_name" id="edit_project_name"
						value="<?php echo $project['name']?>" />
				</div>
				<div class="form-group">
					<label for="edit_project_website_url">Website Url</label> <input
						type="text" class="form-control" placeholder="Website"
						name="edit_project_website_url" id="edit_project_website_url"
						value="<?php echo $project['url']?>" />
				</div>
				<div class="form-group">
					<label for="edit_project_description">Description</label> <input
						type="text" class="form-control" placeholder="Description"
						id="edit_project_description" name="edit_project_description"
						value="<?php echo $project['description']?>" />
				</div>
			</div>
			<!-- /modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<input type="submit" class="btn btn-primary"
					value="Save
					changes" />
			</div>
		</form>
		<!-- /modal-footer -->
	</div>
	<!-- /modal-content -->
</div>
<!-- /modal-dailog -->

<script type="text/javascript">
$('#edit_project_form').on('submit', function(e) {
	e.preventDefault();
	var $form = $(this);
	var url = $form.attr('edit-project-form-action');
	console.log('form submitted to '+url);
	$('.modal').modal('hide');
	$.post(url, $form.serialize()).then(function(){location.reload(true)});
});

</script>