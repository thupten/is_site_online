<div>
<?php echo Modules::run('project_add/index');?>
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
			<?php echo Modules::run('project_options/index', $row->id);?>
			</td>
		</tr>
<?php endforeach;?>
		</tbody>
	</table>
</div>

