<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class SectionsController extends AppController {

	var $name = 'Sections';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth');
	function index() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Section.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('section', $this->Section->read(null, $id));
	}

	function overview() {
		$this->Section->recursive = 0;
		$sections=$this->Section->find('all');
		// Add info: number of pieces:
		foreach($sections as $key=>$value){
			$sections[$key]['Section']['piece_count']=$this->Section->Piece->find('count',array('conditions'=>array('Piece.section_id'=>$value['Section']['id']) ) );
		}
		$this->set('sections', $sections);
		// Load the saved searches for display:
		$this->loadModel('Search');
		$this->set('searches',$this->Search->find('list'));
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The Section has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Section could not be saved. Please, try again.', true));
			}
		}
		$types = $this->Section->Type->find('list');
		$this->set(compact('types'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Section', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The Section has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Section could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
		$types = $this->Section->Type->find('list');
		$this->set(compact('types'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Section', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Section->del($id)) {
			$this->Session->setFlash(__('Section deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>