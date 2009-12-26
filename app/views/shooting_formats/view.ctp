<div class="shootingFormats view">
<h2><?php  __('ShootingFormat');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $shootingFormat['ShootingFormat']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $shootingFormat['ShootingFormat']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ShootingFormat', true), array('action'=>'edit', $shootingFormat['ShootingFormat']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ShootingFormat', true), array('action'=>'delete', $shootingFormat['ShootingFormat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $shootingFormat['ShootingFormat']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ShootingFormats', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New ShootingFormat', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Pieces', true), array('controller'=> 'pieces', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Piece', true), array('controller'=> 'pieces', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Pieces');?></h3>
	<?php if (!empty($shootingFormat['Piece'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Original Title'); ?></th>
		<th><?php __('English Title'); ?></th>
		<th><?php __('Type Id'); ?></th>
		<th><?php __('Synopsis'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th><?php __('Selected'); ?></th>
		<th><?php __('Notes Team'); ?></th>
		<th><?php __('Notes Artist'); ?></th>
		<th><?php __('Production Year'); ?></th>
		<th><?php __('Duration'); ?></th>
		<th><?php __('Shooting Format Id'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Genre'); ?></th>
		<th><?php __('Shown Before'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($shootingFormat['Piece'] as $piece):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $piece['id'];?></td>
			<td><?php echo $piece['original_title'];?></td>
			<td><?php echo $piece['english_title'];?></td>
			<td><?php echo $piece['type_id'];?></td>
			<td><?php echo $piece['synopsis'];?></td>
			<td><?php echo $piece['section_id'];?></td>
			<td><?php echo $piece['selected'];?></td>
			<td><?php echo $piece['notes_team'];?></td>
			<td><?php echo $piece['notes_artist'];?></td>
			<td><?php echo $piece['production_year'];?></td>
			<td><?php echo $piece['duration'];?></td>
			<td><?php echo $piece['shooting_format_id'];?></td>
			<td><?php echo $piece['country_id'];?></td>
			<td><?php echo $piece['genre'];?></td>
			<td><?php echo $piece['shown_before'];?></td>
			<td><?php echo $piece['created'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'pieces', 'action'=>'view', $piece['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'pieces', 'action'=>'edit', $piece['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'pieces', 'action'=>'delete', $piece['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $piece['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Piece', true), array('controller'=> 'pieces', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
