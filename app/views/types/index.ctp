<div class="types index">
<h2><?php __('Types');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('terms');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($types as $type):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $type['Type']['id']; ?>
		</td>
		<td>
			<?php echo $type['Type']['title']; ?>
		</td>
		<td>
			<?php echo $type['Type']['terms']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit Requirements', true), array('controller'=>'Requirements','action'=>'show_by_type','0'=>$type['Type']['title'])); ?>
			<?php echo $html->link(__('View', true), array('action'=>'view', $type['Type']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $type['Type']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $type['Type']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $type['Type']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Type', true), array('action'=>'add')); ?></li>
	</ul>
</div>
