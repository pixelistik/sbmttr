<div class="artists index">
<h2><?php __('Artists');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('surname');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('url');?></th>
	<th><?php echo $paginator->sort('picture');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($artists as $artist):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $artist['Artist']['id']; ?>
		</td>
		<td>
			<?php echo $artist['Artist']['name']; ?>
		</td>
		<td>
			<?php echo $artist['Artist']['surname']; ?>
		</td>
		<td>
			<?php echo $artist['Artist']['email']; ?>
		</td>
		<td>
			<?php echo $artist['Artist']['url']; ?>
		</td>
		<td>
			<?php echo $artist['Artist']['picture']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $artist['Artist']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $artist['Artist']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $artist['Artist']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $artist['Artist']['id'])); ?>
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
		<li><?php echo $html->link(__('New Artist', true), array('action'=>'add')); ?></li>
	</ul>
</div>
