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
	
	var $validate=array(
		'extension'=>array(
			'allowedType'=>array(
				'rule'=>array('matchingExtension')
			)
		)
	);
/**
 * Custom validation: Check if the extension matches one of the allowed file types for the given Piece.
 * 
 * @param array $check The field to validate. 
 */	
	function matchingExtension($check){
		return in_array(strtolower($check['extension']),$this->_getAllowedFiletypes($this->data['Upload']['piece_id']));
	}
/**
 * Returns the local path to the uploaded file.
 * 
 * The path is constructed from a base path from config, a subfolder for every 
 * Piece (its ID) and the actual filename of the Upload (ID plus extension)
 * 
 * @param $id
 */	
	function getFilePath($id){
		$upload=$this->findById($id);
		$uploadFolder=APP.'..'.DS.'uploads'.DS.sprintf('%05d',$upload['Upload']['piece_id']).DS;
		$path=sprintf('%s%05d.%s',$uploadFolder,$upload['Upload']['id'],$upload['Upload']['extension']);
		return($path);
	}
	
/**
 * Returns an array of all file extensions that can be uploaded to the given Piece.
 * 
 * Information is retrieved from the Requirements of the Type of the Piece
 *  
 * @param int $piece_id ID of an existing Piece.
 */	
	function _getAllowedFiletypes($piece_id){
		// Retrieve the upload requirements for the type of the give piece:
		$type_id=$this->Piece->field('type_id',array('Piece.id'=>$piece_id) );
		$requirements=$this->Piece->Type->Requirement->find('all',array('conditions'=>array(
			'Requirement.type_id'=>$type_id,
			'Requirement.info_title'=>array('Uploads.image','Uploads.document','Uploads.video'),
			'Requirement.kind'=>array(1,2)
		)));
		$allowed_filetypes=array();
		foreach($requirements as $requirement){
			$allowed_filetypes=array_merge(
				$allowed_filetypes,
				Configure::read(
					'accepted_file_extensions.'.substr($requirement['Requirement']['info_title'],8)
				)
			);
		}
		return $allowed_filetypes;
	}

}
?>