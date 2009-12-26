<?php
class RequirementsController extends AppController {

	var $name = 'Requirements';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');

	function index() {
		$this->Requirement->recursive = 0;
		$this->set('requirements', $this->Requirement->find('all'));
		
	}
	
	function show_by_type($type=null) {
		if(!empty($this->data)){
			debug($this->data);
			if($this->Requirement->saveAll($this->data)){
				$this->Session->setFlash(__('Your changes have been saved', true));
				$this->redirect(array('controller'=>'types','action'=>'index'));
			}else{
				$this->Session->setFlash(__('There was an error saving your changes', true));
			}
		}else{
			if(!empty($type)){
				$this->Requirement->recursive = 0;
				$this->set('requirements', $this->Requirement->find('all',array('conditions'=>array('Type.title'=>$type)) ));
			}else{
				$this->redirect(array('controller'=>'types','action'=>'index'));
			}
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Requirement.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('requirement', $this->Requirement->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Requirement->create();
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		$types = $this->Requirement->Type->find('list');
		$this->set(compact('types'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Requirement->read(null, $id);
		}
		$types = $this->Requirement->Type->find('list');
		$this->set(compact('types'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Requirement->del($id)) {
			$this->Session->setFlash(__('Requirement deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>