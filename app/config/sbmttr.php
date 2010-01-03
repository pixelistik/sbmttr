<?php
// Maximum size for user uploaded pictures (bytes):
$config['max_file_upload_size']=524288;
$config['organisation_name']='Sample Organisation';
$config['organisation_email_domain']='sample.organisation.tld';
$config['header-title']='Sample Submissions';
// Accepted file extensions for different upload types:
$config['accepted_file_extensions']=array(
	'image'=>array(
		'jpg',
		'jpeg',
		'gif',
		'png',
		'tif',
		'tiff'
		),
	'document'=>array(
		'pdf',
		'doc'
		),
	'video'=>array(
		'avi',
		'mov'
		)
	)
?>