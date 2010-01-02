<?php
class Upload extends AppModel {

	var $name = 'Upload';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Piece' => array(
			'className' => 'Piece',
			'foreignKey' => 'piece_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>