<div class="uploads form">
<?php 
echo $form->create('Upload',array(
	'type'=>'file',
	'url'=>array('controller'=>'uploads','action'=>'add',$piece_id)
));?>
	<fieldset>
 		<legend><?php __('Add Upload');?></legend>
	<?php
		echo $form->input('file',array(
			'type'=>'file',
			'label'=>sprintf(
				__('Select file, %01.2f MB max. Allowed types: %s',true),
				Configure::read('max_file_upload_size')/1048576,
				implode(',',$allowed_filetypes)
			),
			'after'=>$form->error('Upload.extension',array('allowedType'=>__('Please observe the allowed file types.',true)))
		) 
		);
		echo $form->input('description',array('label'=>__('What is this? Please shortly describe if this is a film still, a construction plan or the whole work itself.',true)));
		echo $form->input('piece_id',array('type'=>'hidden','value'=>$this->passedArgs[0]));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php 
__('For bigger files: ');
echo $html->link(__('FTP upload',true),array('controller'=>'ftp_accounts','action'=>'activate',$piece_id))?>
