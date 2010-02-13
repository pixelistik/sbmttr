<?php
/*
*
* Copyright 2009 Till Claassen (http://pixelistik.de/)
* Licensed under the AGPL v3 (GNU Affero General Public License)
* http://www.fsf.org/licensing/licenses/agpl.html
*
* @package sbmttr
*/
class StringHelpersComponent extends Object{
	function completeURL($url){
		// Add http:// if it is missing:
		if($url=='') return null;
		$url=trim($url);
		if(substr($url,0,7)!='http://'){
			$url='http://'.$url;
		}
		return $url;
	}
}

?>