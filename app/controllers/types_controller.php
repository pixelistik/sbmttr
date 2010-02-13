<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class TypesController extends AppController {

	var $name = 'Types';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');

	function index() {
		$this->Type->recursive = 0;
		$this->set('types', $this->paginate());
	}
	
	function select($title=null) {
		$this->Type->recursive=0;
		// Check if terms have been accepted:
		if(!empty($this->data)){
			// Continue if box was ticked:
			if($this->data['Type']['accepted']){
				$this->Session->write('type_id_preset',$this->data['Type']['title']);
				$this->redirect(array('controller'=>'pieces','action'=>'add'));
			}else{ // if not show selected terms again:
				$title=$this->data['Type']['title'];
			}
		}
		// Check if parameter is passed, select type for showing terms:
		if($title){
			$this->set('types', $this->Type->find('first',array('conditions'=>array('title'=>$title))));
			$this->set('showTerms',true);
		}else{ // Show view for selection:
			$this->Type->recursive = 0;
			$this->set('types', $this->Type->find('all'));
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Type.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('type', $this->Type->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Type->create();
			if ($this->Type->save($this->data)) {
				$this->Session->setFlash(__('The Type has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Type', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Type->save($this->data)) {
				$this->Session->setFlash(__('The Type has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Type->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Type->del($id)) {
			$this->Session->setFlash(__('Type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function getRequirements($id=null){
		return array('required'=>false,'allowEmpty'=>true);
	}
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('select');
	}
	
	
}
?>