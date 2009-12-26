<?php
echo $form->create('Artist',array('action'=>'login')); ?>
<fieldset>
<legend>Login</legend>
<?php echo $form->input('email',array('label'=>'E-Mail-Adresse'));
echo $form->input('password',array(''=>__('Password',true)));
echo $form->end('Login'); ?>
</fieldset>
<div class="actions">
<ul>
	<li>
	<?php echo $html->link(__('I forgot my password',true),array('controller'=>'Artists','action'=>'forgotPassword') ); ?>
	</li>
</ul>
</div>