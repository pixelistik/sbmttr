<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
?>
<?php 
if(!empty($files)):
?>
	<ul>
	<?php 
	foreach($files as $file):
	?>
	<li><?php echo $file; ?></li>
	<?php
	endforeach;
	?>
	</ul>
<?php 
else:
?>
<p>No uploaded files found</p>
<?php endif; ?>