<?php
/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class AppController extends Controller {
	var $components = array('DebugKit.Toolbar');
	
	function beforeFilter(){
		// Set some generic Auth stuff, in case Auth is used in the model:
		if(isset($this->Auth)){
			$this->Auth->userModel='Artist';
			$this->Auth->loginAction=array('controller'=>'artists','action'=>'login');
			// Set Login system to use email adress as username:
			$this->Auth->fields=array('username'=>'email','password'=>'password');
			$this->Auth->loginError=__('Login failed. Please try again.',true);
			$this->Auth->loginRedirect='/';
			$this->Auth->autoRedirect=true;
			$this->Auth->allow('set_language');
			// enable access control via isAuthorized():
			$this->Auth->authorize='controller';
		}
		// Init language stuff:
		App::import('Core','L10n');
		$this->L10n=new L10n();
		// Read setting from session:
		$lang=$this->Session->read('lang');
		// Set language:
		if($lang!=''){
			$this->L10n->get($lang);
			Configure::write('Config.language',$lang);
		}else{
			$this->L10n->get();
		}
	
	}
	
	function isAuthorized(){
		// Only admin can access all actions. Access for normal users is set in each controller.
		$currentArtist=$this->Auth->user();
		if($currentArtist['Artist']['is_admin']){
			return true;
		}else{
			return false;
		}
	}
	
	function serializeData($data){
		// Parses a data array into a named parameter url string: 
		    $result = array();
	 
		    if (is_array($data)){
			foreach ($data as $model=>$values) {
			    if (is_array($values)){
				foreach($values as $name=>$val){
				    $result[] = sprintf("%s.%s:%s", $model, $name, $val);
				}
			    } else {
				$result[] = sprintf("%s:%s", $model, $values);
			    }
			}
		    }
	 
		    $result = implode("/", $result);
	 
		    return $result;
	}
	
	//Language function:
	function set_language($lang,$returnController,$returnAction){
		// Set language in session and reload given action
		$this->Session->write('lang',$lang);
		$this->redirect(array('controller'=>$returnController,'action'=>$returnAction) );
	}
}
?>