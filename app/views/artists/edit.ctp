<div class="artists form">
<?php echo $form->create('Artist');?>
	<fieldset>
 		<legend><?php __('Edit Artist');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('surname');
		echo $form->input('email');
		echo $form->input('url');
		echo $form->input('picture');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Artist.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Artist.id'))); ?></li>
		<li><?php echo $html->link(__('List Artists', true), array('action'=>'index'));?></li>
	</ul>
</div>
