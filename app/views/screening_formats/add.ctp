<div class="screeningFormats form">
<?php echo $form->create('ScreeningFormat');?>
	<fieldset>
 		<legend><?php __('Add ScreeningFormat');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('Piece');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ScreeningFormats', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Pieces', true), array('controller'=> 'pieces', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Piece', true), array('controller'=> 'pieces', 'action'=>'add')); ?> </li>
	</ul>
</div>
