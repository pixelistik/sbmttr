<?php
class UploadsController extends AppController {

	var $name = 'Uploads';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Upload->recursive = 0;
		$this->set('uploads', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Upload.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('upload', $this->Upload->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			// Check if the logged in user is allowed to edit this piece:
			$piece=$this->Upload->Piece->find('first',array('conditions'=>array('Piece.id'=>$this->data['Upload']['piece_id']) ) );
			$allowed=false;
			foreach($piece['Artist'] as $artist){
				$allowed=$allowed || $artist['id'] == $this->Auth->user('id');
			}
			if(!$allowed){
				$this->Session->setFlash(__('You are not logged in or not allowed to edit this piece.', true));
				$this->redirect(array('controller'=>'pieces','action'=>'index'));
			}
			
			$this->Upload->create();
			if ($this->Upload->save($this->data)) {
				//debug(' record saved with id '.$this->Upload->id);
				//debug('Uploaded image file name was '.$this->data['Upload']['content']['name']);
				// Handle the uploaded file:
				// Check for some possible problems:
				$uploadProblems=false;
				$uploadErrorReport='';
				if(empty($this->data['Upload']['content']['name'])){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('You did not choose a file.',true);
				}
				if($this->data['Upload']['content']['size'] > Configure::read('max_file_upload_size') || $this->data['Upload']['content']['error']==1){
					// Error Code 1 means file size exceeds the upload_max_filesize directive in php.ini.
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('The file is too big.',true);
				}
				/* TODO: Type check according to allowed types for corresponding piece type.
				if($this->data['Upload']['content']['type']!='image/jpeg'){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Only jpeg images are allowed.',true).$this->data['Upload']['content']['type'];
				} */
				if($this->data['Upload']['content']['error'] != 0){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Upload Error.',true);
				}
				// Now move the uploaded file into the right folder:
				if(!$uploadProblems){
					// Extract file extension:
					preg_match("/\.([^\.]+)$/", $this->data['Upload']['content']['name'], $matches);
					$this->data['Upload']['extension']=$matches[1];
					$uploadPath=APP.'..'.DS.'uploads'.DS.sprintf('%05d',$this->data['Upload']['piece_id']).DS;
					// Try to create the Piece directory (might already exist)
					mkdir($uploadPath);
					move_uploaded_file($this->data['Upload']['content']['tmp_name'],sprintf('%s%05d.%s',$uploadPath,$this->Upload->id,$this->data['Upload']['extension']));
					$this->Upload->save($this->data); // Update extension
					$this->Session->setFlash(__('The Upload has been saved.', true));
				}else{
					// Delete the record again, because there is no corresponding file now:
					$this->Upload->del($this->Upload->id);
					$this->Session->setFlash(__('Image Error. The Upload could not be created', true).$uploadErrorReport);
				}
				$this->redirect(array('controller'=>'uploads','action'=>'view',$this->Upload->id));
			} else {
				$this->Session->setFlash(__('The Upload could not be saved. Please, try again.', true));
			}
		}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Upload', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Upload->save($this->data)) {
				$this->Session->setFlash(__('The Upload has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Upload could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Upload->read(null, $id);
		}
		$pieces = $this->Upload->Piece->find('list');
		$this->set(compact('pieces'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Upload', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Upload->del($id)) {
			$this->Session->setFlash(__('Upload deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>