<div class="requirements form">
<?php echo $form->create('Requirement');?>
	<fieldset>
 		<legend><?php __('Edit Requirement');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('type_id');
		echo $form->input('info_title');
		echo $form->input('kind');
		echo $form->input('detailed_description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Requirement.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Requirement.id'))); ?></li>
		<li><?php echo $html->link(__('List Requirements', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Types', true), array('controller'=> 'types', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Type', true), array('controller'=> 'types', 'action'=>'add')); ?> </li>
	</ul>
</div>
