<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
class PicturesController extends AppController {

	var $name = 'Pictures';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');
	function index() {
		$this->Picture->recursive = 0;
		$this->set('pictures', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Picture.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('picture', $this->Picture->read(null, $id));
	}

	function add($piece_id=null) {
		// TODO: Add proper error handling: too big? wrong format?
		// Check if either data or an ID was passed:
		if(empty($this->data) && $piece_id==null){
			$this->redirect(array('controller'=>'pieces','action'=>'index'));
		}
		// Read id from form data, if present:
		if (!empty($this->data)) $piece_id=$this->data['Picture']['piece_id'];
		// Check if the logged in user is allowed to edit this piece:
		$piece=$this->Picture->Piece->find('first',array('conditions'=>array('Piece.id'=>$piece_id) ) );
		$allowed=false;
		foreach($piece['Artist'] as $artist){
			$allowed= $allowed || $artist['id'] == $this->Auth->user('id');
		}
		if(!$allowed){
			$this->Session->setFlash(__('You are not logged in or not allowed to edit this piece.', true));
			$this->redirect(array('controller'=>'pieces','action'=>'index'));
		}
		
		if (!empty($this->data)) {
			$this->Picture->create();
			// Handle the uploaded image:
			// Check for some possible problems:
			$uploadProblems=false;
			$uploadErrorReport='';
			if(empty($this->data['Picture']['content']['name'])){
				$uploadProblems=true;
				$uploadErrorReport=$uploadErrorReport.' '.__('You did not choose a file.',true);
			}
			if($this->data['Picture']['content']['size'] > Configure::read('max_picture_size') || $this->data['Picture']['content']['error']==1){
				// Error Code 1 means file size exceeds the upload_max_filesize directive in php.ini.
				$uploadProblems=true;
				$uploadErrorReport=$uploadErrorReport.' '.__('The image file is too big.',true);
			}
			if($this->data['Picture']['content']['type']!='image/jpeg'){
				$uploadProblems=true;
				$uploadErrorReport=$uploadErrorReport.' '.__('Only JPEG images are allowed.',true).$this->data['Picture']['content']['type'];
			}
			if($this->data['Picture']['content']['error'] != 0){
				$uploadProblems=true;
				$uploadErrorReport=$uploadErrorReport.' '.__('Upload Error.',true);
			}
			
			if(!$uploadProblems && is_uploaded_file($this->data['Picture']['content']['tmp_name']) ){
				// Assign some info:
				$this->data['Picture']['size']=$this->data['Picture']['content']['size'];
				$this->data['Picture']['type']=$this->data['Picture']['content']['type'];
				$this->data['Picture']['name']=$this->data['Picture']['content']['name'];
				// Read data from temp file:
				$fileData = fread(fopen($this->data['Picture']['content']['tmp_name'], "r"),$this->data['Picture']['content']['size']);
				$this->data['Picture']['content']=$fileData;
				// Now try to save:
				if ($this->Picture->save($this->data)) {
					$this->Session->setFlash(__('The Picture has been saved. Add another one, if you like.', true));
					// Go to submit next image:
					$this->redirect(array('controller'=>'pictures','action'=>'add',$piece_id));
				} else {
					$this->Session->setFlash(__('The Picture could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__('Image Error:', true).$uploadErrorReport);
			}
			
			
		}
		// Hand id of the corresponding form over to the view:
		$this->set('piece_id',$piece_id);
		$this->set('piece',$piece);
		// Give the form the description for images from requirements (from database):
		$this->set('imageDescription',$this->Picture->Piece->Type->Requirement->field('detailed_description',array('and'=>array('Requirement.type_id'=>$piece['Type']['id'],'Requirement.info_title'=>'Pictures')))  );
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Picture', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Picture->del($id)) {
			$this->Session->setFlash(__('Picture deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function download($id){
		// TODO: Verify the user is allowed to access this picture!
		$picture=$this->Picture->findById($id);
		
		header('Content-type: ' . $picture['Picture']['type']);
		header('Content-length: ' . $picture['Picture']['size']);
		header('Content-Disposition: attachment; filename="'.$picture['Picture']['name'].'"');
		
		echo $picture['Picture']['content'];
		// Don't render any view:
		exit();
	}
	
	function beforeFilter(){
		// Do standards:
		parent::beforeFilter();
		
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
			'add'=>'loggedInPieceBelongs',
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
						$this->Picture->Piece->ArtistsPiece->find('count',array('conditions'=> array(
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