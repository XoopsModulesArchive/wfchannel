<?php
// $Id: object.php,v 1.2 2007/03/30 22:06:45 catzwolf Exp $
// ------------------------------------------------------------------------ //
// WF-Channel - WF-Projects													//
// Copyright (c) 2007 WF-Channel											//
// //
// Authors:																	//
// John Neill ( AKA Catzwolf )												//
// //
// URL: http://catzwolf.x10hosting.com/										//
// Project: WF-Projects														//
// -------------------------------------------------------------------------//
defined( 'XOOPS_ROOT_PATH' ) or die( 'You do not have permission to access this file!' );

if ( !isset( $GLOBALS['xoopsConfig']['language'] ) ) {
    $GLOBALS['xoopsConfig']['language'] = 'english';
}

$dirname = basename( dirname( dirname( __FILE__ ) ) );

define( '_MODULE_DIR', $dirname );
define( '_WFC_MODULE_PATH', XOOPS_ROOT_PATH . '/modules/' . $dirname );
define( '_MODULE_CLASS', 'wfc_' );

/**
 * wfc_CheckResource()
 *
 * @return
 */
function wfc_CheckResource( $upgrade )
{
    global $xoopsUserIsAdmin, $xoopsConfig, $xoopsUser;
    $module_handler = &xoops_gethandler( 'module' );
    $wmodule = &$module_handler->getByDirname( _MODULE_DIR );
    /**
     * WR-Resource
     */
    $wf_resource = &$module_handler->getByDirname( 'wfresource' );
    if ( is_object( $wf_resource ) ) {
        $wfr_installed = ( int )$wf_resource->getVar( 'version' );
        $wfr_actual = ( int )$wf_resource->getInfo( 'version' );
        /**
         * WF-Channel
         */
    }
    $wmodule = &$module_handler->getByDirname( _MODULE_DIR );
    $wfc_requires = intval( 100 * ( $wmodule->getInfo( 'requires' ) + 0.001 ) ) ;
    $ret = 0;
    if ( !is_object( $wf_resource ) ) {
        $ret = 1;
    } else if ( $wf_resource->getVar( 'isactive' ) === 0 ) {
        $ret = 2;
    } else if ( $wfr_installed < $wfc_requires ) {
        $ret = 3;
    }

    if ( $ret != 0 ) {
        if ( $upgrade == true ) {
            return false;
        } else {
            include XOOPS_ROOT_PATH . '/header.php';
            include_once XOOPS_ROOT_PATH . '/modules/' . $wmodule->getVar( 'dirname' ) . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/errors.php';
            $wfc_requires = '1.04';
            switch ( $ret ) {
                case 1:
                    $text = ( $xoopsUserIsAdmin == true ) ? sprintf( _MA_WFC_ERROR_MISSING_MODULE, $wmodule->getVar( 'name' ), $wfc_requires ) : _MA_WFC_TECHISSUES;
                    break;
                case 2:
                    $text = ( $xoopsUserIsAdmin == true ) ? sprintf( _MA_WFC_ERROR_NOTACTIVE, $wfc_requires ) : _MA_WFC_TECHISSUES;
                    break;
                case 3:
                    $text = ( $xoopsUserIsAdmin == true ) ? sprintf( _MA_WFC_ERROR_NOTUPDATE, $wmodule->getVar( 'name' ), $wfc_requires ) : _MA_WFC_TECHISSUES;
                    break;
            } // switch
            echo $text;
            include XOOPS_ROOT_PATH . '/footer.php';
            exit();
        }
        return ( $isUpgrade == true ) ? true : wfc_DisplayUserError();
    } else {
        return true;
    }
}

if ( empty( $upgrade ) ) {
    $upgrade = false;
}

$result = wfc_CheckResource( $upgrade );
if ( $result ) {
    if ( file_exists( $file = XOOPS_ROOT_PATH . '/modules/wfresource/language/' . $GLOBALS['xoopsConfig']['language'] . '/admin.php' ) ) {
        include_once $file;
    } else {
        include_once XOOPS_ROOT_PATH . '/modules/wfresource/language/english/admin.php';
    }
    if ( file_exists( $file = XOOPS_ROOT_PATH . '/modules/wfresource/include/functions.php' ) ) {
        require_once $file;
    }
}

?>