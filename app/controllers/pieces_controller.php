<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class PiecesController extends AppController {
	var $name = 'Pieces';
	var $helpers = array('Html', 'Form','Javascript');
	var $components=array('Auth','StringHelpers');
	
	// Default pagination settings:
	var $paginate= array(
		'limit'=>20,
		'order'=>array(
			'Piece.created'=>'desc'
			)
		);

	function index() {
		$this->Piece->Artist->recursive = 2;
		// Find the logged in Artist, then set his/her pieces for display:
		$this->set('pieces', $this->Piece->Artist->find('first',array('conditions'=> array('Artist.id'=>$this->Auth->user('id')) ) ));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Piece.', true));
			$this->redirect(array('action'=>'index'));
		}
		$piece=$this->Piece->find('first',array('conditions'=>array('Piece.id'=>$id) ) );
		$this->set('piece',$piece);
		// Check if artist is allowed to view this piece:
		/* $allowed=false;
		foreach($piece['Artist'] as $artist){
			$allowed= $allowed || $artist['id'] == $this->Auth->user('id');
		}
		
		if(!$allowed){
			$this->Session->setFlash(__('Invalid Piece.', true));
			$this->redirect(array('action'=>'index'));
		}
		*/
		//Retrieve rules for the selected media type:
		$requirements=$this->Piece->Type->Requirement->find('all',array('recursive'=>0,'conditions'=>'Requirement.type_id='.$piece['Piece']['type_id']));
		$temp_requirements=array();
		foreach($requirements as $requirement){
			$temp_requirements[$requirement['Requirement']['info_title']]=$requirement['Requirement']['kind'];
		}
		$this->set('requirements',$temp_requirements);
	}
	
	function search(){
		// If data was passed from form, change it to named GET parameters and run again.
		// We always want the parameters in the URL so we can save the search!
		if(!empty($this->data)){
			$this->redirect('search/'.$this->serializeData($this->data['Piece']));
		}
		
		// Build the conditions from named parameters:
		$conditions=array();
		if(!empty($this->params['named']['type_id'])) $conditions['and']['Piece.type_id']=$this->params['named']['type_id'];
		if(!empty($this->params['named']['section_id'])) $conditions['and']['Piece.section_id']=$this->params['named']['section_id'];
		// 'title' will search in both english and original:
		if(!empty($this->params['named']['any_title'])) $conditions['and']['or']['Piece.original_title LIKE']='%'.$this->params['named']['any_title'].'%';
		if(!empty($this->params['named']['any_title'])) $conditions['and']['or']['Piece.english_title LIKE']='%'.$this->params['named']['any_title'].'%';
		
		$pieces=$this->paginate('Piece',$conditions);
		$this->set('pieces',$pieces);
		$this->set('sections',$this->Piece->Section->find('list'));
		$this->set('types',$this->Piece->Type->find('list'));
		
		$this->params['named']=$this->serializeData($this->data);
		// Load the saved searches for display:
		$this->loadModel('Search');
		$this->set('searches',$this->Search->find('list'));
	}
	
	

	function add(){
		// Check and read preset type, either from Session or from URL parameter:
		$type_preset=null;
		if(!empty($this->params['pass'][0])) $this->Session->write('type_id_preset',$this->params['pass'][0]);
		if($this->Session->check('type_id_preset') ) $type_preset=$this->Session->read('type_id_preset');
		// If no media type parameter is given or any form data is passed,
		// redirect to type listing:
		if($type_preset==null){
			$this->redirect(array('controller'=>'Types','action'=>'select'));
		}
		// Check if a user is already logged in:
		$current_user=$this->Auth->user();
		if(empty($current_user)){
			$this->redirect(array('controller'=>'Artists','action'=>'add'));
		}
		// If form data is present, try to write it:
		if (!empty($this->data)) {
			pr('Data from the form:');
			pr($this->data);
			
			// Check URL for completeness:
			if(!empty($this->data['Piece']['preview_url'])){
				$this->data['Piece']['preview_url']=$this->StringHelpers->completeURL($this->data['Piece']['preview_url']);
			}
			
			$this->Piece->create();
			// Set logged in user as artist:
			$this->data['Artist']['Artist'][0]=$this->Auth->user('id');
			// Save the additional artists:
			// Select the corresponding validation set:
			$this->Piece->Artist->setValidation('additionalArtist');
			foreach($this->data['Add-Artist'] as $key=>$artist){
				$this->Piece->Artist->create();
				pr('Trying to save add. artist '.$key);
				pr($artist);
				if($this->Piece->Artist->save($artist)){
					// Link the new Artist to the piece:
					$this->data['Artist']['Artist'][$key]=$this->Piece->Artist->id;
					// Also write the id back to add-artist, so it is not created again if resubmitted:
					$this->data['Add-Artist'][$key]['id']=$this->Piece->Artist->id;
					pr('success '.$key);
					//pr($this->Piece->ArtistsPiece);
				} // TODO: Bei Fehler sinnvolle Nachricht. Validation?
			}
			
			pr('Data after saving add. artists:');
			pr($this->data);
			
			if ($this->Piece->save($this->data)) {
				pr('Piece saved with id '.$this->Piece->id);
				// Now we still need to write additional info to the join model:
				foreach($this->data['Artist']['Artist'] as $key=>$artist_id){
					if(!empty($artist_id)){
						// Find the join for piece and artist:
						$join=$this->Piece->ArtistsPiece->find('first',array('conditions'=>array('artist_id'=>$artist_id,'piece_id'=>$this->Piece->id) ));
						pr('Join id: '.$join['ArtistsPiece']['id']);
						// and attach the additional data to this join:
						//    The artists function for this piece:
						$join['ArtistsPiece']['function']=$this->data['ArtistsPiece'][$key]['function'];
						//    The logged in artist shall be the main contact:
						if($artist_id==$this->Auth->user('id'))$join['ArtistsPiece']['is_main_contact']=true;
						if($this->Piece->ArtistsPiece->save($join))pr('joins updated');
					}
				}
				// Session preset type can now be erased:
				$this->Session->del('type_id_preset');
				// Redirect to uploads, if any upload is possible for this type
				$uploadsPossible=$this->Piece->Type->Requirement->find('count',array('recursive'=>0,'conditions'=>array(
					'Requirement.type_id'=>$this->data['Piece']['type_id'],
					'Requirement.info_title LIKE'=>'Uploads.%',
					'Requirement.kind >'=>0
				)));
				if($uploadsPossible>0){
					$this->Session->setFlash(
						sprintf(
							__('Your submission has been saved. Please note the submission number #%s. You can add files now.', true),
							$this->Piece->id		
						)
					);
					$this->redirect(array('controller'=>'uploads','action'=>'add',$this->Piece->id));
				}else{
					// Just display the piece:
					$this->Session->setFlash(__('Your submission has been saved. Thank you. Here is an overview for printing/saving', true));
					$this->Session->setFlash(
						sprintf(
							__('Your submission has been saved. Please note the submission number #%s. Here is an overview for printing/saving', true),
							$this->Piece->id		
						)
					);
					$this->redirect(array('action'=>'view',$this->Piece->id));
				}
			} else {
				$this->Session->setFlash(__('Something is wrong or missing. Please check the error messages below the input fields.', true));
			}
		}		
		
		// If no data is submitted, but a type is set, preselect the type in $this->data:
		if( !empty($type_preset) && empty($this->data) ){
			$type=$this->Piece->Type->find('first',array('recursive'=>0,'conditions'=>array('title'=>$type_preset)));
			// If selected type does not exist, redirect to type listing:
			if(empty($type)) $this->redirect(array('controller'=>'Types','action'=>'select'));
			// Preselect the type for hidden input in view:
			$this->data['Piece']['type_id']=$type['Type']['id'];
			// $validate need to be build, so the view can add
			// CSS class "required":
			$this->Piece->buildValidate($type['Type']['id']);
		}
		// Now set info for view:
		$screeningFormats = $this->Piece->ScreeningFormat->find('list');
		$tags = $this->Piece->Tag->find('list');
		// Only show sections that are open for the selected type:
		$sections = $this->Piece->Section->find('list',array('conditions'=>array(
			'Section.type_id'=>$this->data['Piece']['type_id'],
			'Section.opening_date <'=>date('Y-m-d H:i:s'),
			'Section.closing_date >'=>date('Y-m-d H:i:s')
		 )));
		$shootingFormats = $this->Piece->ShootingFormat->find('list');
		$countries = $this->Piece->Country->find('list');

		//Retrieve rules for the selected media type:
		$requirements=$this->Piece->Type->Requirement->find('all',array('recursive'=>0,'conditions'=>'Requirement.type_id='.$this->data['Piece']['type_id']));
		$temp_requirements=array();
		$helpText=array(); // Help text for every form field can be different for all types. Is read from database.
		foreach($requirements as $requirement){
			$temp_requirements[$requirement['Requirement']['info_title']]=$requirement['Requirement']['kind'];
			$helpText[$requirement['Requirement']['info_title']]=$requirement['Requirement']['detailed_description'];
		}
		$requirements=$temp_requirements;
		$this->set(compact('screeningFormats', 'tags', 'sections', 'shootingFormats', 'countries','requirements','helpText'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Piece', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Piece->save($this->data)) {
				$this->Session->setFlash(__('The Piece has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Piece could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Piece->read(null, $id);
		}
		$artists = $this->Piece->Artist->find('list');
		$screeningFormats = $this->Piece->ScreeningFormat->find('list');
		$tags = $this->Piece->Tag->find('list');
		$types = $this->Piece->Type->find('list');
		$sections = $this->Piece->Section->find('list');
		$shootingFormats = $this->Piece->ShootingFormat->find('list');
		$countries = $this->Piece->Country->find('list');
		$this->set(compact('artists','screeningFormats','tags','types','sections','shootingFormats','countries'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Piece', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Piece->del($id)) {
			$this->Session->setFlash(__('Piece deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	function beforeFilter(){
		// Do standards:
		parent::beforeFilter();
		// Some actions are accessible without login:
		$this->Auth->allow('add'); // add does some checks on its own..
		
	}
	
	function isAuthorized(){
		// A list of all user accessible actions of this controller.
		// There are 2 levels of access that can be assigned:
		// loggedIn = it is enough to be simply logged in
		// loggedInPieceBelongs = Additionally,
		// 			we check if the piece with the passed id
		//			really belongs to the artist.
		// All other actions are only for admins.
		$access=array(
			'delete'=>'loggedInPieceBelongs',
			'edit'=>'loggedInPieceBelongs',
			'view'=>'loggedInPieceBelongs',
			'index'=>'loggedIn',
			);
		
		if(!empty($access[$this->action])){
			// Get logged in user:
			$currentArtist=$this->Auth->user();
			// Here comes the checking:
			switch($access[$this->action]){
				case 'loggedIn':
					// Auth has already made sure we are logged in.
					return true;
				break;
				case 'loggedInPieceBelongs':
					if(
						// We look directly at the join model to check if artist and piece match:
						$this->Piece->ArtistsPiece->find('count',array('conditions'=> array(
							'piece_id'=>$this->params['pass'][0],
							'artist_id'=> $currentArtist['Artist']['id']
							) ) ) > 0
						)
					return true;
				break;
			}
		}
		// Ask parent if no rule found so far:
		return parent::isAuthorized();
	}


}
?>