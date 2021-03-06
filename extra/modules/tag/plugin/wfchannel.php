<?php
/**
 * Name: wfchannel.php
 * Description:
 *
 * @package: Xoosla Modules
 * @Module:
 * @subpackage:
 * @since: v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright: Copyright (C) 2009 Xoosla. All rights reserved.
 * @license: GNU/LGPL, see docs/license.php
 * @version: $Id: wfchannel.php 0000 28/03/2009 05:39:16:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

function wfchannel_tag_iteminfo( &$items ) {
	if ( empty( $items ) || !is_array( $items ) ) {
		return false;
	}

	$items_id = array();
	foreach( array_keys( $items ) as $cat_id ) {
		foreach( array_keys( $items[$cat_id] ) as $item_id ) {
			$items_id[] = ( int )$item_id;
		}
	}
	$handler = &xoops_getmodulehandler( 'pages', 'wfchannel' );
	$items_obj = $handler->getObjects( new Criteria( 'wfc_cid', '(' . implode( ', ', $items_id ) . ')', 'IN' ), true );

	foreach( array_keys( $items ) as $cat_id ) {
		foreach( array_keys( $items[$cat_id] ) as $item_id ) {
			if ( isset( $items_obj[$item_id] ) ) {
				$obj = &$items_obj[$item_id];
				$items[$cat_id][$item_id] = array( 'title' => $obj->getVar( 'wfc_title' ),
					'uid' => $obj->getVar( 'wfc_uid' ),
					'link' => 'index.php?cid=' . $item_id,
					'time' => $obj->getVar( 'wfc_publish' ),
					'tags' => '', // tag_parse_tag($item_obj->getVar("item_tags", "n")), // optional
					'content' => '',
					);
			}
		}
	}
	unset( $items_obj );
}

/**
 * wfchannel_tag_synchronization()
 *
 * @param mixed $mid
 * @return
 */
function wfchannel_tag_synchronization( $mid ) {
	$item_handler =& xoops_getmodulehandler('pages', 'wfchannel');
	$link_handler =& xoops_getmodulehandler('link', 'tag');

	/* clear tag-item links */
	if($link_handler->mysql_major_version() >= 4){
    $sql =	"	DELETE FROM {$link_handler->table}".
    		"	WHERE ".
    		"		tag_modid = {$mid}".
    		"		AND ".
    		"		( tag_itemid NOT IN ".
    		"			( SELECT DISTINCT {$item_handler->keyName} ".
    		"				FROM {$item_handler->table} ".
    		"				WHERE {$item_handler->table}.approved > 0".
    		"			) ".
    		"		)";
    } else {
    $sql = 	"	DELETE {$link_handler->table} FROM {$link_handler->table}".
    		"	LEFT JOIN {$item_handler->table} AS aa ON {$link_handler->table}.tag_itemid = aa.{$item_handler->keyName} ".
    		"	WHERE ".
    		"		tag_modid = {$mid}".
    		"		AND ".
    		"		( aa.{$item_handler->keyName} IS NULL".
    		"			OR aa.approved < 1".
    		"		)";
	}
    if (!$result = $link_handler->db->queryF($sql)) {
        //xoops_error($link_handler->db->error());
  	}
}

?>