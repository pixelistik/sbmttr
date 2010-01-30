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
    	$.get('listFiles/1', function(data) {
			$('#file-list').html(data);
    	});
    }
</script>
