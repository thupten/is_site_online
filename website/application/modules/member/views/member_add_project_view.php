<?php $this->load->view('blocks/header', $data_header);?>
<?php echo Modules::run('projects/new_project',$redirect_uri);?>
<?php $this->load->view('blocks/footer');?>