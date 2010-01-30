<div class="ftpAccounts index">
<h2><?php __('FtpAccounts');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('artist_id');?></th>
	<th><?php echo $paginator->sort('username');?></th>
	<th><?php echo $paginator->sort('password');?></th>
	<th><?php echo $paginator->sort('folder');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($ftpAccounts as $ftpAccount):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $ftpAccount['FtpAccount']['id']; ?>
		</td>
		<td>
			<?php echo $ftpAccount['FtpAccount']['artist_id']; ?>
		</td>
		<td>
			<?php echo $ftpAccount['FtpAccount']['username']; ?>
		</td>
		<td>
			<?php echo $ftpAccount['FtpAccount']['password']; ?>
		</td>
		<td>
			<?php echo $ftpAccount['FtpAccount']['folder']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $ftpAccount['FtpAccount']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $ftpAccount['FtpAccount']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $ftpAccount['FtpAccount']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ftpAccount['FtpAccount']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New FtpAccount', true), array('action' => 'add')); ?></li>
	</ul>
</div>
