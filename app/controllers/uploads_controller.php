<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class UploadsController extends AppController {

	var $name = 'Uploads';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');
/*
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
	} */

	function add($piece_id=null) {
		// Check if piece is specified an hand it back to view:
		if (!$piece_id){
			$this->Session->setFlash(__('No piece specified.', true));
			$this->redirect(array('controller'=>'pieces','action'=>'index'));;
		}else{
			$this->set('piece_id',$piece_id);
		}
		// Retrieve the piece
		$piece=$this->Upload->Piece->find('first',array('conditions'=>array('Piece.id'=>$piece_id) ) );
		$allowed_filetypes=$this->Upload->_getAllowedFiletypes($piece_id);
		$this->set('allowed_filetypes',$allowed_filetypes);
		
		if (!empty($this->data)) {
			// Write piece id into data:
			$this->data['Upload']['piece_id']=$piece_id;
			// Check if the logged in user is allowed to edit this piece:
			if(!
				$this->Upload->Piece->artistHasAccess(
					$this->data['Upload']['piece_id'],
					$this->Auth->user('id')
				)
			){
				$this->Session->setFlash(__('You are not logged in or not allowed to edit this piece.', true));
				$this->redirect(array('controller'=>'pieces','action'=>'index'));
			}
			// Extract file extension:
			preg_match("/\.([^\.]+)$/", $this->data['Upload']['file']['name'], $matches);
			$this->data['Upload']['extension']=$matches[1];
			$this->Upload->create();
			if ($this->Upload->save($this->data)) {
				// Handle the uploaded file:
				// Check for some possible problems:
				$uploadProblems=false;
				$uploadErrorReport='';
				if(empty($this->data['Upload']['file']['name'])){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('You did not choose a file.',true);
				}
				if($this->data['Upload']['file']['size'] > Configure::read('max_file_upload_size') || $this->data['Upload']['file']['error']==1){
					// Error Code 1 means file size exceeds the upload_max_filesize directive in php.ini.
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('The file is too big.',true);
				}
				if($this->data['Upload']['file']['error'] != 0){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Upload Error.',true);
				}
				// Now move the uploaded file into the right folder:
				if(!$uploadProblems){
					$uploadPath=Configure::read('upload-storage-root').sprintf('%05d',$this->data['Upload']['piece_id']).DS;
					// Try to create the Piece directory (might already exist)
					@mkdir($uploadPath);
					// @todo Handle error if moving fails
					move_uploaded_file($this->data['Upload']['file']['tmp_name'],sprintf('%s%05d.%s',$uploadPath,$this->Upload->id,$this->data['Upload']['extension']));
					$this->Upload->save($this->data); // Update extension
					$this->Session->setFlash(__('The Upload has been saved.', true));
					$this->redirect(array('controller'=>'pieces','action'=>'view',$this->data['Upload']['piece_id']));
				}else{
					// Delete the record again, because there is no corresponding file now:
					$this->Upload->del($this->Upload->id);
					$this->Session->setFlash(__('Error! The Upload could not be created.', true).$uploadErrorReport);
				}
			} else {
				$this->Session->setFlash(__('The Upload could not be saved. Please, try again.', true));
			}
		}

	}
	
/**
 * Creates db records for files uploaded via FTP and moves them into the right folder.
 * 
 * @param int $ftp_account_id ID of the FTP account from which the files were uploaded
 * @todo Authority checks: does the ftp account belong to the current user?
 * @todo Check file types
 */	
	function addFromFtp($ftp_account_id){
		debug($this->data);
		debug($this->Upload->Piece->Artist->FtpAccount->_getFolderPath($ftp_account_id));
		foreach($this->data['Upload'] as $upload){
			debug('Saving '.$upload['filename']);
			// Check access:
			if(!
					$this->Upload->Piece->artistHasAccess(
						$upload['piece_id'],
						$this->Auth->user('id')
					)
				){
					$this->Session->setFlash(__('You are not logged in or not allowed to edit this piece.', true));
					$this->redirect(array('controller'=>'pieces','action'=>'index'));
				}
			// Extract file extension:
			preg_match("/\.([^\.]+)$/", $upload['filename'], $matches);
			$upload['extension']=$matches[1];
			// Create record
			$this->Upload->create();
			// Save record
			if($this->Upload->save($upload)){
				$uploadProblems=false;
				$uploadErrorReport='';
				// @todo Error reports should be collected for all files, not overwriting each other.
				// Check if too big
				if(
					filesize(
						$this->Upload->Piece->Artist->FtpAccount->_getFolderPath($ftp_account_id).
						$upload['filename']
					) > Configure::read('max_ftp_upload_size')
				){
					$uploadProblems=true;
					$uploadErrorReport.='The file is too big. ';
				}
				if(!$uploadProblems){
					// Create folder, might already exist
					@mkdir(dirname($this->Upload->getFilePath($this->Upload->id)));
					// Now move the uploaded file
					if(!rename(
						$this->Upload->Piece->Artist->FtpAccount->_getFolderPath($ftp_account_id).
						$upload['filename'],
						$this->Upload->getFilePath($this->Upload->id)
					)){
						$this->Upload->del($this->Upload->id);
						$this->Session->setFlash(__('Error! Your FTP upload could not be processed. There is a problem with file permissions. Please talk to staff, meanwhile, your uploaded file is safe.', true));
					}			
				}else{
					$this->Upload->del($this->Upload->id);
					$this->Session->setFlash(__('Error! Your FTP upload could not be processed. ', true).$uploadErrorReport);
				}				
			}else{
				// @todo Read reason: Validation failed?
				$this->Session->setFlash(__('The Upload could not be saved. Please, try again.', true));
			}
			
		}
		$this->Session->setFlash(__('FTP upload saved. Your files have been moved, the upload folder is empty again.', true));
		$this->redirect(array('controller'=>'pieces','action'=>'index'));		
	}
	/*
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
	}*/

/*	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Upload', true));
			$this->redirect(array('action'=>'index'));
		}
		if (unlink($this->Upload->getFilePath($id))) {
			$this->Upload->del($id);
			$this->Session->setFlash(__('Upload deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}*/
	
/**
 * Deliver the file for download
 *
 * @param int $id ID of the Upload
 */
	function download($id=null){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Upload.', true));
			$this->redirect(array('action'=>'index'));
		}
		$upload=$this->Upload->read(null, $id);
		// Check access
		if(!$this->Upload->Piece->artistHasAccess(
			$upload['Piece']['id'],
			$this->Auth->user('id')
			) &&
			!$this->Auth->user('is_admin')
		){
			$this->Session->setFlash(__('You may not download this file.', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$filepath=$this->Upload->getFilePath($id);
			$this->view = 'Media';
	        $params = array(
	              'id' => basename($filepath),
	              'name' => Inflector::slug($upload['Upload']['description']),
	              'download' => true,
	              'extension' => $upload['Upload']['extension'],
	              'path' => dirname($filepath).DS
	       );
	       $this->set($params);
		}
		
	}
	function isAuthorized(){
		// Check for login is sufficient, add() does its own check on
		// ownership of the Piece we are adding an upload to.
		if($this->Auth->user('email')){
			return true;
		}
		// Ask parent if no rule found so far:
		return parent::isAuthorized();
	}


}
?>