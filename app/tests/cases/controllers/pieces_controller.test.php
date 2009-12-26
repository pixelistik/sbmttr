<?php 
/* SVN FILE: $Id$ */
/* PiecesController Test cases generated on: 2009-05-13 19:05:51 : 1242234111*/
App::import('Controller', 'Pieces');

class TestPieces extends PiecesController {
	var $autoRender = false;
}

class PiecesControllerTest extends CakeTestCase {
	var $Pieces = null;

	function startTest() {
		$this->Pieces = new TestPieces();
		$this->Pieces->constructClasses();
	}

	function testPiecesControllerInstance() {
		$this->assertTrue(is_a($this->Pieces, 'PiecesController'));
	}

	function endTest() {
		unset($this->Pieces);
	}
}
?>