<?php
class TagsController extends AppController {

	var $name = 'Tags';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');

	function index() {
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tag.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true));
			}
		}
		$pieces = $this->Tag->Piece->find('list');
		$this->set(compact('pieces'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null, $id);
		}
		$pieces = $this->Tag->Piece->find('list');
		$this->set(compact('pieces'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tag->del($id)) {
			$this->Session->setFlash(__('Tag deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>