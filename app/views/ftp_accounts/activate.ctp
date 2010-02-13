<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
?>
<h2><?php __('FTP File Upload');?></h2>
<p>
<?php __('With FTP, you can upload big files more easily. You will need an FTP program for this.'); ?>
</p>
<?php 
echo $form->create(array('action'=>'activate'));
echo $form->hidden('piece_id');
echo $form->end(__('Give me an FTP account',true));

?>