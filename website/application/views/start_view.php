<?php $this->load->view('blocks/header', $data_header);?>
<?php $this->load->view('blocks/homepage');?>
<script type="text/javascript">
	$('body').on('click','#login_form button[type=submit]',function(e){
		e.preventDefault();
		var form_data = 'username='+$('#username').val()+'&password='+$('#password').val();
		//alert(form_data);
		$.ajax({
			url:$('form#login_form').attr('action'),
			method:'post',
			data:form_data,
			success:function(d){
				console.log(d);
				$('div#login').html(d);
			}
		});
	});
		
		

	$('body').on('click','.quick_check_form button[type=submit]',function(e){
		e.preventDefault();
		$('div.quick_check_container').append('<i class="icon-spinner icon-spin icon-large"></i> ');
		var form_data = 'url='+$('.quick_check_form input#url').val();
		//alert(form_data);
		$.ajax({
			url:$('form.quick_check_form').attr('action'),
			method:'post',
			data:form_data,
			success:function(d){
				console.log(d);
				$('div.quick_check_container').html(d);
				}
			});
			return false;
		});
</script>
<?php $this->load->view('blocks/footer');?>