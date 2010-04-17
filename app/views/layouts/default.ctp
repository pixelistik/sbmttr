<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
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
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo Configure::read('header-title').' : '; ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		<h1><?php echo $html->link(Configure::read('header-title'),'/' ); ?></h1>
		<?php 
		if($session->check('Auth.Artist.email')){
			echo(__('Logged in as ',true).$session->read('Auth.Artist.email'));
			if($session->read('Auth.Artist.is_admin')){
				echo $form->create('Piece',array(
					'action'=>'view',
					'class'=>'mini-form',
					'onSubmit'=>'javascript:window.location="'.$html->url(array('controller'=>'pieces','action'=>'view')).'/"+document.getElementById("PieceIdQuickJump").value;return false;'
				));
				echo $form->input('id',array(
					'id'=>'PieceIdQuickJump',
					'type'=>'text',
					'value'=>__('Piece ID',true),
					'label'=>false
				));
				echo $form->end('>>');
			}
			echo '&nbsp;';
			if($session->read('Auth.Artist.is_admin')){
				echo $html->link(__('Overview',true),array('controller'=>'sections','action'=>'overview') );
				echo '&nbsp;';
				echo $html->link(__('Search',true),array('controller'=>'pieces','action'=>'search') );
				echo '&nbsp;';
			}else{
				echo $html->link(__('My Submissions',true),array('controller'=>'pieces','action'=>'index') );
				echo '&nbsp;';
			}
			echo $html->link(__('Change Password',true),array('controller'=>'artists','action'=>'changePassword') );
			echo '&nbsp;';
			echo $html->link(__('Log out',true),array('controller'=>'artists','action'=>'logout') );
			
		}
		?>
		
		</div>
		<div id="content">

			<?php $session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php
			// Show login link, if not logged in already:
			if(!$session->check('Auth.Artist.email')){
				echo $html->link(__('Login',true),array('controller'=>'Artists','action'=>'login')).'&nbsp;';
			}
			echo $html->link(__('About',true),array('controller'=>'pages','action'=>'display','about'));
			
			?>
		</div>
	</div>
	<?php echo $cakeDebug; ?>
	
</body>
</html>