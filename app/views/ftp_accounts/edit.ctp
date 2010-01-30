<div class="ftpAccounts form">
<?php echo $form->create('FtpAccount');?>
	<fieldset>
 		<legend><?php __('Edit FtpAccount');?></legend>
	<?php
		echo $form->input('id');
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
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('FtpAccount.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('FtpAccount.id'))); ?></li>
		<li><?php echo $html->link(__('List FtpAccounts', true), array('action' => 'index'));?></li>
	</ul>
</div>
