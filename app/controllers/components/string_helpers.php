<?php
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