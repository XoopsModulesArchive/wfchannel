<?php
/**
 * Name: class.refers.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: class.refers.php 0000 24/03/2009 23:25:30:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

wfp_getObjectHander();

/**
 * WfchannelRefers
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class wfc_Refers extends wfp_Object {
	/**
	 * XoopsWfPage::XoopsWfPage()
	 */
	function wfc_Refers() {
		$this->XoopsObject();
		$this->initVar( 'wfcr_id', XOBJ_DTYPE_INT, null, false );
		$this->initVar( 'wfcr_username', XOBJ_DTYPE_TXTBOX, null, true, 60 );
		$this->initVar( 'wfcr_uid', XOBJ_DTYPE_INT, null, false );
		$this->initVar( 'wfcr_referurl', XOBJ_DTYPE_TXTBOX, null, true, 255 );
		$this->initVar( 'wfcr_date', XOBJ_DTYPE_TXTBOX, null, true, 60 );
		$this->initVar( 'wfcr_ip', XOBJ_DTYPE_TXTBOX, null, true, 60 );
	}

	/**
	 * WfchannelRefers::getUid()
	 *
	 * @return
	 */
	function getUid() {
		if ( $this->getVar( 'wfcr_username' ) ) {
			return $this->getVar( 'wfcr_username' );
		} else {
			return xoops_getLinkedUnameFromId( $this->getVar( 'wfcr_uid' ) );
		}
	}

	/**
	 * WfchannelRefers::getReferUrl()
	 *
	 * @return
	 */
	function getReferUrl() {
		if ( !$this->getVar( 'wfcr_referurl' ) ) {
			return '';
		}
		$URL = parse_url( $this->getVar( 'wfcr_referurl' ) );
		return ( isset( $URL['host'] ) ) ? $URL['host'] : 'Unknown Host';
	}
}

/**
 * wfc_RefersHandler
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class wfc_RefersHandler extends wfp_ObjectHandler {
	/**
	 * WfchannelPageHandler::XoopsCategoryHandler()
	 *
	 * @param mixed $db
	 * @return
	 */
	function wfc_RefersHandler( &$db ) {
		$this->wfp_ObjectHandler( $db, 'wfcrefers', 'wfc_Refers', 'wfcr_id', 'wfcr_ip' );
	}

	/**
	 * WfchannelReferHandler::getEmailSentCount()
	 *
	 * @return
	 */
	function getEmailSentCount( $id = '' ) {
		$criteria = new CriteriaCompo();
		$criteria->add( new Criteria( 'wfcr_id', $id ) );

		$_count = $this->getCount( $criteria );
		return ( int )$_count['amount'];
	}

	/**
	 * WfchannelReferHandler::getEmailSentCount()
	 *
	 * @return
	 */
	function setEmailSendCount() {
		$criteria = new CriteriaCompo();
		$criteria->add( new Criteria( 'wfcr_id', 1 ) );
		$this->updateCounter( 'wfcr_counter', $criteria );
	}

	/**
	 * wfc_RefersHandler::getObj()
	 *
	 * @return
	 */
	function &getObj() {
		$obj = false;
		if ( func_num_args() == 2 ) {
			$args = func_get_args();
			$criteria = new CriteriaCompo();
			if ( !empty( $args[0]['search'] ) ) {
				$searchparms = $args[0]['search'];
				$criteria->add( new Criteria( 'wfcr_username', "%$searchparms%", 'LIKE' ), 'OR' );
				$criteria->add( new Criteria( 'wfcr_ip', "%$searchparms%", 'LIKE' ), 'OR' );
				$criteria->add( new Criteria( 'wfcr_referurl', "%$searchparms%", 'LIKE' ), 'OR' );
			}
			if ( !empty( $args[0]['date'] ) ) {
				$addon_date = &$this->getaDate( $args[0]['date'] );
				if ( $addon_date['begin'] && $addon_date['end'] ) {
					$criteria->add( new Criteria( 'wfcr_date', $addon_date['begin'], '>=' ), 'AND' );
					$criteria->add( new Criteria( 'wfcr_date', $addon_date['end'], '<=' ) );
				}
			}
			$obj['count'] = $this->getCount( $criteria );
			if ( !empty( $args[0] ) ) {
				$criteria->setSort( $args[0]['sort'] );
				$criteria->setOrder( $args[0]['order'] );
				$criteria->setStart( $args[0]['start'] );
				$criteria->setLimit( $args[0]['limit'] );
			}
			$obj['list'] = $this->getObjects( $criteria, $args[1] );
		}
		return $obj;
	}

	/**
	 * wfc_RefersHandler::headingHtml()
	 *
	 * @return
	 */
	function headingHtml() {
		$ret = '';
		if ( func_num_args() == 1 ) {
			$ret = '<div style="padding-bottom: 8px;">' . _MA_WFC_TOTALEMAILSSENT . ': <b>' . func_get_arg( 0 ) . '</b></div>';
		}
		/**
		 */
		echo $ret;
	}

	/**
	 * wfc_RefersHandler::getIP()
	 *
	 * @return
	 */
	function getIP() {
		if ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$ret = getenv( 'HTTP_CLIENT_IP' );
		} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$ret = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
			$ret = getenv( 'HTTP_X_FORWARDED' );
		} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
			$ret = getenv( 'HTTP_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
			$ret = getenv( 'HTTP_FORWARDED' );
		} else {
			$ret = $_SERVER['REMOTE_ADDR'];
		}
		return $ret;
	}
}

?>