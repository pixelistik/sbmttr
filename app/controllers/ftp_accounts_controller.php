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
	var $helpers = array('Html', 'Form');

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
 */
	function listFiles($id=null){
		$this->layout='ajax';
		$files=array();
		foreach (new DirectoryIterator($this->FtpAccount->_getFolderPath($id)) as $file) {
			// if the file is a file and not hidden:
			if ( !$file->isDot() && !$file->isDir() )  {
				$files[]=$file->getFilename();
			}
		}
		$this->set('files',$files);
	}

/**
 * Select and move uploaded files from the ftp folder
 * 
 * @param int $id ID of the FTP account
 */
	function process($id=null){
		$this->set('account_id',$id);
	}

}
?>