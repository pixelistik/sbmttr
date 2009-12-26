<div class="box" id="saved-searches-box">
<h3><?php __('Saved Searches');?></h3>
<ul>
<?php
// Show a list of the given saved searches, including links to run them:
foreach($searches as $key=>$value): ?>
	<li>
	<?php echo $html->link($value,array('controller'=>'Searches','action'=>'run',$key)); ?>
	
	</li>
<?php endforeach; ?>
</ul>
<?php echo $html->link(__('(show all)',true),array('controller'=>'Searches','action'=>'index')); ?>
</div>