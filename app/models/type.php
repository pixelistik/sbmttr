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
	/**
	 * Builds the $validate variable from database for other models
	 * 
	 * @param int $id
	 */
	function buildModelValidates($id){
		// Retrieve Type
		$type=$this->find('first',array(
			'conditions'=>'Type.id='.$id,
			'recursive'=>-1
		));
		// Set rules for every field of this model
		$fields=$this->schema();
		foreach($fields as $fieldName=>$fieldDetails){
			// The part up to the first _ is the model name
			// @todo this breaks with multiple-word models
			$modelName=Inflector::camelize(
				substr($fieldName,0,strpos($fieldName,'_'))
			);
			// The rest, minus "_required" at the end is the field name
			$modelFieldName=substr($fieldName,strpos($fieldName,'_')+1,-9);
			// Level 3 required fields are a must
			$result[$modelName][$modelFieldName]['required']= $type['Type'][$fieldName]==3;
			// Other levels: may be empty
			$result[$modelName][$modelFieldName]['allowEmpty']= $type['Type'][$fieldName]!=3;
		}
		return $result;	
	}

}
?>