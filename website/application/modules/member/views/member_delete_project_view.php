<?php $this->load->view('blocks/header', $data_header);?>
<?php echo Modules::run('projects/delete', $project_id,$redirect_uri);?>
<?php $this->load->view('blocks/footer');?>