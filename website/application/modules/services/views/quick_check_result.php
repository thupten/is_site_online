<?php $this->load->helper('date');?>
<h3>Recently checked sites</h3>
<div class="recently_checked_results">
	<ul class="list-unstyled">
	<?php
	foreach($rows as $row):
		$icon_code = "";
		if ($row->status > 0 && $row->status <= 399){
			// good
			$icon_code = '<span class="icon-thumbs-up" title="site is working good ' . $row->status . '"></span>';
		} else{
			// server error
			$icon_code = '<span class="icon-thumbs-down" title="site is down ' . $row->status . '"></span>';
		}
		?>
		<li>
			<img width="16px" src="<?php echo $row->url."/favicon.ico"?>">
			<span class="content"><?php echo $row->url."&nbsp;&nbsp;&nbsp;".$icon_code;  ?><br></span>
			<span class="timespan"><?php
			$timestamp = human_to_unix($row->date_checked);
			echo timespan($timestamp)?> ago</span>
		</li>
	<?php endforeach;?>
</ul>
</div>
