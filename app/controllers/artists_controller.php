<?php
class ArtistsController extends AppController {

	var $name = 'Artists';
	var $helpers = array('Html', 'Form');
	var $components=array('Auth','Email');
	
	function index() {
		$this->Artist->recursive = 0;
		$this->set('artists', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Artist.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('artist', $this->Artist->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Artist->create();
			// Set up a random initial password:
			$initial_password=md5(uniqid(mt_rand(), true));
			$this->data['Artist']['password']=$this->Auth->password($initial_password);
			// Handle the uploaded image:
			if(
				!empty($this->data['Artist']['picture']['name']) && 
				$this->data['Artist']['picture']['type']=='image/jpeg' && 
				$this->data['Artist']['picture']['size'] <= Configure::read('max_picture_size') && 
				is_uploaded_file($this->data['Artist']['picture']['tmp_name']) ){
					// Read data from temp file:
					$fileData = fread(fopen($this->data['Artist']['picture']['tmp_name'], "r"),$this->data['Artist']['picture']['size']);
					$this->data['Artist']['picture']=$fileData;
			}else{
				$this->data['Artist']['picture']=null;
			}
			if ($this->Artist->save($this->data)) {
				$this->Session->setFlash(__('Your artist account was created.', true));
				// Login automatically:
				$this->Auth->login($this->Artist->find('first',array('conditions'=>array('email'=>$this->data['Artist']['email']))));
				// Remember that this is the first login, so we can remind the user to set a custom password at logout:
				$this->Session->write('isInitialPassword','true');
				// Continue to submit a new piece:
				$this->redirect(array('controller'=>'Pieces','action'=>'add'));
			} else {
				$this->Session->setFlash(__('Your artist information could not be saved. Please check the data you entered.', true));
			}
		}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Artist.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Artist->save($this->data)) {
				$this->Session->setFlash(__('The Artist has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Artist could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Artist->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Artist', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Artist->del($id)) {
			$this->Session->setFlash(__('Artist deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	
	function login(){
		$this->Artist->setValidation('login');
		//debug($this->Session);
		//debug($this->Auth);
		// If login was successful:
		if ($this->Auth->user('id')) {
			// If a type is already preset, add piece now:
			if($this->Session->check('type_id_preset')){
				$this->redirect(array('controller'=>'pieces','action'=>'add'));
			}else{
				// go to select a type:
				$this->redirect(array('controller'=>'types','action'=>'select'));
			}
		}
	}
	
	function logout(){
		// If this was the user's first login, suggest to change the password:
		if($this->Session->read('isInitialPassword')){
			$this->Session->setFlash(__('You might want to choose a password, so you can come back later. Or just click "Log out" again. You can always use the "Forgot password" function later.', true));
			$this->Session->del('isInitialPassword');
			$this->redirect(array('action'=>'changePassword'));
		}
		$this->Auth->logout();
		$this->Session->destroy();
		$this->redirect('/');
	}
	
	function changePassword(){
		debug($this->Auth->user());
		$this->Artist->setValidation('changePassword');
		if(!empty($this->data)){
			// Write data into model (needed for manual validation):
			$this->Artist->set($this->data);
			// Change password only of logged in user, of course:
			$this->Artist->id=$this->Auth->user('id');
			// Check if both fields match:
			if($this->data['Artist']['password']==$this->data['Artist']['password2']){
				//Check if password validates (minLength):
				if($this->Artist->validates()){
					// Only then hash and put new password into data:
					if ($this->Artist->saveField('password',$this->Auth->password($this->data['Artist']['password']),true)) {
						// Don't display the input again:
						$this->data=null;
						$this->Session->setFlash(__('Your new password has been saved', true));
						// Now we have a custom password, no need to ask for a change at logout anymore:
						$this->Session->del('isInitialPassword');
					}else{
						$this->Session->setFlash(__('Your new password could not be saved. Please, try again.', true));
					}
				}else{$this->Session->setFlash(__('Your password is not secure.', true));
				debug($this->Artist->validationErrors);
				}
			}else{
					$this->Session->setFlash(__('The two fields do not match.', true));
					// Reset form:
					$this->data=null;
			}
		}
	}
	
	function forgotPassword($token=null){
		// The user enters his/her email address. They will get a mail with
		// a temporary link that allows them to login and change the password.
		
		// Case 1: Token is requested:
		if(!empty($this->data['Artist']['email'])){
			// Find artist by entered email address:
			$artist=$this->Artist->find('first',array('conditions'=>array('email'=>$this->data['Artist']['email']),'recursive'=>0 ) );
			if(!empty($artist)){
				// Generate security token and expiry time:
				$artist['Artist']['recovery_token']=md5(uniqid(mt_rand(), true));
				$artist['Artist']['recovery_token_expires']=date( 'Y-m-d H:i:s', strtotime('+2 hour'));
				if ($this->Artist->save($artist,false)) {
					// Send token to user:
					//   Set up the mail:
					$this->Email->to=$artist['Artist']['email'];
					//$this->Email->to='tillc@web.de';
					$this->Email->replyTo='noreply@'.Configure::read('organisation_email_domain');
					$this->Email->from=Configure::read('organisation_name').' <noreply@'.Configure::read('organisation_email_domain').'>';
					$this->Email->subject='Password recovery';
					$this->Email->template='passwordrecovery';
					$this->Email->sendAs='text';
					$this->set('name',$artist['Artist']['name'].' '.$artist['Artist']['surname']);
					$this->set('msg',Router::url(array('controller'=>'Artists','action'=>'forgotPassword',$artist['Artist']['recovery_token']),true));
					//    Send the mail:
					debug(Router::url(array('controller'=>'Artists','action'=>'forgotPassword',$artist['Artist']['recovery_token']),true));
					if($this->Email->send()){
						$this->Session->setFlash(__('Please check your email (Spam folder, too) and click the recovery link.', true));
					}else{
						$this->Session->setFlash(__('There was an error sending the email. Please try again or contact us.', true));
					}
					
				}else{
					$this->Session->setFlash(__('Password recovery failed. Please try again or contact us via email.', true));
				}
				
				
			}else{
				$this->Session->setFlash(__('Sorry, your email address is unknown to us. Are you sure you used this one?', true));
			}
		}else{
			//Case 2: Token is processed:
			if(!empty($token)){
				$artist=$this->Artist->find('first',array('conditions'=>array('recovery_token'=>$token),'recursive'=>0 ) );
				if(!empty($artist)){
					if($artist['Artist']['recovery_token_expires'] > date( 'Y-m-d H:i:s', strtotime('now'))){
						$this->Auth->login($artist);
						$this->Session->setFlash(__('Please choose a new password now', true));
						$this->redirect(array('controller'=>'Artists','action'=>'changePassword'));
					}
				}
				$this->Session->setFlash(__('Your recovery link is not valid or too old. Please request a new one.', true));
			}
		}
	}
	
	function clearCache(){
		Cache::clear();
		$this->Session->setFlash('Cache cleared');
		$this->redirect('/');
	}
	
	function beforeFilter(){
		// Do standards:
		parent::beforeFilter();
		// These things can be done without login:
		$this->Auth->allow('add','forgotPassword','logout','clearCache'); //TODO: clearCache should be removed.
	}

	function isAuthorized(){
		// A list of all user accessible actions of this controller.
		// There are 2 levels of access that can be assigned:
		// loggedIn = it is enough to be simply logged in
		// loggedInArtistBelongs = Additionally,
		// 			we check if the Artist with the passed id
		//			really belongs to the artist.
		// All other actions are only for admins.
		$access=array(
			'changePassword'=>'loggedIn',
			'logout'=>'loggedIn',
			'edit'=>'loggedInArtistBelongs'
			);
		
		if(!empty($access[$this->action])){
			// Get logged in user:
			$currentArtist=$this->Auth->user();
			// Here comes the checking:
			switch($access[$this->action]){
				case 'loggedIn':
					// Auth has already made sure we are logged in.
					return true;
				break;
				case 'loggedInArtistBelongs':
					// This is a little tricky. An Artist can not only edit their own data, but also 
					// additional Artists that they entered for a piece. So we must check if either
					// a) the id is the logged in Artist or if b) there is any Piece that the id and logged in have in common.
					
					// a)
					if($currentArtist['Artist']['id']==$this->params['pass'][0]){
						return true;
					}
					// b)
					// We need to clean params against SQL injection:
					App::import('Core','Sanitize');
					// Use a custom SQL query with a self-join:
					$query="
					SELECT *
					FROM artists_pieces F, artists_pieces S
					WHERE F.piece_id = S.piece_id
					AND F.artist_id < S.artist_id
					AND(
					(F.artist_id='".Sanitize::paranoid($this->params['pass'][0])."' AND S.artist_id='".Sanitize::paranoid($currentArtist['Artist']['id'])."')
					OR
					   (F.artist_id='".Sanitize::paranoid($currentArtist['Artist']['id'])."' AND S.artist_id='".Sanitize::paranoid($this->params['pass'][0])."')
					);
					";
					$result=$this->Artist->Piece->query($query);
					if(!empty($result))
					return true;
				break;
			}
		}
		// Ask parent (app_controller) if no rule found so far:
		return parent::isAuthorized();	
	}
}
?>