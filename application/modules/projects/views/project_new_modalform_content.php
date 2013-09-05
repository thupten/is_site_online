<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Add New Project</h4>
		</div>
		<!-- /modal-header -->
		<form role="form" id="new_project_form" name="new_project_form"
			method="post"
			project-data-url="<?php echo site_url('member/new_project_submit')?>">
			<div class="modal-body">
				<div class="form-group">
					<label for="new_project_name"> Project Name</label><br> <input
						type="text" class="form-control" placeholder="Project Name"
						name="new_project_name" id="new_project_name" />
				</div>
				<div class="form-group">
					<label for="website_url"> <br> Website Url
					</label> <input type="text" class="form-control"
						placeholder="Website" name="website_url" id="website_url" />
				</div>
				<div class="form-group">
					<label for="description"> <br> Description
					</label> <input type="text" class="form-control"
						placeholder="Description" id="description" name="description" />
				</div>
			</div>
			<!-- /modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</form>
		<!-- /modal-footer -->
	</div>
	<!-- /modal-content -->
</div>
<!-- /modal-dailog -->

<script type="text/javascript">


$('#new_project_form').on('submit', function(e) {
	e.preventDefault();
	var $form = $(this);
	var url = $form.attr("project-data-url");
	console.log('form submitted to '+url);
	$('.modal').modal('hide');
	$.post(url, $form.serialize())
		.then(function(){location.reload(true);});
	
});


</script>