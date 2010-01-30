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
	<h3><?php echo count($files); ?> files found</h3>
	<ul>
	<?php 
	foreach($files as $file):
	?>
	<li><?php echo $file['filename'].' ('.$file['status'].')'; ?></li>
	<?php
	endforeach;
	?>
	</ul>
<?php 
else:
?>
<h3>No uploaded files found</h3>
<?php endif; ?>