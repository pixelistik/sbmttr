<?php
class SearchesController extends AppController {

	var $name = 'Searches';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');
	function index() {
		$this->Search->recursive = 0;
		$this->set('searches', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Search.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('search', $this->Search->read(null, $id));
	}

	function add() {
		// If it was called empty, redirect:
		if(empty($this->data) && empty($this->params['named'])){
			$this->Session->setFlash(__('Please run a search. You can then save it.', true));
			$this->redirect(array('controller'=>'Pieces','action'=>'search'));
		}
		
		if (!empty($this->data) && !empty($this->params['named'])) {
			$this->Search->create();
			// Make a string from search params, so we can save it:
			$this->data['Search']['params']=$this->serializeData($this->params['named']);
			if ($this->Search->save($this->data)) {
				$this->Session->setFlash(__('The Search has been saved', true));
				$this->redirect(array('action'=>'run',$this->Search->id));
			} else {
				$this->Session->setFlash(__('The Search could not be saved. Please, try again.', true));
			}
		}
	}
	
	function run($id=null){
		if(empty($id)){
			$this->Session->setFlash(__('No search was specified.', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$this->redirect(array('controller'=>'Pieces','action'=>'search',$this->Search->field('params',array('id'=>$id) )));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Search', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Search->save($this->data)) {
				$this->Session->setFlash(__('The Search has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Search could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Search->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Search', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Search->del($id)) {
			$this->Session->setFlash(__('Search deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>