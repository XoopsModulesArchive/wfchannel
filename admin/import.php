<?php
/**
 * Name: index.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: index.php 0000 24/03/2009 18:28:38:000 Catzwolf $
 */
include 'admin_header.php';

$menu_handler->addHeader( _MA_WFC_UPLOADAREA );
$op = wfp_Request::doRequest( $_REQUEST, 'op', 'default', 'textbox' );
switch ( $op ) {
	case 'save':
		$handler = &wfp_gethandler( 'page', _MODULE_DIR, _MODULE_CLASS );
		$do_callback = &wfp_getObjectCallback( $handler );

		$uploadir = wfp_Request::doRequest( $_REQUEST, 'uploadir', '', 'textbox' );
		if ( empty( $uploadir ) || !is_dir( XOOPS_ROOT_PATH . '/' . $uploadir ) || !is_readable( XOOPS_ROOT_PATH . '/' . $uploadir ) ) {
			xoops_cp_header();
			$menu_handler->addSubHeader( _MA_WFC_IMPORT_DSC );
			$menu_handler->render( 6 );
			echo _MA_EWFC_FOLDERDOESNOTEXIST;
			xoosla_cp_footer();
		}

		xoops_load( 'xoopslists' );
		$htmlList = XoopsLists::getHtmlListAsArray( XOOPS_ROOT_PATH . '/' . $uploadir );

		unset( $_SESSION['wfc_channel'] );
		$do_callback->setBasics();
		$do_callback->setValueArray( $_REQUEST );
		$do_callback->setValueTime( 'wfc_expired', $_REQUEST['wfc_expired'] );
		$do_callback->setValueTime( 'wfc_publish', $_REQUEST['wfc_publish'] );
		$do_callback->setValueGroups( 'page_read', isset( $_REQUEST['page_read'] ) ? $_REQUEST['page_read'] : array( 0 => '1' ) );
		/**
		 */
		$i = 1;
		foreach( $htmlList as $htmlfile ) {
			$ret = $handler->htmlImport( XOOPS_ROOT_PATH . '/' . $uploadir . '/' . $htmlfile, 1 );
			if ( isset( $ret['content'] ) && !empty( $ret['content'] ) ) {
				$do_callback->setValue( 'wfc_content', $ret['content'] );
			} else {
				$do_callback->setValue( 'wfc_content', '' );
			}

			$fileName = str_replace( '.html', '' , $htmlfile );
			if ( isset( $ret['title'] ) && !empty( $ret['title'] ) ) {
				$fileName = $ret['title'];
			}

			$ret = $handler->htmlClean( $do_callback->getValue( 'wfc_content' ), $_REQUEST['wfc_cleaningoptions'] );
			if ( !is_null( $ret ) ) {
				$do_callback->setValue( 'wfc_content', $ret );
			}
			$wfc_cid = wfp_Request::doRequest( $_REQUEST, 'wfc_cid', 0, 'int' );
			/**
			 */

			if ( empty( $_REQUEST['wfc_title'] ) ) {
				$do_callback->setValue( 'wfc_title', $fileName );
			} else {
				$do_callback->setValue( 'wfc_title', $_REQUEST['wfc_title'] . $i );
			}
			if ( empty( $_REQUEST['wfc_title'] ) ) {
				$do_callback->setValue( 'wfc_headline', $fileName );
			} else {
				$do_callback->setValue( 'wfc_headline', $_REQUEST['wfc_headline'] . $i );
			}

			/**
			 * * code to remove pdf files created to update them *
			 */
			if ( $wfc_cid > 0 ) {
				$pdf = wfp_getClass( 'dopdf' );
				$pdf->deleteCache( $wfc_cid, $_REQUEST['wfc_title'] );
			}
			// /**
			// */
			$options['noreturn'] = true;
			$ret = call_user_func( array( $do_callback, 'save' ), $options );
			if ( $ret == false ) {
				$handler->getHtmlErrors( false, 6 );
				// exit();
			} else {
				// $do_callback->setNotificationType( $wfc_cid > 0 ? 'page_modified' : 'page_new' ) ;
			}
			$i++;
		}
		break;

	case "default":
	default:
		xoops_cp_header();
		$menu_handler->addSubHeader( _MA_WFC_IMPORT_DSC );
		$menu_handler->render( 6 );
		$dummy_handler = $refer_handler = &wfp_gethandler( 'dummy' );
		$up_obj = $dummy_handler->create();
		$up_obj->formEdit( 'wfp_import' );
}
xoosla_cp_footer();

?>