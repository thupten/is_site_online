<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true"
			>&times;</button>
			<h4 class="modal-title">
			<?php if(isset($id)&& empty($id)==false){?>
				Edit Project
			<?php }else{?>
				New Project
			<?php }?>
			</h4>
		</div>
	<?php echo form_open("projects/new_project", array('id'=>'new_project_form', 'name'=>'new_project_form','class'=>'form'));?>
		<div class="modal-body">
			<div class="form-group">
				<label for="name"> Project Name</label> <input type="text"
					class="form-control" placeholder="Project Name" name="name"
					id="name"
					value="<?php echo (isset($name))?$name:set_value('name');?>"
				/>
				<?php echo form_error('name')?>
				</div>
			<div class="form-group">
				<label for="url">Url</label> <input type="text" class="form-control"
					placeholder="http://www.website.com" name="url" id="url"
					value="<?php echo (isset($url))?$url:set_value('url');?>"
				/>
				<?php echo form_error('url')?>
				</div>
			<div class="form-group">
				<label for="description">Description </label> <input type="text"
					class="form-control" placeholder="Description" id="description"
					name="description"
					value="<?php echo (isset($description))?$description:set_value('description');?>"
				/>
					<?php echo form_error('description')?>
				</div>
				<?php
				if (isset($id) && empty($id) == false) {
					echo form_hidden('id', $id);
				}
				?>
		</div>
		<!-- /modal-body -->
		<div class="modal-footer">

			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	<?php echo form_close();?>
	</div>
	<!-- /content -->
</div>
<!-- /dialog -->