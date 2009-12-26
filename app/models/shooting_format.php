<?php
class ShootingFormat extends AppModel {

	var $name = 'ShootingFormat';
	var $validate = array(
		'name' => array(
			'minlength'=>array(
				'rule' => array('minLength',3) 
				)
			)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Piece' => array(
			'className' => 'Piece',
			'foreignKey' => 'shooting_format_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>