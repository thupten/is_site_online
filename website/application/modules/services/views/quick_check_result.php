<h3>Recently checked sites</h3>
<div class="recently_checked_results">
	<ul>
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
		<li><?php echo $row->url."&nbsp;&nbsp;&nbsp;".$icon_code;?></li>
	<?php endforeach;?>
</ul>
</div>
