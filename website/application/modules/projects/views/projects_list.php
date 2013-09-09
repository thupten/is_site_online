<div class="projects_list">
	<a href="#" class="btn btn-primary" id="new_project_btn">New Project</a>
	<table class="table table-bordered table-striped">
		<caption>Projects</caption>
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>url</th>
				<th>status</th>
				<th>settings</th>
			</tr>
		</thead>
		<tbody>
<?php foreach ( $rows as $row ) :?> 
		<tr>
				<td><?php echo $row->id;?></td>
				<td><?php echo $row->name;?></td>
				<td><?php echo $row->url;?></td>
				<td><?php echo 'status'?></td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle"
							data-toggle="dropdown"
						>
							Setting <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#"
								data-project-url="<?php echo site_url('member/project')."/".$row->id?>"
								class="editProjectButton"
							><span class="icon-edit"></span> Edit</a></li>
							<li><a href="#"
								data-project-url="<?php echo site_url('member/project/delete')."/".$row->id?>"
								class="deleteProjectButton"
							><span class="icon-trash"></span> Delete</a></li>
						</ul>
					</div>
				</td>

			</tr>
<?php endforeach;?>
		</tbody>
	</table>
</div>
<div class="modal fade" id="new-project-modal" role="dialog"
	aria-hidden="true"
><?php echo Modules::run('projects/new_project');?></div>


<script type="text/javascript">
	var baseurl = "<?php echo site_url();?>";
	$('body').on('click','#new_project_btn', function(){
		$('#new-project-modal').modal();
	});
	$('div.modal form').on('submit', function(e){
		$that = $(this);
		var id = $this.find('input[type=hidden]').val();
		var url;
		if(empty(id)){
			url = baseurl + '/projects/edit_project/'+id;
			}else{
				url = baseurl + '/projects/new_project';
			}
		$.ajax({
			method:'post',
			url:
			});
		e.preventDefault();
	});
</script>
