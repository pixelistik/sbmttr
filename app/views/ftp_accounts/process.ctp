<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
echo $javascript->link('jquery.min',false);
?>
<div id="loading-list">
</div>
<div id="finished-form">
<form id="UploadAddForm" method="post" action="/sbmttr/uploads/add">
	<fieldset style="display:none;">
		<input type="hidden" name="_method" value="POST" />
	</fieldset>
	<div id="dynamic-inputs"></div>
	<div class="submit">
		<input type="submit" value="Save files" id="submit-button" disabled="disabled" />
	</div>
</form>
</div>
<script type="text/javascript">                                         
    $(document).ready(function() {
    	refreshFilelist();
    	window.setInterval("refreshFilelist()", 2000);
    });

    function refreshFilelist(){
    	$.getJSON('<?php echo $html->url(array('controller'=>'ftp_accounts','action'=>'listFiles',$account_id)); ?>', function(data) {
			/* Refresh list of unfinished files */
			var loadingList='<ul>';
			if(data.loading){
				$('#submit-button').attr('disabled','disabled');
				for(var i=0;i<data.loading.length;i++){
					loadingList+='<li>'+data.loading[i].filename+'</li>';
				}
				loadingList+='</ul>';
			}else{
				$('#submit-button').attr('disabled','');
			}
			$('#loading-list').html(loadingList);
			
			/* Create fieldset for every new finished file. (check if hash already exists) */
			if(data.finished){
				for(var i=0;i<data.finished.length;i++){
					if(!$('#'+data.finished[i].hash).length>0){
						$('#dynamic-inputs').append(generateFieldset(
								$('fieldset.finished').length,
								data.finished[i].filename,
								data.finished[i].hash,
								<?php echo $piece_id; ?>
								));						
					}
				}
			}
    	});
    }
    
	function generateFieldset(i,filename,hash,piece_id){
		var html='<fieldset id="'+hash+'" class="finished"><legend>'+filename+'</legend><input type="hidden" name="data[Upload]['+i+'][piece_id]" type="text" maxlength="5" value="'+piece_id+'" id="Upload'+i+'PieceId" /><input type="hidden" name="data[Upload]['+i+'][filename]" value="'+filename+'" id="Upload'+i+'Filename" /><div class="input text"><label for="Upload'+i+'Description">Beschreibung</label><input name="data[Upload]['+i+'][description]" type="text" maxlength="512" value="" id="Upload'+i+'Description" /></div></fieldset>';
	return html;
    }
</script>
