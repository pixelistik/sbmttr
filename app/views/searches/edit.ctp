<div class="searches form">
<?php echo $form->create('Search');?>
	<fieldset>
 		<legend><?php __('Edit Search');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('params');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Search.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Search.id'))); ?></li>
		<li><?php echo $html->link(__('List Searches', true), array('action'=>'index'));?></li>
	</ul>
</div>
