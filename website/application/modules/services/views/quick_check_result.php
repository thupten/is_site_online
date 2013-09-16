<h3>Recently checked sites</h3>
<div class="quick_check_result">
	<ul>
	<?php
	foreach($rows as $row):
		$icon_code = "";
		if ($row->status > 0 && $row->status <= 299){
			// good
			$icon_code = '<span class="icon-thumbs-up" title="site is working good"></span>';
		} else if ($row->status >= 500){
			// server error
			$icon_code = '<span class="icon-thumbs-down" title="site is down"></span>';
		} else{
			// assume 300 to 499 moved, url error or access denied
			$icon_code = '<span class="icon-exclamation-sign" title="there was an error"></span>';
		}
		?>
		<li><?php echo $row->url."&nbsp;&nbsp;&nbsp;".$icon_code;?></li>
	<?php endforeach;?>
</ul>
</div>
