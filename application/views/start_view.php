<?php $this->load->view('header', $data_header);?>
<?php $this->load->view('main_homepage', $data_homepage);?>
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
			return false;
		});

	$('body').on('click','.quick_check_form button[type=submit]',function(e){
		e.preventDefault();
		var form_data = 'url='+$('.quick_check_form input#url').val();
		//alert(form_data);
		$.ajax({
			url:$('form.quick_check_form').attr('action'),
			method:'post',
			data:form_data,
			success:function(d){
				console.log(d);
				$('div.quick_check_result_container').html(d);
				}
			});
			return false;
		});
</script>
<?php $this->load->view('footer');?>