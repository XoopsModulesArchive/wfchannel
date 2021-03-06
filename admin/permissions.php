<?php
/**
 * Name: permissions.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: permissions.php 0000 24/03/2009 18:25:39:000 Catzwolf $
 */
include 'admin_header.php';

$op = wfp_Request::doRequest( $_REQUEST, 'op', 'default', 'textbox' );
switch ( $op ) {
	case 'default':
	default:
		xoops_cp_header();
		$menu_handler->addHeader( _MA_WFC_PERMISSIONAREA );
		$menu_handler->addSubHeader( _MA_WFC_REFERAREA_DSC );
		$menu_handler->render( 4 );

		ob_start( 'callback' );
		$group = wfp_getClass( 'permissions' );
		$group->setPermissions( 'wfcpages', 'page_read', '', $xoopsModule->getVar( 'mid' ) );
		$group->render( array( 'cid' => 'wfc_cid', 'title' => 'wfc_title' ) );
		ob_end_flush();
		break;
}
xoosla_cp_footer();

/**
 * callback()
 *
 * @param mixed $buffer
 * @return
 */
function callback( $buffer ) {
	// replace all the apples with oranges
	return ( str_replace( "<h4></h4>", "", $buffer ) );
}

?>