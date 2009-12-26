<?php
class Piece extends AppModel {

	var $name = 'Piece';
	var $uses=array('Piece','Type');
	var $order='Piece.id DESC';
	//Validation rules. required is set to none everywhere
	//Additional rules for required and allowEmpty are loaded in beforeValidate(),
	//depending on the submitted type!
	//App::import('Core','i18n');
	var $validate=array(
		'original_title' => array(
			'rule'=>'notEmpty',
			'required'=>false,
			'allowEmpty'=>true,
			'message'=>'Please enter the title of your work'
			),
		'english_title' => array(
			'rule'=>'notEmpty',
			'required'=>false,
			'allowEmpty'=>true,
			'message'=>'Please enter an english translation of you works title'
			),
		'synopsis' => array(
			'rule'=>array('minLength',10),
			'required'=>false,
			'allowEmpty'=>true,
			'message'=>'Please enter a brief abstract of your work.'
			),
		'production_year' => array(
			'required'=>false,
			'allowEmpty'=>true,
			'rule'=>'numeric',
			'message'=>'Enter the year your work was finished, please'
			),
		'genre' => array(
			'required'=>false,
			'allowEmpty'=>true,
			'rule'=>array('minLength',4),
			'message'=>'Please write down a genre your work would roughly belong to'
			),
		'shown_before' => array(
			'required'=>false,
			'allowEmpty'=>true,
			'rule'=>array('notEmpty'),
			'message'=>'Please describe when and where your work has been presented to the public before'
			),
		'type_id' => array(
			'required'=>false,
			'allowEmpty'=>true,
			'rule'=>'numeric',
			
			),
		'ScreeningFormat' => array(
			'required'=>false,
			'allowEmpty'=>true,
			'rule'=>array('selectMin',1),
			'message'=>'Please select at least one screening format you can provide'
			),
		'preview_url' => array(
			'required'=>false,
			'allowEmpty'=>true,
			'rule'=>array('url',true),
			'message'=>'The URL does not look like a valid web address'
			),
		);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ShootingFormat' => array(
			'className' => 'ShootingFormat',
			'foreignKey' => 'shooting_format_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Picture' => array(
			'className' => 'Picture',
			'foreignKey' => 'piece_id',
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

	var $hasAndBelongsToMany = array(
		'Artist' => array(
			'className' => 'Artist',
			'joinTable' => 'artists_pieces',
			'foreignKey' => 'piece_id',
			'associationForeignKey' => 'artist_id',
			'unique' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'ScreeningFormat' => array(
			'className' => 'ScreeningFormat',
			'joinTable' => 'pieces_screening_formats',
			'foreignKey' => 'piece_id',
			'associationForeignKey' => 'screening_format_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'pieces_tags',
			'foreignKey' => 'piece_id',
			'associationForeignKey' => 'tag_id',
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
	
	function beforeValidate(){
		// $validate needs to be built from database before validation can take place:
		$this->buildValidate($this->data['Piece']['type_id']);
		return(true);
	}
	
	function buildValidate($type_id){
		// Builds the $validate variable from database, according to given type of piece
		$requirements=$this->Type->find('first',array(
			'conditions'=>'Type.id='.$type_id
			));
		foreach($requirements['Requirement'] as $requirement){
			//If Requirement has type 2 (must) set as required:
			$this->validate[$requirement['info_title']]['required']= ($requirement['kind']==2);
			//If Requirement has type 0 (no) or 1 (optional), allow empty:
			$this->validate[$requirement['info_title']]['allowEmpty']= ($requirement['kind']==0 || $requirement['kind']==1);
			//If no rule is set in the model, set at least a "NotEmpty" one, to prevent error:
			if(!isset($this->validate[$requirement['info_title']]['rule'])) $this->validate[$requirement['info_title']]['rule']='notEmpty';
		}
	}
	
	function selectMin($data,$min){
		//TODO
		debug('called!');
		debug($data);
		return(true);
	}
}
?>