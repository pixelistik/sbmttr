<?php
class Artist extends AppModel {

	var $name = 'Artist';
	var $actsAs='MultiValidatable';
	// Only these field can be saved by default 
	// (we must protect the is_admin field against form manipulation):
	var $whitelist=array(
		'id',
		'name',
		'surname',
		'email',
		'url',
		'picture',
		'password',
		'recovery_token',
		'recovery_token_expires',
		);
	
	// Standard Validation:
	var $validate=array(
		'name' => array(
			'length'=>array(
				'rule'=>array('minLength',2),
				'required'=>true
				)
			),
		'surname' => array(
			'length'=>array(
				'rule'=>array('minLength',2),
				'required'=>true
				)
			),
		'email' => array(
			'emailFormat'=>array(
				'rule'=>'email',
				'required'=>true
				),
			'emailUnique'=>array(
				'rule'=>'isUnique'
				)
			),
		//URL can be empty, but if given, it should be valid:
		'url' => array(
			'urlFormat'=>array(
				'rule'=>'url',
				'required'=>false,
				'allowEmpty'=>true
				)
			),
		'password'=>array(
			'length'=>array(
				'rule'=>array('minlength',6),
				'required'=>false,
				'allowEmpty'=>false
				)
			)
		);
	// Other Validation arrays (used via MultiValidatable behaviour).
	// Different validations are needed for different situations:
	var $validationSets=array(
		'additionalArtist'=>array(
			'name' => array(
				'required'=>false,
				'message'=>'Please enter a name'
			),
			'surname' => array(
				'rule'=>array('minLength',2),
				'required'=>false,
				'message'=>'Please enter a name'
				),
			'email' => array(
				'email'=>array(
					'rule'=>'email',
					'required'=>false,
					'message'=>'Please enter a valid email address'
					),
				'unique'=>array(
					'rule'=>'isUnique',
					'message'=>'Your Email Address is already registered. If you forgot you password, please click on login and use the \'Forgot Password\' function.'
					)
				),
			//URL can be empty, but if given, it should be valid:
			'url' => array(
				'rule'=>'url',
				'required'=>false,
				'allowEmpty'=>true,
				'message'=>'Please enter a valid URL'
				),
			'password'=>array(
				'rule'=>array('minlength',6),
				'message'=>'A password must be at least 6 characters long',
				'required'=>false,
				'allowEmpty'=>false
				)
			),
		'login'=>array(
			'email' => array(
				'required'=>true
				),
			'password'=>array(
				'required'=>true
				)
			),
		'changePassword'=>array(
			'password'=>array(
				'rule'=>array('minlength',6),
				'message'=>'A password must be at least 6 characters long',
				'required'=>true,
				'allowEmpty'=>false
				)
			)
		);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Piece' => array(
			'className' => 'Piece',
			'joinTable' => 'artists_pieces',
			'foreignKey' => 'artist_id',
			'associationForeignKey' => 'piece_id',
			'unique' => false,
		)
	);

}
?>