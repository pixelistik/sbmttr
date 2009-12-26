<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2009-12-26 02:12:05 : 1261789445*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $artists = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'surname' => array('type' => 'string', 'null' => false, 'length' => 50),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'url' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'picture' => array('type' => 'binary', 'null' => true, 'default' => NULL),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'recovery_token' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'recovery_token_expires' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'is_admin' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $artists_pieces = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6, 'key' => 'primary'),
		'artist_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'function' => array('type' => 'string', 'null' => false, 'length' => 50),
		'is_main_contact' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $countries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'iso' => array('type' => 'string', 'null' => false, 'length' => 2),
		'name' => array('type' => 'string', 'null' => false, 'length' => 80),
		'iso3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3),
		'numcode' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pictures = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
		'content' => array('type' => 'binary', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'size' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'type' => array('type' => 'string', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pieces = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'original_title' => array('type' => 'string', 'null' => false, 'length' => 100),
		'english_title' => array('type' => 'string', 'null' => false, 'length' => 100),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'synopsis' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'section_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'selected' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'notes_team' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'notes_artist' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'production_year' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 4),
		'duration' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'shooting_format_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 5),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'genre' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'shown_before' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'preview_how' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'preview_url' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pieces_screening_formats = array(
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5, 'key' => 'primary'),
		'screening_format_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'indexes' => array()
	);
	var $pieces_tags = array(
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5, 'key' => 'primary'),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'indexes' => array()
	);
	var $requirements = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
		'info_title' => array('type' => 'string', 'null' => false, 'length' => 50),
		'kind' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'detailed_description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $screening_formats = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $searches = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'length' => 128),
		'params' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $sections = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'length' => 50),
		'opening_date' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'closing_date' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $shooting_formats = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $types = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'length' => 50),
		'terms' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>