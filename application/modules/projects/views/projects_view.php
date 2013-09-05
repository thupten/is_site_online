<?php
$this->load->view('partials/header', array (
		'title' => 'projects' 
));
?>
<div class="projects container">
<?php
if ($this->session->flashdata('message') != false) :
	$message = $this->session->flashdata('message');
	if (strpos($message, 'error') > 0) :
		?>
		<div class="alert fade-in alert-danger">
		<button type="button" class="close" data-dismiss="alert"
			aria-hidden="true">&times</button>
		<?php echo "<p>" . $message . "</p>";	?>
		</div>
	<?php else :?>
		<div class="alert fade-in alert-success">
		<button type="button" class="close" data-dismiss="alert"
			aria-hidden="true">&times;</button>
		<?php echo "<p>".$message."</p>";?></div>
	<?php endif ?>	
<?php endif ?> 
	
	<a class="btn btn-primary" id="newProjectButton"
		data-project-url="<?php echo site_url('member/new_project')?>"><span
		class="icon-plus"></span> New Project</a>


	<!-- newProjectModal -->
	<div class="modal fade" id="newProjectModal" tabindex="-1"
		role="dialog" aria-labelledby="newProjectModalLabel"
		aria-hidden="true">
		<!-- content will be injected via js -->
	</div>
	<!-- /modal -->

	<!-- editProjectModal -->
	<div class="modal fade" id="editProjectModal" tabindex="-1"
		role="dialog" aria-labelledby="editProjectModalLabel">
		<!-- content will be injected via js -->
	</div>
	<!-- /modal -->

	<table class="table table-bordered table-striped">
		<caption>Projects</caption>
		<thead>
			<tr>
				<th>Id</th>
				<th>Project Name</th>
				<th>Website Url</th>
				<th>Description</th>
				<th>Last Checked / Status</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $result as $project ) :
			?>
			<tr>
				<td><?php echo $project['id']?></td>
				<td><?php echo anchor('member/project/'.$project['id'], $project['name'],'') ?></td>
				<td><?php echo $project['url']?></td>
				<td><?php echo $project['description']?></td>
				<td><?php echo $project['last_checked_date']?><br />
				<?php echo $project['last_status']?></td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle"
							data-toggle="dropdown">
							Change <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#"
								data-project-url="<?php echo site_url('member/project')."/".$project['id']?>"
								class="editProjectButton"><span class="icon-edit"></span> Edit</a></li>
							<li><a href="#"
								data-project-url="<?php echo site_url('member/project/delete')."/".$project['id']?>"
								class="deleteProjectButton"><span class="icon-trash"></span>
									Delete</a></li>
						</ul>
					</div>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
$('#newProjectButton').click(function() {
	$('#newProjectModal').modal({
			remote: $(this).attr('data-project-url')
	});
});

$('.editProjectButton').click(function(e) {
	$('#editProjectModal').modal({
		remote : $(this).attr('data-project-url')
	});
});

$('.modal').on('hidden.bs.modal', function() {
	$(this).removeData('bs.modal');
});

</script>

<?php $this->load->view ( 'partials/footer' );?>