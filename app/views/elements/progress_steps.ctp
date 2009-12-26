<div class="box" id="progress-box">
<?php for($i=1;$i<=$totalSteps;$i++){ ?>
	<?php 
	$class='progress-step';
	$content=$i;
	// For current:
	if($i==$currentStep){
		$class='current-step';
		$content=__('Step',true).' '.$i;
	}
	// For last:
	if($i==$totalSteps){
		$content=__('of',true).' '.$i;
	}	
	echo $html->div($class,$content);
	?>
<?php } ?>
</div>