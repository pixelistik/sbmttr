<div class="types view">
<h2><?php  __('Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $type['Type']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $type['Type']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Terms'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $type['Type']['terms']; ?>
			&nbsp;
		</dd>
	</dl>

	<h3><?php __('Requirements')?></h3>
	<ul>
		<?php foreach($type['Requirement'] as $requirement): ?>
		<li><?php echo $requirement['info_title'];?></li>
		<?php endforeach; ?>
	</ul>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Type', true), array('action'=>'edit', $type['Type']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Type', true), array('action'=>'delete', $type['Type']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $type['Type']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Types', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Type', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
