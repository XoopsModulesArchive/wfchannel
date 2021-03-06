<?php
/**
 * Name: class.page.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module : WF-Channel
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: class.page.php 0000 14/03/2009 07:56:38:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * Include resource classes
 */
wfp_getObjectHander();

/**
 * wfc_Page
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class wfc_Page extends wfp_Object {
    var $content;
    var $pageNav;
    var $uploadDir;
    var $related;
    /**
     * XoopsWfPage::XoopsWfPage()
     */
    function wfc_Page() {
        $this->XoopsObject();
        $this->initVar( 'wfc_cid', XOBJ_DTYPE_INT, null, false );
        $this->initVar( 'wfc_title', XOBJ_DTYPE_TXTBOX, null, true, 120 );
        $this->initVar( 'wfc_headline', XOBJ_DTYPE_TXTBOX, null, false, 150 );
        $this->initVar( 'wfc_content', XOBJ_DTYPE_TXTAREA, null, false );
        $this->initVar( 'wfc_weight', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'wfc_default', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'wfc_image', XOBJ_DTYPE_TXTBOX, '||', false, 250 );
        $this->initVar( 'wfc_file', XOBJ_DTYPE_TXTBOX, '', false, 250 );
        $this->initVar( 'wfc_usefiletitle', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'wfc_created', XOBJ_DTYPE_INT, time(), false );
        $this->initVar( 'wfc_publish', XOBJ_DTYPE_INT, null, false );
        $this->initVar( 'wfc_expired', XOBJ_DTYPE_INT, null, false );
        $this->initVar( 'wfc_mainmenu', XOBJ_DTYPE_INT, 1, false );
        $this->initVar( 'wfc_submenu', XOBJ_DTYPE_INT, 1, false );
        $this->initVar( 'wfc_counter', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'wfc_comments', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'wfc_allowcomments', XOBJ_DTYPE_INT, 1, false );
        $this->initVar( 'wfc_uid', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'wfc_metakeywords', XOBJ_DTYPE_TXTAREA, null, false );
        $this->initVar( 'wfc_metadescription', XOBJ_DTYPE_TXTAREA, null, false );
        $this->initVar( 'wfc_related', XOBJ_DTYPE_TXTBOX, null, false, 255 );
        $this->initVar( 'wfc_author', XOBJ_DTYPE_TXTBOX, null, false, 255 );
        $this->initVar( 'wfc_caption', XOBJ_DTYPE_TXTBOX, null, false, 255 );
        $this->initVar( 'wfc_active', XOBJ_DTYPE_INT, 1, false );
        // **//
        $this->initVar( 'dohtml', XOBJ_DTYPE_INT, 0, false );
        $this->initVar( 'doxcode', XOBJ_DTYPE_INT, 1, false );
        $this->initVar( 'dosmiley', XOBJ_DTYPE_INT, 1, false );
        $this->initVar( 'doimage', XOBJ_DTYPE_INT, 1, false );
        $this->initVar( 'dobr', XOBJ_DTYPE_INT, 1, false );

        $this->uploadDir = $GLOBALS['xoopsModuleConfig']['htmluploaddir'];
    }

    /**
     * wfc_Page::getIcons()
     *
     * @return
     */
    function getIcons() {
        $iconArray = wfp_getModuleOption( 'pageicon' );
        $flipped = array_flip( $iconArray );

        $iconVars = array( 0 => 'none', 1 => 'rss', 2 => 'print', 3 => 'pdf', 4 => 'email', 5 => 'bookmark' );
        $ret = array();
        foreach( $iconVars as $k => $v ) {
            if ( !isset( $flipped[0] ) ) {
                $ret[$v] = ( isset( $flipped[$k] ) ) ? 1 : 0;
            }
        }
        return $ret;
    }

    /**
     * wfc_Page::getUserName()
     *
     * @param mixed $value
     * @param string $timestamp
     * @param mixed $usereal
     * @param mixed $linked
     * @return
     */
    function getUserName( $value, $timestamp = '', $usereal = false, $linked = false ) {
        if ( $this->getVar( 'wfc_author' ) ) {
            return $this->getVar( 'wfc_author' );
        }
        return parent::getUserName( $value, $timestamp = '', $usereal = false, $linked = false );
    }

    /**
     * wfc_Page::getTitle()
     *
     * @return
     */
    function getTitle() {
        if ( wfp_getModuleOption( 'displaypagetitle' ) ) {
            return $this->getVar( 'wfc_headline' );
        } else {
            return '';
        }
    }

    /**
     * wfc_Page::getContent()
     *
     * @return
     */
    function &getContent( $doPageNav = true, $type = 'content' ) {
        $clean = wfp_getClass( 'clean' );

        $ret = $clean->getHtml( $this->getVar( 'wfc_file' ), $this->getVar( 'wfc_content', 'e' ), $this->uploadDir );
        $this->setVar( 'wfc_content', htmlspecialchars_decode( $ret ) );
        if ( $doPageNav == true ) {
            $text = explode( '[pagebreak]', $this->getVar( 'wfc_content', 'e' ) );
            if ( count( $text ) > 0 ) {
                include_once XOOPS_ROOT_PATH . '/class/pagenav.php';

                $page = wfp_Request::doRequest( $_REQUEST, 'page', 0, 'int' );
                $this->setVar( 'wfc_content', htmlspecialchars_decode( $text[$page] ) );
                $pagenav = new XoopsPageNav( count( $text ), 1, $page, 'page', "cid=" . $this->getVar( 'wfc_cid' ) );
                $this->setPageNav( $pagenav );
            }
        }

        $contents = &$this->getVar( 'wfc_content', 's' );
        return $contents;
    }

    /**
     * wfc_Page::getBookMarks()
     *
     * @return
     */
    function getBookMarks() {
        if ( wfp_getModuleOption( 'displaybookmarks' ) ) {
            $addto = wfp_getClass( 'addto' );
            return $addto->render( $this->getTitle() );
        }
    }

    /**
     * wfc_Page::getEmailLink()
     *
     * @return
     */
    function getEmailLink() {
        return 'mailto:?subject=' . sprintf( _MD_WFC_INTARTICLE, $GLOBALS['xoopsConfig']['sitename'] ) . '&amp;body=' . sprintf( _MD_WFC_INTARTFOUND, $GLOBALS['xoopsConfig']['sitename'] ) . ':  ' . XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/index.php?cid=' . $this->getVar( 'wfc_cid' );
    }

    /**
     * wfc_Page::getBookMarks()
     *
     * @return
     */
    function getPageNav() {
        return $this->pageNav->renderNav();
    }

    /**
     * wfc_Page::setPageNav()
     *
     * @param mixed $value
     * @return
     */
    function setPageNav( $value ) {
        $this->pageNav = $value;
    }

    /**
     * wfc_Page::getMetaTitle()
     *
     * @return
     */
    function getMetaKeyWords() {
        $desc = explode( ' ', strip_tags( $this->getVar( 'wfc_metakeywords' ) ) );
        $ret = implode( ' ', array_filter( $desc, 'ltrim' ) );
        return $ret;
    }

    /**
     * wfc_Page::wfc_metatitle()
     *
     * @return
     */
    function getMetaDescription() {
        return strip_tags( $this->getVar( 'wfc_metadescription' ) );
    }
}

/**
 * wfc_PageHandler
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class wfc_PageHandler extends wfp_ObjectHandler {
    var $usestags = true;
    /**
     * wfc_PageHandler::XoopsCategoryHandler()
     *
     * @param mixed $db
     * @return
     */
    function wfc_PageHandler( &$db ) {
        $this->wfp_ObjectHandler( $db, 'wfcpages', 'wfc_Page', 'wfc_cid', 'wfc_title', 'page_read' );
    }

    /**
     * wfc_PageHandler::getList()
     *
     * @return
     */
    function &getList( $sort = 'wfc_weight', $order = 'ASC', $start = 0 , $limit = 0 ) {
        static $channels;

        if ( !$channels ) {
            $criteriaPublished = new CriteriaCompo();
            $criteriaPublished->add( new Criteria( 'wfc_publish', 0, '>' ) );
            $criteriaPublished->add( new Criteria( 'wfc_publish', time(), '<=' ) );

            $criteriaExpired = new CriteriaCompo();
            $criteriaExpired->add( new Criteria( 'wfc_expired', 0, '=' ) );
            $criteriaExpired->add( new Criteria( 'wfc_expired', time(), '>' ), 'OR' );

            $criteria = new CriteriaCompo();
            $criteria->add( $criteriaPublished );
            $criteria->add( $criteriaExpired );
            $criteria->add( new Criteria( 'wfc_mainmenu', 1, '=' ), 'AND' );
            $criteria->add( new Criteria( 'wfc_default', 0, '=' ) );

            $criteria->setSort( 'wfc_weight' );
            $criteria->setOrder( 'ASC' );
            $criteria->setStart( $start );
            $criteria->setLimit( $start );
            $channels = &$this->getObjects( $criteria );
        }
        return $channels;
    }

    /**
     * wfc_PageHandler::getDefaultPage()
     *
     * @return
     */
    function &getDefaultPage() {
        $ret = '';
        $obj = $this->get( 0, true, 'wfc_default' );
        if ( is_object( $obj ) ) {
            $ret['id'] = $_SESSION['wfchanneldefault']['id'] = $obj->getVar( 'wfc_cid' );
            $ret['title'] = $_SESSION['wfchanneldefault']['title'] = $obj->getVar( 'wfc_title' );
        }
        return $ret;
    }

    /**
     * wfc_PageHandler::getObj()
     *
     * @param array $nav
     * @param mixed $value
     * @return
     */
    function &getObj() {
        $myts = &MyTextSanitizer::getInstance();

        $obj = false;
        if ( func_num_args() == 2 ) {
            $args = func_get_args();
            $criteria = new CriteriaCompo();
            if ( !empty( $args[0]['search'] ) ) {
                $args[0]['search'] = stripslashes( $args[0]['search'] );
                if ( isset( $args[0]['andor'] ) && $args[0]['andor'] != 'exact' ) {
                    $temp_queries = preg_split( '/[\s,]+/', $args[0]['search'] );
                    $queryarray = array();
                    foreach ( $temp_queries as $q ) {
                        $q = trim( $q );
                        if ( strlen( $q ) >= 5 ) {
                            $queryarray[] = mysql_escape_string( $q );
                        }
                    }
                } else {
                    $queryarray = array( trim( mysql_escape_string( $args[0]['search'] ) ) );
                }
                $criteriaSearch = self::searchCriteria( $queryarray, $args[0]['andor'], true, $criteria );
            }
            if ( !empty( $args[0]['date'] ) ) {
                $addon_date = &$this->getaDate( $args[0]['date'] );
                if ( $addon_date['begin'] && $addon_date['end'] ) {
                    $criteriaDate = new CriteriaCompo();
                    $criteriaDate->add( new Criteria( 'wfc_publish', wfp_addslashes( $addon_date['begin'] ), '>=' ) );
                    $criteriaDate->add( new Criteria( 'wfc_publish', wfp_addslashes( $addon_date['end'] ), '<=' ) );
                    $criteria->add( $criteriaDate );
                }
            }
            switch ( ( int )$args[0]['active'] ) {
                case 1:
                    // $criteria->add( new Criteria( 'wfc_publish', 1, '=' ) );
                    $criteriaPublished = new CriteriaCompo();
                    $criteriaPublished->add( new Criteria( 'wfc_publish', 0, '>' ) );
                    $criteriaPublished->add( new Criteria( 'wfc_publish', time(), '<=' ) );
                    $criteria->add( $criteriaPublished );
                    break;
                case 2:
                    $criteria->add( new Criteria( 'wfc_publish', 0, '=' ) );
                    break;
                case 3:
                    $criteriaExpired = new CriteriaCompo();
                    $criteriaExpired->add( new Criteria( 'wfc_expired', time(), '>' ), 'OR' );
                    $criteria->add( $criteriaExpired );
                    break;
                case 4:
                    $criteria->add( new Criteria( 'wfc_active', ( int )$args[0]['active'], '=' ) );
                    break;
            }
            $obj['count'] = $this->getCount( $criteria );
            if ( !empty( $args[0] ) ) {
                $criteria->setSort( wfp_addslashes( $args[0]['sort'] ) );
                $criteria->setOrder( wfp_addslashes( $args[0]['order'] ) );
                $criteria->setStart( ( int )$args[0]['start'] );
                $criteria->setLimit( ( int )$args[0]['limit'] );
            }
            $obj['list'] = &$this->getObjects( $criteria, $args[1] );
        }
        return $obj;
    }

    /**
     * wfc_PageHandler::getRelated()
     *
     * @return
     */
    function &getRelated( &$obj ) {
        xoops_load( 'xoopscache' );
        $ret = XoopsCache::read( 'wfc_related' . md5( $obj->getVar( 'wfc_cid' ) ) );
        if ( !$ret ) {
            $relatedTerms = explode( ' ', $obj->getVar( 'wfc_related' ) );
            $relatedTerms = array_filter( array_map( 'trim', $relatedTerms ) );
            $page_search = &$this->getSearch( $relatedTerms, $andor = '', 10, 0, false );
            $ret = array();
            $i = 0;
            if ( !empty( $page_search['list'] ) ) {
                foreach( $page_search['list'] as $object ) {
                    if ( $object->getVar( 'wfc_cid' ) == $obj->getVar( 'wfc_cid' ) ) {
                        continue;
                    }
                    $ret['related'][$i] = array( 'link' => $object->getVar( 'wfc_cid' ),
                        'title' => $object->getTitle(),
                        'time' => $object->getTimeStamp( 'wfc_publish' ),
                        'uid' => ( $object->getVar( 'wfc_author' ) ) ? $object->getVar( 'wfc_author' ): $object->getUserName( 'wfc_uid' ),
                        );
                    $i++;
                }
            }
            XoopsCache::write( 'wfc_related' . md5( $obj->getVar( 'wfc_cid' ) ), $ret );
        }
        return $ret;
    }

    /**
     * wfc_PageHandler::getNextPreviousLinks()
     *
     * @return
     */
    function getNextPreviousLinks( $cid ) {
        if ( !wfp_getModuleOption( 'allow_pnlinks' ) ) {
            return false;
        }

        $page = wfp_Request::doRequest( $_REQUEST, 'page', 0, 'int' );

        $wfpages_obj = &$this->getList();
        $array_keys = array();
        foreach ( $wfpages_obj as $key => $obj ) {
            $array_keys[$key] = $obj->getVar( 'wfc_cid' );
        }
        $current_item = array_search( $cid, $array_keys );

        $previous = $current_item - 1;
        $links['previous'] = '';
        if ( $previous >= 0 ) {
            if ( is_object( $wfpages_obj[$previous] ) ) {
                $links['previous']['link'] = 'index.php?cid=' . $wfpages_obj[$previous]->getVar( 'wfc_cid' );
                $links['previous']['title'] = $wfpages_obj[$previous]->getVar( 'wfc_title' );
            }
        }
        // }
        $next = $current_item + 1;
        $links['next'] = '';
        if ( $next < count( $array_keys ) ) {
            if ( is_object( $wfpages_obj[$next] ) ) {
                $links['next']['link'] = 'index.php?cid=' . $wfpages_obj[$next]->getVar( 'wfc_cid' );
                $links['next']['title'] = $wfpages_obj[$next]->getVar( 'wfc_title' );
            }
        }
        return $links;
    }

    /**
     * wfc_PageHandler::getChanlinks()
     *
     * @return
     */
    function &getChanlinks() {
        $cid = wfp_Request::doRequest( $_REQUEST, 'cid', 0, 'int' );
        $op = wfp_Request::doRequest( $_REQUEST, 'op', '', 'textbox' );

        $css = ( $cid == 0 && !$op ) ? 'page_underline' : 'page_none';

        $wfpages['chanlink'][] = array( 'css' => $css, 'id' => '', 'title' => _MD_WFC_HOME );
        $wfpages_obj = &$this->getList();

        if ( !empty( $wfpages_obj ) ) {
            foreach ( array_keys( $wfpages_obj ) as $i ) {
                $css = ( $wfpages_obj[$i]->getVar( 'wfc_cid' ) == $cid ) ? 'page_underline' : 'page_none';
                $wfpages['chanlink'][] = array( 'css' => $css, 'id' => '?cid=' . $wfpages_obj[$i]->getVar( 'wfc_cid' ), 'title' => $wfpages_obj[$i]->getVar( 'wfc_title' ) );
            }
            unset( $wfpages_obj );
        }
        /**
         * Links
         */

        if ( !wfp_getModuleOption( 'act_link' ) ) {
            unset( $_SESSION['wfc_channel']['wfcl_titlelink'] );
        }

        $css = ( $op == 'link' ) ? 'page_underline' : 'page_none';
        if ( !isset( $_SESSION['wfc_channel']['wfcl_titlelink'] ) ) {
            $links_handler = &wfp_gethandler( 'link', _MODULE_DIR, _MODULE_CLASS );
            $links = $links_handler->get( 1 );
            if ( $links && wfp_getModuleOption( 'act_link' ) ) {
                $_SESSION['wfc_channel']['wfcl_titlelink'] = $links->getVar( 'wfcl_titlelink' );
                if ( is_object( $links ) && $links->getVar( 'wfcl_mainpage' ) ) {
                    $wfpages['chanlink'][] = array( 'css' => $css, 'id' => '?op=link', 'title' => $links->getVar( 'wfcl_titlelink' ) );
                }
            }
        } else {
            if ( isset( $_SESSION['wfc_channel']['wfcl_titlelink'] ) ) {
                $wfpages['chanlink'][] = array( 'css' => $css, 'id' => '?op=link', 'title' => $_SESSION['wfc_channel']['wfcl_titlelink'] );
            }
        }

        /**
         * Refer
         */
        if ( !$GLOBALS['xoopsModuleConfig']['act_refer'] ) {
            unset( $_SESSION['wfc_channel']['wfcr_title'] );
        }
        $css = ( $op == 'refer' ) ? 'page_underline' : 'page_none';
        if ( !isset( $_SESSION['wfc_channel']['wfcr_title'] ) ) {
            $refer_handler = &wfp_gethandler( 'refer', _MODULE_DIR, _MODULE_CLASS );
            $refer = $refer_handler->get( 1 );
            if ( $refer && $GLOBALS['xoopsModuleConfig']['act_refer'] ) {
                $_SESSION['wfc_channel']['wfcr_title'] = $refer->getVar( 'wfcr_title' );
                if ( is_object( $refer ) && $refer->getVar( 'wfcr_mainpage' ) ) {
                    $wfpages['chanlink'][] = array( 'css' => $css, 'id' => '?op=refer', 'title' => $refer->getVar( 'wfcr_title' ) );
                }
            }
        } else {
            if ( isset( $_SESSION['wfc_channel']['wfcr_title'] ) ) {
                $wfpages['chanlink'][] = array( 'css' => $css, 'id' => '?op=refer', 'title' => $_SESSION['wfc_channel']['wfcr_title'] );
            }
        }
        return $wfpages;
    }

    /**
     * wfc_PageHandler::update()
     *
     * @return
     */
    function update( &$obj ) {
        if ( ( is_object( $GLOBALS['xoopsUser'] ) && $GLOBALS['xoopsUser']->isAdmin() ) && ( isset( $GLOBALS['xoopsModuleConfig']['allow_admin'] ) && $GLOBALS['xoopsModuleConfig']['allow_admin'] == 0 ) ) {
            return false;
        } else {
            $criteria = new CriteriaCompo();
            $criteria->add( new Criteria( 'wfc_cid', $obj->getVar( 'wfc_cid' ) ) );
            $this->updateCounter( 'wfc_counter', $criteria );
        }
    }

    /**
     * wfc_PageHandler::updateDefaultPage()
     *
     * @return
     */
    function updateDefaultPage( $doFull = false ) {
        if ( $doFull ) {
            $this->updateAll( 'wfc_default', 0 );
        }
        unset( $_SESSION['wfchanneldefault'] );
    }

    /**
     * wfc_PageHandler::searchCriteria()
     *
     * @param mixed $queryarray
     * @param string $andor
     * @param mixed $moreChecks
     * @return
     */
    function searchCriteria( $queryarray, $andor = '', $moreChecks, &$criteria ) {
        $criteriaSearch = new CriteriaCompo();

        if ( isset( $queryarray[0] ) ) {
            if ( $moreChecks == true ) {
                $criteriaSearch->add( new Criteria( 'wfc_title', "%$queryarray[0]%", 'LIKE' ), 'OR' );
                $criteriaSearch->add( new Criteria( 'wfc_headline', "%$queryarray[0]%", 'LIKE' ), 'OR' );
                $criteriaSearch->add( new Criteria( 'wfc_content', "%$queryarray[0]%", 'LIKE' ), 'OR' );
            }
            $criteriaSearch->add( new Criteria( 'wfc_related', "%$queryarray[0]%", 'LIKE' ), 'OR' );
        }
        if ( !empty( $andor ) ) {
            for( $i = 1;$i < count( $queryarray );$i++ ) {
                if ( $moreChecks == true ) {
                    $criteriaSearch->add( new Criteria( 'wfc_title', "%$queryarray[$i]%", 'LIKE' ), 'OR' );
                    $criteriaSearch->add( new Criteria( 'wfc_headline', "%$queryarray[$i]%", 'LIKE' ), 'OR' );
                    $criteriaSearch->add( new Criteria( 'wfc_content', "%$queryarray[$i]%", 'LIKE' ), 'OR' );
                }
                $criteriaSearch->add( new Criteria( 'wfc_related', "%$queryarray[$i]%", 'LIKE' ), 'OR' );
            }
        }
        $criteria->add( $criteriaSearch );
    }

    /**
     * wfc_PageHandler::getSearch()
     *
     * @param mixed $queryarray
     * @param mixed $andor
     * @param mixed $limit
     * @param mixed $offset
     * @return
     */
    function &getSearch( $queryarray, $andor, $limit, $offset, $moreChecks = true ) {
        if ( $andor != 'exact' ) {
            $andor = $andor;
        } else {
            $andor = '';
        }
        $criteria = new CriteriaCompo();
        if ( is_array( $queryarray ) && count( $queryarray ) ) {
            self::searchCriteria( $queryarray, $andor, $moreChecks, $criteria );
            $criteriaPublished = new CriteriaCompo();
            $criteriaPublished->add( new Criteria( 'wfc_publish', 0, '>' ) );
            $criteriaPublished->add( new Criteria( 'wfc_publish', time(), '<=' ) );
            $criteria->add( $criteriaPublished );

            $criteriaExpired = new CriteriaCompo();
            $criteriaExpired->add( new Criteria( 'wfc_expired', 0, '=' ) );
            $criteriaExpired->add( new Criteria( 'wfc_expired', time(), '>' ), 'OR' );
            $criteria->add( $criteriaExpired );
            $criteria->add( new Criteria( 'wfc_active', 4, '!=' ) );

            $criteria->setSort( 'wfc_publish' );
            $criteria->setOrder( 'DESC' );
            $criteria->setStart( ( int )$offset );
            $criteria->setLimit( ( int )$limit );
            $obj['list'] = &$this->getObjects( $criteria, false );
        }
        return $obj;
    }

    /**
     * wfc_PageHandler::getAction()
     *
     * @param mixed $obj
     * @param mixed $act
     * @return
     */
    function getAction( &$obj, $act ) {
        /**
         * do switch
         */
        switch ( $act ) {
            case 'print':
                $printerPage = wfp_getClass( 'doprint', _RESOURCE_DIR, _RESOURCE_CLASS );
                $printerPage->setOptions( self::pdf_data( $obj, $act ) );
                $printerPage->doRender();
                break;
            case 'rss':
                if ( file_exists( $file = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/include/rss.php' ) ) {
                    include $file;
                } else {
                    $file = str_replace( XOOPS_ROOT_PATH , '', $file );
                    error_reporting( sprintf( _MA_WFC_FILENOTFOUND, $file, __FILE__, __LINE__ ) );
                }
                break;
            case 'pdf':
                $pdfPage = wfp_getClass( 'dopdf', _RESOURCE_DIR, _RESOURCE_CLASS );
                $ret = $pdfPage->getCache( $obj->getVar( 'wfc_cid' ), $obj->getVar( 'wfc_cid' ) );
                if ( !$ret ) {
                    $pdfPage->setOptions( self::pdf_data( $obj, $act ) );
                    $pdfPage->doRender();
                }
                break;
        } // switch
        exit();
    }

    /**
     * wfc_PageHandler::pdf_data()
     *
     * @param mixed $obj
     * @return
     */
    function pdf_data( &$obj, $act ) {
        $pdf_data['id'] = $obj->getVar( 'wfc_cid' );
        $pdf_data['title'] = $obj->getVar( 'wfc_title' );
        $pdf_data['subtitle'] = $obj->getVar( 'wfc_headline' );
        $pdf_data['creator'] = $GLOBALS['xoopsConfig']['sitename'];
        $pdf_data['subsubtitle'] = '';
        $pdf_data['renderdate'] = $obj->formatTimeStamp( 'today' );
        $pdf_data['pdate'] = $obj->formatTimeStamp( 'wfc_publish' );
        $pdf_data['slogan'] = $GLOBALS['xoopsConfig']['sitename'] . ' - ' . $GLOBALS['xoopsConfig']['slogan'];
        $pdf_data['content'] = $obj->getVar( 'wfc_content' );
        $pdf_data['sitename'] = $GLOBALS['xoopsConfig']['sitename'];
        $pdf_data['itemurl'] = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/index.php?index.php?cid=' . $obj->getVar( 'wfc_cid' );
        $pdf_data['stdoutput'] = 'file';
        return $pdf_data;
    }
    /**
     * wfc_PageHandler::getPageNumber()
     *
     * @return
     */
    function getPageNumber() {
        $ret = 0;
        if ( isset( $_REQUEST['wfc_cid'] ) ) {
            $ret = $ok = wfp_Request::doRequest( $_REQUEST, 'wfc_cid', 0, 'int' );
        } elseif ( isset( $_REQUEST['cid'] ) ) {
            $ret = wfp_Request::doRequest( $_REQUEST, 'cid', 0, 'int' );
        } elseif ( isset( $_REQUEST['pagenum'] ) ) {
            $ret = wfp_Request::doRequest( $_REQUEST, 'pagenum', 0, 'int' );
        }
        return ( int )$ret;
    }

    /**
     * wfc_PageHandler::upDateNotification()
     *
     * @return
     */
    function upDateNotification( &$obj, $page_type = '' ) {
        $tags = array();
        switch ( $page_type ) {
            case 'page_modified':
                $tags['PAGE_NAME'] = $obj->getVar( 'wfc_title' );
                $tags['PAGE_URL'] = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/index.php?cid=' . $obj->getVar( 'wfc_cid' );
                $notification_handler = &xoops_gethandler( 'notification' );
                $notification_handler->triggerEvent( 'page', $obj->getVar( 'wfc_cid' ), $page_type, $tags );
                break;
            case 'page_new':
            default:
                $tags['PAGE_NAME'] = $obj->getVar( 'wfc_title' );
                $tags['PAGE_URL'] = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/index.php?cid=' . $obj->getVar( 'wfc_cid' );
                $notification_handler = &xoops_gethandler( 'notification' );
                $notification_handler->triggerEvent( 'page', $obj->getVar( 'wfc_cid' ), $page_type, $tags );
                break;
        }
    }

    /**
     * wfc_PageHandler::upTagHandler()
     *
     * @param mixed $obj
     * @param string $page_type
     * @return
     */
    function upTagHandler( &$obj ) {
        $item_tag = wfp_Request::doRequest( $_REQUEST, 'item_tag', '', 'textbox' );
        $tag_handler = xoops_getmodulehandler( 'tag', 'tag' );
        if ( $tag_handler ) {
            $tag_handler->updateByItem( $item_tag, $obj->getVar( 'wfc_cid' ), $GLOBALS['xoopsModule']->getVar( 'dirname' ), 0 );
        }
    }

    /**
     * wfc_PageHandler::pageInfo()
     *
     * @param mixed $itemid
     * @return
     */
    function pageInfo( &$obj ) {
        $url = XOOPS_URL . '/modules/system/admin.php?module=' . $GLOBALS['xoopsModule']->getVar( 'mid' ) . '&status=0&limit=10&fct=comments&selsubmit=Go%21';
        $ret = '<div>' . _MA_WFC_TOTALCOMENTS . '<b>' . $obj->getVar( 'wfc_comments' ) . '</b>';
        if ( $obj->getVar( 'wfc_comments' ) ) {
            $ret .= '&nbsp;<a href="' . $url . '">' . _MA_WFC_VIEWCOMMENTS . '</a>';
        }

        $ret .= '</div>';
        $ret .= '<div>' . _MA_WFC_TOTALPAGEREADS . '<b>' . $obj->getVar( 'wfc_counter' ) . '</b></div>';
        $ret .= '<div>' . _MA_WFC_PAGECREATED . '<b>' . formatTimestamp( $obj->getVar( 'wfc_created' ) ) . '</b></div>';
        $time = ( $obj->getVar( 'wfc_publish' ) ) ? formatTimestamp( $obj->getVar( 'wfc_publish' ) ) : '';
        $ret .= '<div>' . _MA_WFC_LASUPDATED . '<b>' . $time . '</b></div><br />';
        return $ret;
    }

    /**
     * wfc_RefersHandler::displayCalendar()
     *
     * @return
     */
    function headingHtml() {
        $ret = '';
        if ( func_num_args() != 1 ) {
            return $ret;
        }
        $total_count = $this->getCount();
        $refers_handler = &wfp_gethandler( 'refers', 'wfchannel', 'wfc_' );
        $refer_count = $refers_handler->getEmailSentCount();
        $default = self::getDefaultPage();
        $ret .= '<input class="wfbutton" type="button" name="button" onclick=\'location="index.php?op=edit"\' value="' . _MA_WFP_CREATENEW . '" />';
        $ret .= '<div style="padding-bottom: 8px;">';
        if ( $default == null ) {
            $ret .= _MA_WFC_NODEFAULTPAGESET;
        } else {
            $ret .= _MA_WFC_DEFAULTPAGESET . ": <a href='../index.php?op=edit&wfc_cid=" . $default['id'] . "'>" . $default['title'] . "</a>";
        }
        $ret .= '<div>' . _MA_WFC_TOTALNUMCHANL . ': <b>' . $total_count . '</b></div>';
        $ret .= '<div>' . _MA_WFC_TOTALEMAILSSENT . ': <b>' . $refer_count . '</b></div>';
        if ( $refer_count > 0 ) {
            $ret .= '<a href="' . XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/admin/refers.php">' . _MA_WFC_VIEW . '</a><br />';
        }
        $ret .= '</div>';
        echo $ret;
        unset( $refer_handler );
    }
}

?>