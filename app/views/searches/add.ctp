<div class="searches form">
<?php echo $form->create('Search',array('url'=>$this->passedArgs));?>
	<fieldset>
 		<legend><?php __('Save Search');?></legend>
	<?php
		echo $form->input('title',array('label'=>__('Add a title',true),));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
