<?php
/**
 * Name: onupdate.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module : WF-Channel
 * @subpackage : Updater
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: onupdate.php 0000 14/03/2009 08:09:32:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * xoops_module_update_wfchannel()
 *
 * @param mixed $module
 * @param mixed $oldversion
 * @return
 */
function xoops_module_update_wfchannel( $module, $oldversion ) {
	global $msgs;

	/**
	 * Do install here
	 */
	$upgrade = true;
	include_once XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['module']->getVar( 'dirname' ) . '/include/functions.php';
	$msgs[] = '<br />Updating Module Database Tables.......';
	if ( $result == true ) {
		define( '_WF_INSTALLER', 1 );
		include_once XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['module']->getVar( 'dirname' ) . '/include/upgrade.php';
		return true;
	} else {
		$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">Update Failed: Required module WF-Resource is missing. Please Install this module and perform the update again</span>';
		return false;
	}
}

/**
 * displayOutput()
 *
 * @return
 */
function displayOutput() {
	global $updater, $msgs;

	$msgs[] = '<h4>' . _MD_WFC_SUCCESS . '</h4>';
	$_success = $updater->getSuccess();
	if ( count( $_success ) ) {
		foreach( $_success as $success ) {
			$msgs[] = "<div style=\"text-indent: 12px;\">$success</div>";
		}
	} else {
		$msgs[] = "<div style=\"text-indent: 12px;\">" . sprintf( _MD_WFC_NOTHING_UPDATED, $updater->getTable() ) . "</div>";
	}

	$msgs[] = "<h4>" . _MD_WFC_FAILURE . "</h4>";
	$_errors = $updater->getError();
	if ( count( $_errors ) ) {
		foreach( $_errors as $errors ) {
			$msgs[] = "<div style=\"text-indent: 12px;\">$errors</div>";
		}
	} else {
		$msgs[] = "<div style=\"text-indent: 12px;\">" . sprintf( _MD_WFC_NO_ERRORSFOUND, $updater->getTable() ) . "</div>";
	}
}

?>