<div class="pieces view">
<h2><?php echo $piece['Type']['title'].' #'.$piece['Piece']['id'];?></h2>
<div class="actions">
<ul>
		<?php if($requirements['Pictures']>0){ ?>
			<li>
			<?php echo $html->link(__('Add images',true),array('controller'=>'pictures','action'=>'add',$piece['Piece']['id']) ); ?>
			</li>
		<?php } ?>
</ul>
</div>
	<dl>
		<?php if($requirements['original_title']>0):?>
		<dt><?php __('Original Title'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['original_title']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['english_title']>0):?>
		<dt><?php __('English Title'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['english_title']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php foreach($piece['Artist'] as $artist): ?>
		<dt><?php __('Artist'); ?></dt>
		<dd>
			<?php echo($artist['name'].' '.$artist['surname']); ?>
			&nbsp;(<?php echo $artist['ArtistsPiece']['function']; ?>)
			&nbsp;<i><?php if($artist['ArtistsPiece']['is_main_contact']) __('Main Contact'); ?></i>
		<?php endforeach; ?>
		</dd>
		
		
		<?php if($requirements['synopsis']>0):?>
		<dt><?php __('Synopsis'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['synopsis']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['section_id']>0):?>
		<dt><?php __('Section'); ?></dt>
		<dd>
			<?php echo $piece['Section']['title']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['notes_artist']>0):?>
		<dt><?php __('Notes'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['notes_artist']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['production_year']>0):?>
		<dt><?php __('Production Year'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['production_year']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['duration']>0):?>
		<dt><?php __('Duration'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['duration']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['shooting_format_id']>0):?>
		<dt><?php __('Shooting Format'); ?></dt>
		<dd>
			<?php echo $piece['ShootingFormat']['name']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['ScreeningFormat']>0):?>
		<?php foreach($piece['ScreeningFormat'] as $format): ?>
		<dt><?php __('Screening Format'); ?></dt>
		<dd>
			<?php echo($format['name']); ?>
		<?php endforeach; ?>
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['country_id']>0):?>
		<dt><?php __('Country'); ?></dt>
		<dd>
			<?php echo $piece['Country']['name']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['genre']>0):?>
		<dt><?php __('Genre'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['genre']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['shown_before']>0):?>
		<dt><?php __('Shown Before'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['shown_before']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<dt><?php __('Submitted'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['created']; ?>
			&nbsp;
		</dd>
		
		<?php if($requirements['preview_how']>0):?>
		<dt><?php __('Preview How'); ?></dt>
		<dd>
			<?php echo $piece['Piece']['preview_how']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		
		<?php if($requirements['preview_how']>0):?>
		<dt><?php __('Preview Url'); ?></dt>
		<dd>
			<?php echo $html->link($piece['Piece']['preview_url'],$piece['Piece']['preview_url']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<?php foreach($piece['Picture'] as $picture): ?>
		<dt><?php __('Picture'); ?></dt>
		<dd>
			<?php echo $html->link($picture['name'],'/pictures/download/'.$picture['id']); ?>
		<?php endforeach; ?>
		</dd>
	</dl>
</div>
