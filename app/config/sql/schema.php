<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-09-06 11:09:22 : 1283765182*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $artists = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'surname' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
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
		'function' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'is_main_contact' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $countries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'iso' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80),
		'iso3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3),
		'numcode' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $ftp_accounts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'artist_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 5),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
		'folder' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pieces = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'original_title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'english_title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'synopsis' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'section_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'selected' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'notes_team' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'notes_artist' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'production_year' => array('type' => 'string', 'null' => true, 'default' => NULL),
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
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'screening_format_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'piece_id', 'unique' => 1))
	);
	var $pieces_tags = array(
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'piece_id', 'unique' => 1))
	);
	var $screening_formats = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $searches = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128),
		'params' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $sections = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'opening_date' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'closing_date' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $shooting_formats = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $types = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'terms' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'artist_name_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'artist_surname_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'artist_email_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'artist_url_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'artist_picture_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_original_title_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_english_title_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_synopsis_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_notes_artist_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_production_year_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_duration_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_shooting_format_id_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_country_id_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_genre_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_shown_before_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_preview_how_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'piece_preview_url_required' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $uploads = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 512),
		'extension' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4),
		'piece_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>