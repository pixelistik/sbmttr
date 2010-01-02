<div class="uploads form">
<?php echo $form->create('Upload');?>
	<fieldset>
 		<legend><?php __('Add Upload');?></legend>
	<?php
		echo $form->input('description');
		echo $form->input('extension');
		echo $form->input('piece_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Uploads', true), array('action' => 'index'));?></li>
	</ul>
</div>
