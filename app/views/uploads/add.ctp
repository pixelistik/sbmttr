<div class="uploads form">
<?php echo $form->create('Upload',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Upload');?></legend>
	<?php
		echo $form->input('content',array(
			'type'=>'file',
			'label'=>sprintf(
				__('Select file, %01.2f MB max',true),
				Configure::read('max_file_upload_size')/1048576)
			) 
		);
		echo $form->input('description',array('label'=>__('Shortly describe what is in this file, please',true)));
		echo $form->input('piece_id',array('type'=>'hidden','value'=>$this->passedArgs[0]));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
