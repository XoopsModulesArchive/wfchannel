<?php
/**
 * Name: form_wfc_refer.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2009 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: form_wfc_refer.php 0000 14/03/2009 16:22:32:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

global $xoopsTpl, $refer_handler;

/**
 */
xoops_load( 'XoopsForm' );

$form = new XoopsThemeForm( '', 'refer_form', 'index.php', 'post', true );
$form->setExtra( 'enctype="multipart/form-data"' );
$form->addElement( new XoopsFormText( _MD_WFC_SENDERNAME, 'uname', 40, 255, $this->getVar( 'uname' ) ), true );
$form->addElement( new XoopsFormText( _MD_WFC_SENDEREMAIL, 'email', 40, 255, $this->getVar( 'emailaddy' ) ), true );
$form->addElement( new XoopsFormText( _MD_WFC_RECPINAME, 'runame', 40, 255 ), true );
$form->addElement( new XoopsFormText( _MD_WFC_RECPIEMAIL, 'remail', 40, 255 ), true );
if ( $this->getVar( 'wfsr_ublurb' ) ) {
    $form->addElement( new XoopsFormTextArea( _MD_WFC_CAPTACHA, 'message', $this->getVar( 'wfcr_dblurb' ) ), false );
} else {
    $form->addElement( new XoopsFormHidden( 'message', $this->getVar( 'wfcr_dblurb' ) ) );
}

xoops_load( 'XoopsCaptcha' );
$xoopsCaptcha = XoopsCaptcha::getInstance();

var_dump( $xoopsCaptcha->isActive() );

if ( $xoopsCaptcha->isActive() ) {
    $form->addElement( new XoopsFormCaptcha( _MD_WFC_CAPTACHA, 'captcha' ), true );
}
$form->addElement( new XoopsFormHidden( 'op', 'refersend' ) );
$form->addElement( new XoopsFormButtontray( 'submit', _SUBMIT ) );
$form->assign( $xoopsTpl );

?>