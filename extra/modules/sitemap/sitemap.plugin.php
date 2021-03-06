<?php
/**
 * Name: sitemap.plugin.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author J.E. Garrett <jim@zyspec.com>
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: sitemap.plugin.php 0000 06/04/2009 13:00:43:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * b_sitemap_wfchannel()
 *
 * @return
 */
function b_sitemap_wfchannel() {
	require_once XOOPS_ROOT_PATH . '/modules/wfchannel/include/functions.php';
	$page_handler = &wfp_gethandler( 'page', _MODULE_DIR, _MODULE_CLASS );
	$obj = $page_handler->getPageObj( '', false );
	$ret = array();
	if ( $obj['count'] && count( $obj['list'] ) ) {
		foreach ( $obj['list'] as $obj ) {
			$wfc_cid = $obj->getVar( 'wfc_cid' );
			$ret['parent'][] = array( 'id' => $wfc_cid,
				'title' => $obj->getVar( 'wfc_title' ),
				'url' => 'index.php?wfc_id=' . $wfc_cid
				);
		}
	}
	return $ret;
}

?>