<div class="dropdown">
	<a href="#" data-toggle="dropdown" class="btn btn-default">Option <span
		class="icon-caret-down"></span>
	</a>
	<ul class="dropdown-menu">
		<li>
			<form method="get" id="option_<?php echo $project_id?>_edit_form">
				<?php echo form_hidden("project_id",$project_id)?>
				<?php echo form_hidden("task","edit")?>
				<button type="submit" name="edit" class="btn btn-default">
					Edit <span class="icon-edit"></span>
				</button>
			</form>
		</li>
		<li class="divider"></li>
		<li>
			<form method="get" id="option_<?php echo $project_id?>_delete_form">
				<?php echo form_hidden("project_id",$project_id)?>
				<?php echo form_hidden("task","delete")?>
				<button type="submit" name="delete" class="btn btn-default">
					Delete <span class="icon-trash"></span>
				</button>
			</form>
		</li>
	</ul>
</div>