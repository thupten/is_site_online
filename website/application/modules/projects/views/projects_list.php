<div class="container">
	<div>
	<?php echo form_open('projects/new_project', array ('class' => 'form' )); echo form_submit('add_project_button','Add new Project','class="btn btn-primary"'); echo form_close();?>
	</div>
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
						<div class="dropdown">
							<a href="#" data-toggle="dropdown" class="btn btn-default">Option
								<span class="icon-caret-down"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a
									href="<?php echo site_url('projects/edit/'.$row->id)?>"><span
										class="icon-edit"></span> Edit project</a></li>
								<li class="divider"></li>
								<li><a
									href="<?php echo site_url('projects/delete/'.$row->id)?>"><span
										class="icon-trash"></span> Delete project</a></li>
							</ul>
						</div>
					</td>
				</tr>
<?php endforeach;?>
		</tbody>
		</table>
	</div>
</div>