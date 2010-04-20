<?php 
// Make sure named parameters are passed on when paginator links are used:
$paginator->options(array('url' => $this->passedArgs)); ?>
<h2><?php __('Search');?></h2>
<?php 
// Display saved searches:
echo $this->element('saved_searches',array('searches'=>$searches));

echo $form->create('Piece',array('action'=>'search') );
	echo $form->input('section_id',array('value'=>$this->passedArgs['section_id'],'empty'=>'-'));
	echo $form->input('type_id',array('value'=>$this->passedArgs['type_id'],'empty'=>'-'));
	echo $form->input('preview_how',array(
		'type'=>'select',
		'options'=>array(
			Piece::$PREVIEW_WAYS['normal_mail']=>__('Normal Mail',true),
			Piece::$PREVIEW_WAYS['upload']=>__('Upload',true),
			Piece::$PREVIEW_WAYS['online']=>__('Online URL',true)
		),
		'value'=>$this->passedArgs['preview_how'],
		'empty'=>'-'
	));
	echo $form->input('id',array('value'=>$this->passedArgs['id'],'label'=>__('Piece ID (multiple: "1,7,3")',true),'type'=>'text'));
	echo $form->input('any_title',array('value'=>$this->passedArgs['any_title'],'label'=>__('Title',true)));
echo $form->end('Search');
?>
<div class="actions">
<ul>
<?php
// Offer a link to save the current search:
if(!empty($this->passedArgs)){
	$url=$this->passedArgs;
	$url['controller']='Searches';
	$url['action']='add'; ?>
	<li>
	<?php echo $html->link(__('Save this search',true),$url); ?>
	</li>
<?php
}
?>
</ul>
</div>
<div class="sections index">
<h3><?php __('Search Results');?></h3>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('original_title');?></th>
	<th><?php echo $paginator->sort('english_title');?></th>
	<th><?php echo $paginator->sort('section_id');?></th>
	<th><?php echo $paginator->sort('Submitted','created');?></th>
</tr>
<?php
$i = 0;
foreach ($pieces as $piece):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $html->link($piece['Type']['title'].'&nbsp;#'.$piece['Piece']['id'], array('action'=>'view', $piece['Piece']['id']),null,null,false); ?>
		</td>
		<td>
			<?php echo $piece['Piece']['original_title']; ?>
		</td>
		<td>
			<?php echo $piece['Piece']['english_title']; ?>
		</td>
		<td>
			<?php echo $piece['Section']['title']; ?>
		</td>
		<td>
			<?php echo $piece['Piece']['created']; ?>
		</td>
	</tr>
	
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
