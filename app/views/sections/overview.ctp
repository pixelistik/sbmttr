<div class="sections overview">
<h2><?php __('Sections Overview');?></h2>
<?php
// Display saved searches:
echo $this->element('saved_searches',array('searches'=>$searches));

$i = 0;
foreach ($sections as $section):
?>

	<h3><?php echo $section['Section']['title']; ?></h3>
	<dl>
		<dt><?php __('Open for');?></dt>
		<dd><?php echo $section['Type']['title']; ?></dd>
	</dl>
	<dl>
		<dt><?php __('Deadline');?></dt>
		<?php 
		// If we are between opening and closing, we're OPEN:
		if($section['Section']['closing_date'] > date( 'Y-m-d H:i:s', strtotime('now')) && $section['Section']['opening_date'] < date( 'Y-m-d H:i:s', strtotime('now') )) {
				$open_status=__('OPEN',true);
		}else{
			$open_status=__('CLOSED',true);
		}
		?>
		<dd><?php echo $section['Section']['closing_date'].' ('.$open_status.')'; ?></dd>
	</dl>
	<dl>
		<dt><?php __('Entries');?></dt>
		<dd><?php echo $html->link($section['Section']['piece_count'],array('controller'=>'Pieces','action'=>'search','section_id'=>$section['Section']['id']) ); ?></dd>
	</dl>
<?php endforeach; ?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Manage Sections', true), array('action'=>'index')); ?></li>
	</ul>
</div>
