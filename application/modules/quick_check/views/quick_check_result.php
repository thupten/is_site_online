<?php
?>
<div class="quick_check_result">
	<ul>
<?php foreach($rows as $row):?>
	<?php
	$icon_code = "";
	if ($row->status > 0 && $row->status <= 299) {
		// good
		$icon_code = '<span class="icon-thumbs-up">Good</span>';
	} else if ($row->status >= 500) {
		// server error
		$icon_code = '<span class="icon-thumbs-down">Bad</span>';
	} else {
		// assume 300 to 499 moved, url error or access denied
		$icon_code = '<span class="icon-exclamation-sign">Unknown</span>';
	}
	?>
	<li><?php echo $row->url."&nbsp;&nbsp;&nbsp;".$icon_code;?></li>
<?php endforeach;?>
</ul>
</div>
