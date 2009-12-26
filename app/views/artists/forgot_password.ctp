<div class="artists form">
<?php echo $form->create('Artist',array('action'=>'forgotPassword'));?>
	<fieldset>
 		<legend><?php __('Forgot Password');?></legend>
		<p>
		<?php __('Please enter your email address. You will get an email with a reset link.') ?>
		</p>
	<?php
		echo $form->input('email',array('label'=>__('Email Address',true) ) );
	?>
	</fieldset>
<?php echo $form->end(__('Submit',true));?>
</div>