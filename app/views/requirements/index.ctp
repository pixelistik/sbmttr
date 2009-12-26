<div class="requirements index">
<h2><?php __('Requirements');?></h2>

<table cellpadding="0" cellspacing="0">

<?php
$i = 0;
foreach ($requirements as $requirement):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $requirement['Requirement']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($requirement['Type']['title'], array('controller'=> 'types', 'action'=>'view', $requirement['Type']['id'])); ?>
		</td>
		<td>
			<?php echo $requirement['Requirement']['info_title']; ?>
		</td>
		<td>
			<?php echo $requirement['Requirement']['kind']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $requirement['Requirement']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $requirement['Requirement']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $requirement['Requirement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requirement['Requirement']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Requirement', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Types', true), array('controller'=> 'types', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Type', true), array('controller'=> 'types', 'action'=>'add')); ?> </li>
	</ul>
</div>
