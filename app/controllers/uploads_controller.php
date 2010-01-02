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
			$this->Upload->create();
			if ($this->Upload->save($this->data)) {
				$this->Session->setFlash(__('The Upload has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Upload could not be saved. Please, try again.', true));
			}
		}
		$pieces = $this->Upload->Piece->find('list');
		$this->set(compact('pieces'));
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