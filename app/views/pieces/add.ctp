<?php 
echo $javascript->link('jquery.min',false);
echo $javascript->link('jquery.tools.min',false); ?>
<script type="text/javascript">                                         
    $(document).ready(function() {
	// ADDITIONAL ARTISTS
	// Create the "Add" button:
	$("#additional-artists").append('<div id="add-button" class="actions"><ul><li><img src="../img/plus.png" style="vertical-align: middle;"/>&nbsp;<?php __('Add additional Artist');?></li></ul></div>');
	// Hide the additional fields:
	$(".hidable-artists").hide();
	// Show those fields again that already have data preset:
	$(".hidable-artists:hidden").each(function(i){
					   if($(this).find('input[value!=""]').length > 0){
						   $(this).show();
					   }
			   })
	// Click handler for the Add button:
	$("#add-button").click(function() {
	// Shows next hidden artist fields:
			var first=true;
			$(".hidable-artists:hidden").each(function(i){
					   if(first){
						   $(this).show();
						   first=false;
					   }
			   })
			// Hide Add-Button if no fields left to show:
			if($(".hidable-artists:hidden").length==0){
				$("#add-button").hide();
			}
	});
	// HELP TEXT POP UPS:
	$("div.help-text").addClass("help-text-ajax");
	$("div.help-text").tooltip({ 
	    // place tooltip on the right edge 
	    position: ['center', 'right'], 
	    // a little tweaking of the position 
	    offset: [0, 0], 
	    // use a simple show/hide effect 
	    effect: 'toggle', 
	    // custom opacity setting 
	    opacity: 0.7 
	});
	// Additional Elements:
	// Hide if not used:
	// Show URL input only, if radio 2 is checked:
			if($(".preview-copy-radio:checked").val()==2){
				$("#preview-url-field").show();
			}else{
				$("#preview-url-field").hide();
			}
	// Same for mailing information (=1)
			if($(".preview-copy-radio:checked").val()==0){
				$("#mail-helptext").show();
			}else{
				$("#mail-helptext").hide();
			}
	// Do the same check if buttons are changed by user:
	$(".preview-copy-radio").click(
		function(){
			//alert($(".preview-copy-radio:checked").val());
			// Show URL input, if radio 2 is checked:
			if($(".preview-copy-radio:checked").val()==2){
				$("#preview-url-field").show();
			}else{
				$("#preview-url-field").hide();
			}
			// Same for mailing information (=1)
			if($(".preview-copy-radio:checked").val()==0){
				$("#mail-helptext").show();
			}else{
				$("#mail-helptext").hide();
			}
		}
		)
 });
                                     
 </script>
 
<div class="pieces form">
<?php echo $form->create('Piece');?>
	<fieldset>
 		<legend><?php __('Your Work');?></legend>
 		<p><?php __('<b>Bold</b> fields are required.'); ?></p>
	<?php
		echo $form->input('id');
		if($requirements['original_title']>0) echo $form->input('original_title',array('after'=> ($helpText['original_title'] ? $html->div('help-text',$helpText['original_title']) : '') ));
		
		if($requirements['english_title']>0) echo $form->input('english_title',array('after'=> ($helpText['english_title'] ? $html->div('help-text',$helpText['english_title']) : '') ));
		
		echo $form->hidden('type_id');
		//echo $form->input('Artist.id');
		//echo $form->input('Artist.Artist');
		if($requirements['synopsis']>0) echo $form->input('synopsis',array('label'=>__('Synopsis',true),'after'=> ($helpText['synopsis'] ? $html->div('help-text',$helpText['synopsis']) : '')  ));
		
		// If only one section applies, preselect it:
		if(count($sections)==1){
			$sections_empty=null;
		}else{
			$sections_empty=__('- Please select -',true);
		}
		echo $form->input('section_id',array('empty'=>$sections_empty,'after'=> ($helpText['section_id'] ? $html->div('help-text',$helpText['section_id']) : '') ));
		
		if($requirements['notes_artist']>0) echo $form->input('notes_artist',array('label'=>__('Notes',true),'after'=> ($helpText['notes_artist'] ? $html->div('help-text',$helpText['notes_artist']) : '') ) );
		
		//Offer from 2 last years until next:
		//if($requirements['production_year']>0) echo $form->input('production_year',array('type'=>'date','dateFormat'=>'Y','maxYear'=>date('Y')+1,'minYear'=>date('Y')-2));
		if($requirements['production_year']>0) echo $form->input('production_year',array('type'=>'text','after'=> ($helpText['production_year'] ? $html->div('help-text',$helpText['production_year']) : '')));
		
		if($requirements['duration']>0) echo $form->input('duration',array('type'=>'text','label'=>__('Duration (mm:ss)',true),'after'=> ($helpText['duration'] ? $html->div('help-text',$helpText['duration']) : '')));
		
		if($requirements['shooting_format_id']>0) echo $form->input('shooting_format_id',array('empty'=>__('- Please select -',true),'after'=> ($helpText['shooting_format_id'] ? $html->div('help-text',$helpText['shooting_format_id']) : '')) );
		
		if($requirements['ScreeningFormat']>0) echo $form->input('ScreeningFormat',array('label'=>__('Available Screening Formats',true),'multiple'=>'checkbox','after'=> ($helpText['ScreeningFormat'] ? $html->div('help-text',$helpText['ScreeningFormat']) : '')) );

		
		if($requirements['country_id']>0) echo $form->input('country_id',array('empty'=>__('- Please select -',true),'after'=> ($helpText['country_id'] ? $html->div('help-text',$helpText['country_id']) : '')) );
		
		if($requirements['genre']>0) echo $form->input('genre',array('after'=> ($helpText['genre'] ? $html->div('help-text',$helpText['genre']) : '')));
		
		if($requirements['shown_before']>0) echo $form->input('shown_before',array('after'=> ($helpText['shown_before'] ? $html->div('help-text',$helpText['shown_before']) : '')));
		
		?>
		</fieldset>
		<?php if($requirements['preview_how']>0){ ?>
			<fieldset id="preview-copy-selection">
			<legend><?php __('How will we get a preview copy?')?></legend>
			<?php
			if($requirements['preview_how']>0) echo $form->input('preview_how',array(
				'class'=>'preview-copy-radio',
				'type'=>'radio','legend'=>false,
				'options'=>array(
					Piece::$PREVIEW_WAYS['normal_mail']=>__('Via normal Mail (send us a DVD, CD or miniDV tape)',true),
					Piece::$PREVIEW_WAYS['upload']=>__('I want to upload it (in the next step)',true),
					Piece::$PREVIEW_WAYS['online']=>__('It is online anyway (tell us the URL)',true)
				)
			));
			if($helpText['preview_how']) echo $html->div('help-text',$helpText['preview_how']);
			
			if($requirements['preview_url']>0) echo $form->input('preview_url',array('type'=>'text','div'=>array('id'=>'preview-url-field'),'label'=>'please enter the URL where your work can be accessed' ) );
			if($helpText['preview_url']) echo $html->div('help-text',$helpText['preview_url']);
			?>
			<div id="mail-helptext">
			Please 
			<?php echo $html->link(__('click here',true),array('controller'=>'pages','action'=>'display','postal'),array('target'=>'_blank'));?>
			to get our postal address and other mailing information (opens in new window).
			</div>
			</fieldset>
		<?php }; ?>
		<fieldset id="additional-artists">
		<legend><?php __('Who has created this?'); ?></legend>
		<?php echo $form->input('ArtistsPiece.0.function',array('label'=>__('What was your contribution/function to this work?',true),'after'=>__('Should other people be credited as well?',true))); ?>
		<div class="hidable-artists">
		<?php
		echo $form->input('Artist.Artist.1',array('type'=>'hidden'));
		echo $form->input('Add-Artist.1.id',array('type'=>'hidden'));
		echo $form->input('Add-Artist.1.name',array('before'=>__('Additional Artist:',true)));
		echo $form->input('Add-Artist.1.surname');
		echo $form->input('ArtistsPiece.1.function',array('label'=>__('Function',true)) );
		?>
		</div>
		<div class="hidable-artists">
		<?php
		echo $form->input('Artist.Artist.2',array('type'=>'hidden'));
		echo $form->input('Add-Artist.2.id',array('type'=>'hidden'));
		echo $form->input('Add-Artist.2.name',array('before'=>__('Additional Artist:',true)));
		echo $form->input('Add-Artist.2.surname');
		echo $form->input('ArtistsPiece.2.function',array('label'=>__('Function',true)));
		?>
		</div>
		<div class="hidable-artists">
		<?php
		echo $form->input('Artist.Artist.3',array('type'=>'hidden'));
		echo $form->input('Add-Artist.3.id',array('type'=>'hidden'));
		echo $form->input('Add-Artist.3.name',array('before'=>__('Additional Artist:',true)));
		echo $form->input('Add-Artist.3.surname');
		echo $form->input('ArtistsPiece.3.function',array('label'=>__('Function',true)));
		?>
		</div>
	</fieldset>

<?php echo $form->end(__('Continue',true));?>
</div>
