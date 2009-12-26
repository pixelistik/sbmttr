<div class="shootingFormats form">
<?php echo $form->create('ShootingFormat');?>
	<fieldset>
 		<legend><?php __('Edit ShootingFormat');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('ShootingFormat.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ShootingFormat.id'))); ?></li>
		<li><?php echo $html->link(__('List ShootingFormats', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Pieces', true), array('controller'=> 'pieces', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Piece', true), array('controller'=> 'pieces', 'action'=>'add')); ?> </li>
	</ul>
</div>
