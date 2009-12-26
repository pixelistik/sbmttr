<?php
class Search extends AppModel {

	var $name = 'Search';
	var $validate = array(
		'title' => array('notempty')
	);

}
?>