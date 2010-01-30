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
<div id="file-list">

</div>
<script type="text/javascript">                                         
    $(document).ready(function() {
    	refreshFilelist();
    	window.setInterval("refreshFilelist()", 2000);
    });

    function refreshFilelist(){
    	$.get('<?php echo $html->url(array('controller'=>'ftp_accounts','action'=>'listFiles',$account_id)); ?>', function(data) {
			$('#file-list').html(data);
    	});
    }
</script>
