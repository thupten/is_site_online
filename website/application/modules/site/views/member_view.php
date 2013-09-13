<?php $this->load->view('blocks/header', $data_header);?>
<?php echo $this->load->view('blocks/main_member');?>
<script type="text/javascript">
// 	$('body').on('click','button[type=submit]',function(e){
// 		e.preventDefault();
// 		var form_data = 'username='+$('#username').val()+'&password='+$('#password').val();
// 		//alert(form_data);
// 		$.ajax({
// 			url:$('form#login_form').attr('action'),
// 			method:'post',
// 			data:form_data,
// 			success:function(d){
// 				console.log(d);
// 				$('div#login').html(d);
// 				}
// 			});
// 			return false;
// 		});
</script>
<?php $this->load->view('blocks/footer');?>