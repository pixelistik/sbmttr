<div class="searches view">
<h2><?php  __('Search');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $search['Search']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $search['Search']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Params'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $search['Search']['params']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Search', true), array('action'=>'edit', $search['Search']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Search', true), array('action'=>'delete', $search['Search']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $search['Search']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Searches', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Search', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
