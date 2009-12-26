<div class="requirements view">
<h2><?php  __('Requirement');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($requirement['Type']['title'], array('controller'=> 'types', 'action'=>'view', $requirement['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Info Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['info_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Kind'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['kind']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Requirement', true), array('action'=>'edit', $requirement['Requirement']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Requirement', true), array('action'=>'delete', $requirement['Requirement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requirement['Requirement']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Types', true), array('controller'=> 'types', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Type', true), array('controller'=> 'types', 'action'=>'add')); ?> </li>
	</ul>
</div>
