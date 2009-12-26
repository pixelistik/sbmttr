<div class="sections form">
<?php echo $form->create('Section');?>
	<fieldset>
 		<legend><?php __('Edit Section');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('opening_date');
		echo $form->input('closing_date');
		echo $form->input('description');
		echo $form->input('type_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Section.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Section.id'))); ?></li>
		<li><?php echo $html->link(__('List Sections', true), array('action'=>'index'));?></li>
	</ul>
</div>
