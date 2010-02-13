<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class Type extends AppModel {

	var $name = 'Type';
	//var $actsAs=array('Translate'=>array('terms') );
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Piece' => array(
			'className' => 'Piece',
			'foreignKey' => 'type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Requirement' => array(
			'className' => 'Requirement',
			'foreignKey' => 'type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'type_id',
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