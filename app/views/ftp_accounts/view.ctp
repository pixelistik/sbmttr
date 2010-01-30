<div class="ftpAccounts view">
<h2><?php  __('FtpAccount');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ftpAccount['FtpAccount']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Artist Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ftpAccount['FtpAccount']['artist_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ftpAccount['FtpAccount']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ftpAccount['FtpAccount']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Folder'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ftpAccount['FtpAccount']['folder']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit FtpAccount', true), array('action' => 'edit', $ftpAccount['FtpAccount']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete FtpAccount', true), array('action' => 'delete', $ftpAccount['FtpAccount']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ftpAccount['FtpAccount']['id'])); ?> </li>
		<li><?php echo $html->link(__('List FtpAccounts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New FtpAccount', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
