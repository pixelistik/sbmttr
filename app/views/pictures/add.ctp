<div class="requirements form">
<?php debug($this->passedArgs)?>
<?php echo $form->create('Picture',array('type'=>'file','url'=>array('controller'=>'pictures','action'=>'add',$this->passedArgs[0]) ));?>
	<fieldset>
 		<legend><?php echo __('Add Pictures to ',true).$piece['Type']['title'].' #'.$piece['Piece']['id'];?></legend>
		<?php echo $imageDescription; 
		// Description depends on Piece's type.
		?>
	<?php
		echo $form->input('piece_id',array('type'=>'hidden','value'=>$piece_id) );
		echo $form->input('content',array('type'=>'file','label'=>sprintf(__('JPEG Image File, %d KB max',true),Configure::read('max_picture_size')/1024)));
	?>
	</fieldset>
<?php echo $form->end(__('Upload',true));?>
</div>

<div class="actions">
<ul>
	<li>
	<?php echo $html->link(__('Back to your ',true).$piece['Type']['title'],array('controller'=>'pieces','action'=>'view',$piece['Piece']['id'])); ?>
	</li>
</div>