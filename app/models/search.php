<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
*/
class Search extends AppModel {

	var $name = 'Search';
	var $validate = array(
		'title' => array('notempty')
	);

}
?>