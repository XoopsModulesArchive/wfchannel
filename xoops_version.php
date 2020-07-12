<?php
// ------------------------------------------------------------------------ //
// Xoops - PHP Content Management System                      			//
// Copyright (c) 2007 Xoops                           				//
// //
// Authors: 																//
// John Neill ( AKA Catzwolf )                                     			//
// Raimondas Rimkevicius ( AKA Mekdrop )									//
// //
// URL: http:www.Xoops.com 												//
// Project: Xoops Project                                               //
// -------------------------------------------------------------------------//
$modversion['name'] = _MA_WFC_CHANNEL;
$modversion['version'] = 2.06;
$modversion['requires'] = 1.05;
$modversion['description'] = _MA_WFC_CHANNELDESC;
$modversion['releasedate'] = 'Thursday 13.5.2010';
$modversion['author'] = 'John Neill';
$modversion['credits'] = 'I would like to thank all the people who in some way or another who have either helped with coding or contributed with the development of this module. Mark Boyden, many thanks for your contribution and help with the development of this module..and you may get your wish yet! ;)';
$modversion['status'] = '2.06 Beta. First public beta release.';
$modversion['lead'] = 'John Neill aka Catzwolf';
$modversion['contributors'] = 'Predator, Phppp, Bender, giba and many others. Thank you :)';
$modversion['website_url'] = 'http://www.xoosla.com';
$modversion['website_name'] = 'Xoosla Modules';
$modversion['email'] = 'support@xoosla.com';
$modversion['demo_site_url'] = 'http://demo.xoosla.com/modules/wfchannel/';
$modversion['demo_site_name'] = 'WF-Channel Demo';
$modversion['support_site_url'] = 'http://www.xoosla.com/forum/index.php?f=10&rb_v=viewforum';
$modversion['support_site_name'] = 'Offical Support Website';

$modversion['submit_bug_url'] = 'http://code.google.com/p/xoosla-modules/issues/list';
$modversion['submit_bug_name'] = 'Bug Submission';

$modversion['submit_feature_url'] = 'http://www.xoosla.com/forum/index.php?f=19&rb_v=viewforum';
$modversion['submit_feature_name'] = 'Feature Submission';

$modversion['disclaimer'] = _MA_WFC_CHANNELDISCLAIMER;

$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/wfchannel_slogo.png';
$modversion['dirname'] = 'wfchannel';
// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/wfchannel.sql';
// Tables created by sql file (without prefix!)
$modversion['tables'][] = 'wfcpages';
$modversion['tables'][] = 'wfclink';
$modversion['tables'][] = 'wfcrefer';
$modversion['tables'][] = 'wfcrefers';
// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';
// Additionnal script executed during install update
$modversion['onInstall'] = 'include/oninstall.php';
$modversion['onUpdate'] = 'include/onupdate.php';
$modversion['onUninstall'] = 'include/onuninstall.php';
// Blocks
// Menu
$modversion['hasMain'] = 1;
// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'wfchannel_search';
// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'index.php';
$modversion['comments']['itemName'] = 'cid';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'wfchannel_com_approve';
$modversion['comments']['callback']['update'] = 'wfchannel_com_update';
/**
 * Notifications
 */
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'wfchannel_notify_iteminfo';

$modversion['notification']['category'][] = array( 'name' => 'global',
	'title' => _MA_WFC_GLOBALNOTIFYCAT_TITLE,
	'description' => '_MA_WFC_GLOBALNOTIFYCAT_DESC',
	'subscribe_from' => array( 'index.php' ),
	'item_name' => '' );

$modversion['notification']['category'][] = array( 'name' => 'page',
	'title' => _MA_WFC_PAGENOTIFYCAT_TITLE,
	'description' => '_MA_WFC_PAGENOTIFYCAT_DESC',
	'subscribe_from' => array( 'index.php' ),
	'allow_bookmark' => 1,
	'item_name' => 'cid' );

$modversion['notification']['event'][] = array( 'name' => 'page_modified',
	'category' => 'global',
	'title' => _MA_WFC_GLOBALNOTIFY_TITLE,
	'caption' => _MA_WFC_GLOBALNOTIFY_CAPTION,
	'description' => '_MA_WFC_GLOBALNOTIFY_DESC',
	'mail_template' => 'global_pagemodified_notify',
	'mail_subject' => '_MA_WFC_GLOBALNOTIFY_SUBJECT' );

$modversion['notification']['event'][] = array( 'name' => 'page_new',
	'category' => 'global',
	'title' => _MA_WFC_GLOBALNEWNOTIFY_TITLE,
	'caption' => _MA_WFC_GLOBALNEWNOTIFY_CAPTION,
	'description' => '_MA_WFC_GLOBALNEWNOTIFY_DESC',
	'mail_template' => 'global_pagenew_notify',
	'mail_subject' => '_MA_WFC_GLOBALNEWNOTIFY_SUBJECT' );

$modversion['notification']['event'][] = array( 'name' => 'page_modified',
	'category' => 'page',
	'title' => _MA_WFC_PAGENOTIFY_TITLE,
	'caption' => _MA_WFC_PAGENOTIFY_CAPTION,
	'description' => '_MA_WFC_PAGENOTIFY_DESC',
	'mail_template' => 'global_pagemodified_notify',
	'mail_subject' => '_MA_WFC_PAGENOTIFY_SUBJECT' );

$modversion['notification']['event'][] = array( 'name' => 'page_new',
	'category' => 'page',
	'title' => _MA_WFC_PAGENEWNOTIFY_TITLE,
	'caption' => _MA_WFC_PAGENEWNOTIFY_CAPTION,
	'description' => '_MA_WFC_PAGENEWNOTIFY_DESC',
	'mail_template' => 'global_pagenew_notify',
	'mail_subject' => '_MA_WFC_PAGENEWNOTIFY_SUBJECT' );

/**
 * Blocks
 */
$modversion['blocks'][1]['file'] = 'wfc_block.new.php';
$modversion['blocks'][1]['name'] = _MA_WFC_BNAME1;
$modversion['blocks'][1]['description'] = 'Shows recently added donwload files';
$modversion['blocks'][1]['show_func'] = 'b_wfc_new_show';
$modversion['blocks'][1]['edit_func'] = 'b_wfc_new_edit';
$modversion['blocks'][1]['options'] = 'published|10|19|M/d/Y|' . $modversion['dirname'];
$modversion['blocks'][1]['template'] = 'wfchannel_block_new.html';

$modversion['blocks'][2]['file'] = 'wfc_block.menu.php';
$modversion['blocks'][2]['name'] = _MA_WFC_BNAME2;
$modversion['blocks'][2]['description'] = 'Shows Main menu type block';
$modversion['blocks'][2]['show_func'] = 'b_wfc_menu_show';
$modversion['blocks'][2]['edit_func'] = 'b_wfc_menu_edit';
$modversion['blocks'][2]['options'] = 'weight|10|19|' . $modversion['dirname'];
$modversion['blocks'][2]['template'] = 'wfchannel_block_menu.html';
// Templates
$modversion['templates'][1]['file'] = 'wfchannel_index.html';
$modversion['templates'][1]['description'] = 'Display index.';
$modversion['templates'][2]['file'] = 'wfchannel_linktous.html';
$modversion['templates'][2]['description'] = 'Display Link to Us page.';
$modversion['templates'][3]['file'] = 'wfchannel_refer.html';
$modversion['templates'][3]['description'] = 'Display refer page.';
$modversion['templates'][4]['file'] = 'wfchannel_banned.html';
$modversion['templates'][4]['description'] = 'Display a banned page.';
$modversion['templates'][5]['file'] = 'wfchannel_channellinks.html';
$modversion['templates'][5]['description'] = 'Display channel links within pages.';
$modversion['templates'][6]['file'] = 'wfchannel_emailerror.html';
$modversion['templates'][6]['description'] = 'Display channel email error page.';

$modversion['config'][] = array( 'name' => 'htmluploaddir',
	'title' => '_MA_WFC_HTMLUPLOADDIR',
	'description' => '_MA_WFC_HTMLUPLOADDIRDSC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'modules/' . $modversion['dirname'] . '/html'
	);

$modversion['config'][] = array( 'name' => 'uploaddir',
	'title' => '_MA_WFC_UPLOADDIR',
	'description' => '_MA_WFC_UPLOADDIRDSC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'modules/' . $modversion['dirname'] . '/images'
	);

$modversion['config'][] = array( 'name' => 'linkimages',
	'title' => '_MA_WFC_LINKIMAGES',
	'description' => '_MA_WFC_UPLOADDIRDSC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'modules/' . $modversion['dirname'] . '/images/linkimages'
	);

$modversion['config'][] = array( 'name' => 'maxfilesize',
	'title' => '_MA_WFC_MAXFILESIZE',
	'description' => '_MA_WFC_MAXFILESIZEDSC',
	'formtype' => 'textbox',
	'valuetype' => 'int',
	'default' => 120000
	);

$modversion['config'][] = array( 'name' => 'maximgwidth',
	'title' => '_MA_WFC_IMGWIDTH',
	'description' => '_MA_WFC_IMGWIDTHDSC',
	'formtype' => 'textbox',
	'valuetype' => 'int',
	'default' => 600
	);

$modversion['config'][] = array( 'name' => 'maximgheight',
	'title' => '_MA_WFC_IMGHEIGHT',
	'description' => '_MA_WFC_IMGHEIGHTDSC',
	'formtype' => 'textbox',
	'valuetype' => 'int',
	'default' => 600
	);

$modversion['config'][] = array( 'name' => 'perpage',
	'title' => '_MA_WFC_PERPAGE',
	'description' => '_MI_MYDOWNLOADS_PERPAGEDSC',
	'formtype' => 'select',
	'valuetype' => 'int',
	'default' => 10,
	'options' => array( '5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '50' => 50 )
	);

$modversion['config'][] = array( 'name' => 'displaypagetitle',
	'title' => '_MA_WFC_DISPLAYTITLE',
	'description' => '_MA_WFC_DISPLAYTITLEDSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => 1
	);

$modversion['config'][] = array( 'name' => 'use_wysiwyg',
	'title' => '_MA_WFC_WYSIWYG',
	'description' => '_MA_WFC_WYSIWYGDSC',
	'formtype' => 'select',
	'valuetype' => 'text',
	'default' => 'dhtmltextarea',
	'options' => array( 'Plain Editor' => 'textarea', 'Xoops Editor' => 'dhtmltextarea', 'Tiny Editor' => 'tinymce', 'FCK Editor' => 'ckeditor' )
	);

$modversion['config'][] = array( 'name' => 'banned',
	'title' => '_MA_WFC_BANNED',
	'description' => '_MA_WFC_BANNEDDSC',
	'formtype' => 'textarea',
	'valuetype' => 'text',
	'default' => ''
	);

$modversion['config'][] = array( 'name' => 'displaybookmarks',
	'title' => '_MA_WFC_BOOKMARK',
	'description' => '_MA_WFC_BOOKMARKDSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '1'
	);

$modversion['config'][] = array( 'name' => 'allowaddthiscode',
	'title' => '_MA_WFC_ALLOWADDTHISCODE',
	'description' => '_MA_WFC_ALLOWADDTHISCODE_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '0'
	);

$modversion['config'][] = array( 'name' => 'addthiscode',
	'title' => '_MA_WFC_ADDTHISCODE',
	'description' => '_MA_WFC_ADDTHISCODE_DSC',
	'formtype' => 'textarea',
	'valuetype' => 'text',
	'default' => ''
	);

$modversion['config'][] = array( 'name' => 'bookmarktextadd',
	'title' => '_MA_WFC_ALLOWBMTEXT',
	'description' => '_MA_WFC_ALLOWBMTEXT_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '0'
	);

$modversion['config'][] = array( 'name' => 'bookmarklayout',
	'title' => '_MA_WFC_BMLAYOUT',
	'description' => '_MA_WFC_BMLAYOUT_DSC',
	'formtype' => 'select',
	'valuetype' => 'int',
	'default' => '0',
	'options' => array( _MA_WFC_HORIZONTAL => 0,
		_MA_WFC_VERTICAL => 1
		) );

$modversion['config'][] = array( 'name' => 'menulinks',
	'title' => '_MA_WFC_MENULINKS',
	'description' => '_MA_WFC_MENULINKSDSC',
	'formtype' => 'select',
	'valuetype' => 'int',
	'default' => 3,
	'options' => array( 'None' => 0, 'Both' => 1, 'Top' => 2, 'Bottom' => 3 )
	);

$modversion['config'][] = array( 'name' => 'pageicon',
	'title' => '_MA_WFC_DISPLAYICONS',
	'description' => '_MA_WFC_DISPLAYICONS_DSC',
	'formtype' => 'select_multi',
	'valuetype' => 'array',
	'default' => array( 1, 2, 3, 4, 5 ),
	'options' => array( '_MA_WFC_NONE' => 0, '_MA_WFC_RSS_ICON' => 1, '_MA_WFC_PRINT_ICON' => 2, '_MA_WFC_PDF_ICON' => 3, '_MA_WFC_EMAILICON_ICON' => 4, '_MA_WFC_BOOKMARK_ICON' => 5 )
	);

$modversion['config'][] = array( 'name' => 'act_refer',
	'title' => '_MA_WFC_ACTIVATEREFERS',
	'description' => '_MA_WFC_ACTIVATEREFERS_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '1'
	);

$modversion['config'][] = array( 'name' => 'act_link',
	'title' => '_MA_WFC_ACTIVATELINKS',
	'description' => '_MA_WFC_ACTIVATELINKS_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '1'
	);

$modversion['config'][] = array( 'name' => 'allow_admin',
	'title' => '_MA_WFC_ALLOWADMIN',
	'description' => '_MA_WFC_ALLOWADMIN_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '0'
	);

$modversion['config'][] = array( 'name' => 'xoopstags',
	'title' => '_MA_WFC_XOOPSTAGS',
	'description' => '_MA_WFC_XOOPSTAGS_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '0'
	);

$modversion['config'][] = array( 'name' => 'copyrighttext',
	'title' => '_MA_WFC_COPYRIGHT',
	'description' => '_MA_WFC_COPYRIGHT_DSC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'Copyright © %s %s'
	);

$modversion['config'][] = array( 'name' => 'allow_pnlinks',
	'title' => '_MA_WFC_PNKINKS',
	'description' => '_MA_WFC_PNKINKS_DSC',
	'formtype' => 'yesno',
	'valuetype' => 'int',
	'default' => '0'
	);

?>