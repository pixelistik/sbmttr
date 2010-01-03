<div class="uploads form">
<?php echo $form->create('Upload',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Upload');?></legend>
	<?php
		echo $form->input('content',array('type'=>'file'));
		echo $form->input('description');
		echo $form->input('piece_id',array('type'=>'hidden','value'=>$this->passedArgs[0]));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Uploads', true), array('action' => 'index'));?></li>
	</ul>
</div>
