<?php
class Tag extends AppModel {

	var $name = 'Tag';
	var $validate = array(
		'title' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Piece' => array(
			'className' => 'Piece',
			'joinTable' => 'pieces_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'piece_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>