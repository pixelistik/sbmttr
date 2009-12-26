<?php
$errorMessages=array(
	'name'=>array(
		'length'=>__('Please enter a name',true)
		),
	'surname'=>array(
		'length'=>__('Please enter a name',true)
		),
	'email'=>array(
		'emailFormat'=>__('Please enter a valid email address',true),
		'emailUnique'=>__('Your Email Adress is already registered. If you forgot your password, please click on \'login\' and use the \'Forgot Password\' function.',true)
		),
	'url'=>array(
		'urlFormat'=>__('This does not look like a valid URL',true)
		)
	);
?>
<div class="artists form">
<?php echo $form->create('Artist',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('You');?></legend>
		<p>
		<?php echo(sprintf( __('Please tell us some things about yourself. Or %s if you\'ve submitted before.',true),$html->link(__('log in', true), array('action'=>'login')) )); ?>
		<br/>
		<?php __('<b>Bold</b> fields are required.'); ?>
		</p>
	<?php
		echo $form->input('name',array('error'=>$errorMessages['name']) );
		echo $form->input('surname',array('error'=>$errorMessages['surname']));
		echo $form->input('email',array('error'=>$errorMessages['email'],'after'=>__('We will never give your address to other people!',true)) );
		echo $form->input('url',array('type'=>'text','error'=>$errorMessages['url'],'label'=>__('URL of your website, portfolio or profile',true) ) );
		echo $form->input('picture',array('type'=>'file','label'=>sprintf(__('If you like: Portrait (JPEG Image, %d KB max)',true),Configure::read('max_picture_size')/1024) ) );
	?>
	</fieldset>
<?php echo $form->end(__('Continue',true));?>
</div>

