<?php
class ScreeningFormat extends AppModel {

	var $name = 'ScreeningFormat';
	var $validate = array(
		'name' => array('minlength'=>array(
				'rule' => array('minLength',3) 
				)
			)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Piece' => array(
			'className' => 'Piece',
			'joinTable' => 'pieces_screening_formats',
			'foreignKey' => 'screening_format_id',
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