<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
class FtpAccountsController extends AppController {

	var $name = 'FtpAccounts';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $components=array('RequestHandler','Auth');

	function index() {
		$this->FtpAccount->recursive = 0;
		$this->set('ftpAccounts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FtpAccount.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ftpAccount', $this->FtpAccount->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FtpAccount->create();
			if ($this->FtpAccount->save($this->data)) {
				$this->Session->setFlash(__('The FtpAccount has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The FtpAccount could not be saved. Please, try again.', true));
			}
		}
		$artists = $this->FtpAccount->Artist->find('list');
		$this->set(compact('artists'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FtpAccount', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->FtpAccount->save($this->data)) {
				$this->Session->setFlash(__('The FtpAccount has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The FtpAccount could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FtpAccount->read(null, $id);
		}
		$artists = $this->FtpAccount->Artist->find('list');
		$this->set(compact('artists'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for FtpAccount', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FtpAccount->del($id)) {
			$this->Session->setFlash(__('FtpAccount deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
/**
 * List all new files in the upload folder for further processing (AJAX)
 *
 * @param $id int ID of the FTP account
 * @todo Access control
 * @todo parameter check
 * @todo If non-existing account folder is given, why list the root upload folder?
 */
	function listFiles($id=null){
		$this->layout='ajax';
		$this->RequestHandler->setContent('json');
		$files=array();
		foreach (new DirectoryIterator($this->FtpAccount->_getFolderPath($id)) as $file) {
			// if the file is a file and not hidden:
			if ( !$file->isDot() && !$file->isDir() )  {
				$status=$this->__getFileStatus($file);
				$files[$this->__getFileStatus($file)][]=array(
					'filename'=>$file->getFilename(),
					'hash'=>md5($file->getFilename())
				);
			}
		}
		$this->set('files',$files);
	}
/**
 * Return the status of the file. Has it finished uploading?
 * 
 * Simple calculation based on the current time and the modification date on 
 * the file. If it has not been touched for a while, assumed that upload has finished.
 * 
 * @param DirectoryIterator $file File object of the file to check.
 * @access private
 */	
	function __getFileStatus($file){
		if(time()-$file->getMTime() > 20){
			return 'finished';
		}else{
			return 'loading';
		}
	}

/**
 * Select and move uploaded files from the ftp folder
 * 
 * @param int $id ID of the FTP account
 * @param int $piece_id ID of the piece which the file is related to
 */
	function process($id=null,$piece_id=null){
		$this->set('account_id',$id);
		$this->set('piece_id',$piece_id);
		$this->set('ftp_account',$this->FtpAccount->read(null,$id));
	}
	
/**
 * Assigns a FTP account to the current user if necessary. Then redirect to upload processing.
 * 
 * @param int $piece_id ID of the Piece to which a file should be added.
 */	
	function activate($piece_id=null){
		if(empty($user_id) && empty($this->data)){
			$this->Session->setFlash(__('Invalid ID',true));
			$this->redirect('/');
		}
		// If the current user already has an ftp account, redirect to /process
		$ftp_account_id=$this->FtpAccount->field('id',array('artist_id'=>$this->Auth->user('id')));
		if($ftp_account_id){
			$this->redirect(array('action'=>'process',$ftp_account_id,$piece_id));
		}
		// If start button was clicked, assign an account to user, then reload to proceed
		if(!empty($this->data)){
			$free_ftp_account=$this->FtpAccount->find('first',array('conditions'=>array('artist_id'=>null)));
			$free_ftp_account['FtpAccount']['artist_id']=$this->Auth->user('id');
			$this->FtpAccount->save($free_ftp_account);
			$this->redirect('activate');
		}else{
			$this->data['FtpAccount']['piece_id']=$piece_id;
		}
	}	

}
?>