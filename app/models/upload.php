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
	
	function getFilePath($id){
		$upload=$this->findById($id);
		$uploadFolder=APP.'..'.DS.'uploads'.DS.sprintf('%05d',$upload['Upload']['piece_id']).DS;
		$path=sprintf('%s%05d.%s',$uploadFolder,$upload['Upload']['id'],$upload['Upload']['extension']);
		return($path);
	}

}
?>