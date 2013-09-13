<ul class="list-unstyled list-inline reports">
	<?php foreach($reports as $report):?>
	<li class="report-row">
		<h5><?php
		$day = date('D', strtotime($report->date));
		echo $day;
		?></h5>
			<?php
		$content = "";
		if ($report->status == 200){
			$thumb_value = "icon-thumbs-up";
		} else{
			$thumb_value = "icon-thumbs-down";
		}
		$content .= "<div class=\"" . $thumb_value . "\" title=\"" . $report->date . "\"></div>";
		echo $content;
		?>

	</li><?php endforeach;?>
</ul>