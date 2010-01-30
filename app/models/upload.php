<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
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
	
	function getFilePath($id){
		$upload=$this->findById($id);
		$uploadFolder=APP.'..'.DS.'uploads'.DS.sprintf('%05d',$upload['Upload']['piece_id']).DS;
		$path=sprintf('%s%05d.%s',$uploadFolder,$upload['Upload']['id'],$upload['Upload']['extension']);
		return($path);
	}

}
?>