<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
class ScreeningFormatsController extends AppController {

	var $name = 'ScreeningFormats';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');

	function index() {
		$this->ScreeningFormat->recursive = 0;
		$this->set('screeningFormats', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ScreeningFormat.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('screeningFormat', $this->ScreeningFormat->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ScreeningFormat->create();
			if ($this->ScreeningFormat->save($this->data)) {
				$this->Session->setFlash(__('The ScreeningFormat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ScreeningFormat could not be saved. Please, try again.', true));
			}
		}
		$pieces = $this->ScreeningFormat->Piece->find('list');
		$this->set(compact('pieces'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ScreeningFormat', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->ScreeningFormat->save($this->data)) {
				$this->Session->setFlash(__('The ScreeningFormat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ScreeningFormat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ScreeningFormat->read(null, $id);
		}
		$pieces = $this->ScreeningFormat->Piece->find('list');
		$this->set(compact('pieces'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ScreeningFormat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ScreeningFormat->del($id)) {
			$this->Session->setFlash(__('ScreeningFormat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>