<div class="pieces index">
<h2><?php __('Your Submissions');?></h2>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php __('id');?></th>
	<th><?php __('Title');?></th>
	<th><?php __('Submitted to');?></th>
	<th><?php __('Submitted');?></th>
</tr>
<?php
$i = 0;
foreach ($pieces['Piece'] as $piece):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php //echo $piece['Type']['title'].'&nbsp;#'.$piece['id']; ?>
			<?php echo $html->link($piece['Type']['title'].'&nbsp;#'.$piece['id'], array('action'=>'view', $piece['id']),null,null,false); ?>
		</td>
		<td>
			<?php echo $piece['original_title'];
			// Put a separator if both english and original title are present:
			if(!empty($piece['english_title']) && !empty($piece['original_title'])) echo ' / ';
			echo $piece['english_title']; ?>
		</td>
		<td>
			<?php echo $piece['Section']['title']; ?>
		</td>
		<td>
			<?php echo $piece['created']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Enter a new submission', true), array('action'=>'add')); ?></li>
	</ul>
</div>
