<?php
class FtpAccount extends AppModel {

	var $name = 'FtpAccount';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Artist' => array(
			'className' => 'Artist',
			'foreignKey' => 'artist_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * Return local path of the folder that is the root upload folder for this FTP account
 * @param int $id ID of the FtpAccount
 */	
	function _getFolderPath($id){
		$ftp_account=$this->read(null,$id);
		return(
			Configure::read('ftp-upload-root').
			$ftp_account['FtpAccount']['folder'].DS
		);
	}
	
	function _countFreeAccounts(){
		return $this->find('count',array('conditions'=>array('FtpAccount.artist_id'=>null)));
	}

}
?>