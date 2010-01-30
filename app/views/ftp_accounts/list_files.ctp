<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
?>
<?php 
if(!empty($files)){
	echo $form->create('Upload');
	$i=0;
	foreach($files as $file){ ?>
		<fieldset>
		<legend><?php echo $file['filename'] ?></legend>
		<?php
		echo $form->input('Upload.'.$i.'.piece_id');
		echo $form->hidden('Upload.'.$i.'.filename',array('value'=>$file['filename']));
		echo $form->input('Upload.'.$i.'.description');
		?> </fieldset> <?php
		$i++;
	}
	echo $form->end(__('Save files',true));
}else{
	__('No uploaded files found');
}