<?php
class FtpAccount extends AppModel {

	var $name = 'FtpAccount';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Artist' => array(
			'className' => 'Artist',
			'foreignKey' => 'artist_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>