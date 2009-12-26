<div>

<?php //echo $this->element('progress_steps',array('totalSteps'=>10,'currentStep'=>3)); ?>

<h2><?php 
if(!isSet($showTerms)){ __('What kind of work would you like to submit?'); }
else{ echo sprintf(__('Terms for submitting a %s',true),$types['Type']['title']); }?></h2>

<?php
if(isSet($showTerms)){
	echo('<p>'.$types['Type']['terms'].'</p>');
	echo $form->create('Type',array('action'=>'select'));
	echo $form->input('title',array('value'=>$types['Type']['title'],'type'=>'hidden'));
	echo $form->input('accepted',array('type'=>'checkbox','label'=>__('Please tick this box to indicate you have read and understood the conditions',true) ) );
	echo $form->end(__('Continue',true)); ?>
	<div class="actions">
	<ul>
	<li>
	<?php echo $html->link(__('Go back and submit something other',true), array('action'=>'select')); ?>
	</li>
	</ul>
	</div>
<?php
} else {
?>
<ul>
<?php foreach ($types as $type):?>
	<li>
			<?php echo $html->link(sprintf(__('Submit a %s',true),$type['Type']['title']), array('action'=>'select',$type['Type']['title'])); ?>
		</li>
<?php endforeach; 
} ?>
</ul>
</div>
