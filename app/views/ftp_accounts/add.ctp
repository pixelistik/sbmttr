<div class="ftpAccounts form">
<?php echo $form->create('FtpAccount');?>
	<fieldset>
 		<legend><?php __('Add FtpAccount');?></legend>
	<?php
		echo $form->input('artist_id');
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('folder');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List FtpAccounts', true), array('action' => 'index'));?></li>
	</ul>
</div>
