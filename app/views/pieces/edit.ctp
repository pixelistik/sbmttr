<div class="pieces form">
<?php echo $form->create('Piece');?>
	<fieldset>
 		<legend><?php __('Edit Piece');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('original_title');
		echo $form->input('english_title');
		echo $form->input('type_id');
		echo $form->input('synopsis');
		echo $form->input('section_id');
		echo $form->input('selected');
		echo $form->input('notes_team');
		echo $form->input('notes_artist');
		echo $form->input('production_year');
		echo $form->input('duration');
		echo $form->input('shooting_format_id');
		echo $form->input('country_id');
		echo $form->input('genre');
		echo $form->input('shown_before');
		echo $form->input('preview_how');
		echo $form->input('preview_url');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Piece.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Piece.id'))); ?></li>
		<li><?php echo $html->link(__('List Pieces', true), array('action'=>'index'));?></li>
	</ul>
</div>
