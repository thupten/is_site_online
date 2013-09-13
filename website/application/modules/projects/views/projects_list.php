<div class="projects_list">
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
				<td><?php $this->load->view('blocks/reports_view',array('reports'=>$row->reports));?></td>
				<td>
					<div class="btn-group">
						<ul class="dropdown-menu">
							<li><a href="#"
								data-project-url="<?php echo site_url('member/project')."/".$row->id?>"
								class="editProjectButton"><span class="icon-edit"></span> Edit</a></li>
							<li><a href="#"
								data-project-url="<?php echo site_url('member/project/delete')."/".$row->id?>"
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

