<div class="sections index">
<h2><?php __('Sections');?></h2>
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
	<th><?php echo $paginator->sort('opening_date');?></th>
	<th><?php echo $paginator->sort('closing_date');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('type_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($sections as $section):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $section['Section']['id']; ?>
		</td>
		<td>
			<?php echo $section['Section']['title']; ?>
		</td>
		<td>
			<?php echo $section['Section']['opening_date']; ?>
		</td>
		<td>
			<?php echo $section['Section']['closing_date']; ?>
		</td>
		<td>
			<?php echo $section['Section']['description']; ?>
		</td>
		<td>
			<?php echo $section['Type']['title']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $section['Section']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $section['Section']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $section['Section']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $section['Section']['id'])); ?>
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
		<li><?php echo $html->link(__('New Section', true), array('action'=>'add')); ?></li>
	</ul>
</div>
