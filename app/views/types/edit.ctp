<div class="types form">
<?php echo $form->create('Type');?>
	<fieldset>
 		<legend><?php __('Edit Type');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('terms');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Type.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Type.id'))); ?></li>
		<li><?php echo $html->link(__('List Types', true), array('action'=>'index'));?></li>
	</ul>
</div>
