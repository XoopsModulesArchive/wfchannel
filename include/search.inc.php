<?php
/**
 * $Id: search.php v 1.02 03 Jan 2004 Catwolf Exp $
 * Module: WF-Channel
 * Version: v1.0.5
 * Release Date: 03 Jan 2004
 * Author: Catzwolf
 * Licence: GNU
 */

defined( 'XOOPS_ROOT_PATH' ) or die( 'You do not have permission to access this file!' );
/**
 * wfchannel_search()
 *
 * @param mixed $queryarray
 * @param mixed $andor
 * @param mixed $limit
 * @param mixed $offset
 * @param mixed $userid
 * @return
 */
function wfchannel_search( $queryarray, $andor, $limit, $offset, $userid ) {
	$upgrade = false;
	require_once XOOPS_ROOT_PATH . '/modules/wfchannel/include/functions.php';

	$ret = '';
	if ( !isset( $page_handler ) ) {
		$page_handler = &wfp_gethandler( 'page', _MODULE_DIR, _MODULE_CLASS );
	}
	$page_search = $page_handler->getSearch( $queryarray, $andor, $limit, $offset, true );

	$i = 0;

	$ret = array();
	if ( !empty( $page_search['list'] ) ) {
		foreach( $page_search['list'] as $obj ) {
			$ret[$i]['link'] = 'index.php?wfc_cid=' . $obj->getVar( 'wfc_cid' );
			$ret[$i]['title'] = $obj->getVar( 'wfc_headline' );
			$ret[$i]['time'] = $obj->getVar( 'wfc_publish' );
			$ret[$i]['uid'] = $obj->getVar( 'wfc_uid' );
			$i++;
		}
	}
	return $ret;
}

?>