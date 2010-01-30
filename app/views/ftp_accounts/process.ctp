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
				for(var i=0;i<data.loading.length;i++){
					loadingList+='<li>'+data.loading[i].filename+'</li>';
				}
				loadingList+='</ul>';
			}
			$('#loading-list').html(loadingList);
			
			/* Create fieldset for every new finished file. */
			if(data.finished){
				for(var i=0;i<data.finished.length;i++){
					if(!$('#'+data.finished[i].hash).length>0){
						$('#finished-form').append('<p id="'+data.finished[i].hash+'">'+data.finished[i].filename+'</p>');						
					}
				}
			}
    	});
    }
</script>
