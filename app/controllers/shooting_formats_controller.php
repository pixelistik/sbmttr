<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class ShootingFormatsController extends AppController {

	var $name = 'ShootingFormats';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');

	function index() {
		$this->ShootingFormat->recursive = 0;
		$this->set('shootingFormats', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ShootingFormat.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('shootingFormat', $this->ShootingFormat->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ShootingFormat->create();
			if ($this->ShootingFormat->save($this->data)) {
				$this->Session->setFlash(__('The ShootingFormat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ShootingFormat could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ShootingFormat', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->ShootingFormat->save($this->data)) {
				$this->Session->setFlash(__('The ShootingFormat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ShootingFormat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ShootingFormat->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ShootingFormat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ShootingFormat->del($id)) {
			$this->Session->setFlash(__('ShootingFormat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>