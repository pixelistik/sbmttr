<div class="requirements index">
<h2><?php echo(__('Requirements for',true).' '.$requirements['0']['Type']['title']);?></h2>

<?php
echo $form->create('Requirement',array('action'=>'show_by_type'));
$i = 0;
?> <table cellpadding="0" cellspacing="0">
<?php
foreach ($requirements as $requirement):
	$class = null;
	if ($i % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		
		<td>
			<?php echo $requirement['Requirement']['info_title']; ?>
		</td>
		<td>
			<?php
			echo $form->input('Requirement.'.$i.'.kind',array('value'=>$requirement['Requirement']['kind'],'options'=>array(
			'2'=>'required',
			'1'=>'optional',
			'0'=>'not used'
			)));
			echo $form->input('Requirement.'.$i.'.id',array('value'=>$requirement['Requirement']['id']));
			echo $form->input('Requirement.'.$i.'.type_id',array('value'=>$requirement['Requirement']['type_id'],'type'=>'hidden'))
			?>
		</td>
		<td>
			<?php
			echo $form->input('Requirement.'.$i.'.detailed_description',array('value'=>$requirement['Requirement']['detailed_description']))
			?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $requirement['Requirement']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $requirement['Requirement']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $requirement['Requirement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requirement['Requirement']['id'])); ?>
		</td>
	</tr>
<?php 
$i++;
endforeach;
?>

</table>
<?php echo $form->end('Submit'); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Requirement', true), array('action'=>'add')); ?></li>
	</ul>
</div>