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
defined( 'XOOPS_ROOT_PATH' ) or die( 'You do not have permission to access this file!' );

/**
 * Menu Language defines
 */
define( '_MA_WFC_ADMINMENU_INDEX', 'Index Page' );
define( '_MA_WFC_ADMINMENU_REFER', 'Refer Page' );
define( '_MA_WFC_ADMINMENU_REFERS', 'Refers Page' );
define( '_MA_WFC_ADMINMENU_LINK', 'Link Page' );
define( '_MA_WFC_ADMINMENU_CONTUS', 'Contant Page' );
define( '_MA_WFC_ADMINMENU_PERMS', 'Permissions' );
define( '_MA_WFC_ADMINMENU_UPLOAD', 'Upload' );
define( '_MA_WFC_ADMINMENU_IMPORT', 'Import' );
/**
 */
define( '_MA_WFC_MAINAREA', 'Page Management' );
define( '_MA_WFC_MAINAREA_DSC', 'Manage all your pages from this area. Perform actions such as, edit, delete or duplicate your pages.' );
define( '_MA_WFC_MAINAREA_EDIT_DSC', 'Page Edit: You can create or edit a page from this area. Once you have edited or modified your page, please click submit button to save all changes made.' );
define( '_MA_WFC_REFERAREA', 'Refer Management' );
define( '_MA_WFC_REFERAREA_DSC', 'Manage all your Refer page from this area.' );
define( '_MA_WFC_REFERSAREA', 'Refers Management' );
define( '_MA_WFC_REFERSAREA_DSC', 'Manage all refers made from your website. Select a date via the calender to view all refers for that date or leave blank to view all.' );
define( '_MA_WFC_LINKAREA', 'Link Management' );
define( '_MA_WFC_LINKAREA_DSC', 'Manage all your Link to us page from this area.' );
define( '_MA_WFC_PERMISSIONAREA', 'Permission Management' );
define( '_MA_WFC_UPLOADAREA', 'Upload Management' );
define( '_MA_WFC_UPLOADAREA_DSC', 'Use this area to upload images, files or anything you wish to display.' );
define( '_MA_WFC_IMPORT', 'Import Management' );
define( '_MA_WFC_IMPORT_DSC', 'Import html files on mass with various cleaning techniques.' );
/**
 * WF-Channel Page index defines
 */
define( '_MA_WFC_COPYSTANDALONE', 'Copy and paste this link if you intent to use this page as a stand alone page:' );
define( '_MA_WFC_NODEFAULTPAGESET', 'WARNING: No Default page set, please select one' );
define( '_MA_WFC_DEFAULTPAGESET', 'Default Page is Titled' );
define( '_MA_WFC_TOTALNUMCHANL', 'Total Number of Pages' );
define( '_MA_WFC_TOTALEMAILSSENT', 'Total Refer Emails Sent' );

/**
 * WF-Channel Main index Page Listing
 */
define( '_MA_WFC_CID', '#' );
define( '_MA_WFC_TITLE', 'Page Title' );
define( '_MA_WFC_HEADLINE', 'Page Headline' );
define( '_MA_WFC_COUNTER', 'Read' );
define( '_MA_WFC_MAINMENU', 'Menu Item' );
define( '_MA_WFC_PUBLISH', 'Published' );
define( '_MA_WFC_EXPIRED', 'Expires' );
define( '_MA_WFC_WEIGHT', 'Weight' );

/**
 * WF-Channel Page Edit Form
 */
define( '_MA_EWFC_MENU_TITLE', 'Menu Title:' );
define( '_MA_EWFC_MENU_TITLE_DSC', 'Enter a Menu title for this item.' );
define( '_MA_EWFC_IMENU_TITLE_DSC', 'Enter a Menu title for this item or leave blank for the importer to generate one' );
define( '_MA_EWFC_PAGE_TITLE', 'Page Title: ' );
define( '_MA_EWFC_PAGE_TITLE_DSC', 'Enter a Title to display as the header of your page. This item is not required and can be left blank.' );
define( '_MA_EWFC_IPAGE_TITLE_DSC', 'Enter a Title to display as the header of your page or leave blank for the importer to generate one.' );

define( '_MA_EWFC_PAGE_LOGO', 'Page Image: ' );
define( '_MA_EWFC_PAGE_LOGO_DSC', 'Select an Image you wish to use as this page logo.' );
define( '_MA_EWFC_MENU_CAPTION', 'Image Caption:' );
define( '_MA_EWFC_MENU_CAPTION_DSC', 'Enter a caption to be displayed underneath the Page Image. This option can be left blank.' );
define( '_MA_EWFC_PAGE_CONTENT', 'Page Content: ' );
define( '_MA_EWFC_PAGE_CONTENT_DSC', '' );
define( '_MA_EWFC_PAGE_WRAP', 'Page Wrap: ' );
define( '_MA_EWFC_PAGE_WRAP_DSC', 'Enter the URL of the html file you would like to wrap into your page. If the html file has been uploaded to the html upload dir, just enter the html filename without the full path.' );
define( '_MA_EWFC_USEFTITLE', 'Use Html Title:' );
define( '_MA_EWFC_DOIMPORT', 'Import File:' );

define( '_MA_EWFC_CLEANINGOPTIONS', 'Page Cleaning Options:' );
define( '_MA_EWFC_CLEANINGOPTIONS_DSC', 'The options will perform certain text cleaning.
 <br /><br />
 <b>Helpful Hints</b><br />
 Raw Formatting: Leave all formatting untouched and no html cleansing.<br />
 Html Cleansing: Clean and Filter Html input.
 MS Word Cleansing: Removes undesired MS word tags from content and leave all other html tags intact.<br />
 Remove All Formatting: Removes all html tags from content and converts content to plain text.<br />'
	);
define( '_MA_EWFC_CLEANRAW', 'Raw Formatting' );
define( '_MA_EWFC_CLEANHTML', 'Html Cleansing' );
define( '_MA_EWFC_CLEANMSWORD', 'MS Word Cleansing' );
define( '_MA_EWFC_CLEANALL', 'Remove All Formatting' );

define( '_MA_EWFC_WEIGHT', 'Page Weight: ' );
define( '_MA_EWFC_WEIGHT_DSC', 'Determines which order the page will be displayed in the menu.' );
define( '_MA_EWFC_PUBLISH', 'Page Publish Date: ' );
define( '_MA_EWFC_PUBLISH_DSC', 'Select/Enter the page Publish date.' );
define( '_MA_EWFC_EXPIRE', 'Page Expire Date: ' );
define( '_MA_EWFC_EXPIRE_DSC', 'Select/Enter the page Expire date. If left blank, the page will never expire.' );
define( '_MA_EWFC_DEFAULT', 'Default Page:' );
define( '_MA_EWFC_DEFAULT_DSC', 'If selected, this page will be the default and used as the main page for this module.' );
define( '_MA_EWFC_MAINMENU', 'Channel link:' );
define( '_MA_EWFC_MAINMENU_DSC', 'If selected this page will be displayed within the channel links menu.' );
define( '_MA_EWFC_SUBMENU', 'Channel Block Menu:' );
define( '_MA_EWFC_SUBMENU_DSC', 'If selected, this page will be displayed in the Module Menu Block' );
define( '_MA_EWFC_ALLOWCOMMENTS', 'Show Comments:' );
define( '_MA_EWFC_ALLOWCOMMENTS_DSC', 'Select to allow comments for this page. Gobal Comments can be enabled/disabled from the module preferences.' );
define( '_MA_EWFC_MENU_AUTHOR', 'Author Name:' );
define( '_MA_EWFC_MENU_AUTHOR_DSC', 'Select a Author name from the pulldown selection.' );
define( '_MA_EWFC_MENU_AUTHORALIAS', 'Enter Author Alias:' );
define( '_MA_EWFC_MENU_AUTHORALIAS_DSC', 'Enter an Alias Author name for this page.' );
define( '_MA_EWFC_METATITLE', 'Meta Keywords: ' );
define( '_MA_EWFC_METATITLE_DSC', 'In order to help Search Engines, you can customize the keywords you would like to use for this page.' );
define( '_MA_EWFC_MDESCRIPTION', 'Meta Description:' );
define( '_MA_EWFC_MDESCRIPTION_DSC', 'In order to help Search Engines, you can customize the meta description you would like to use for this page.' );
define( '_MA_EWFC_MENU_RELATED', 'Related Pages Tags: ' );
define( '_MA_EWFC_MENU_RELATED_DSC', 'To relate different pages, enter a tag \'word\' within each page you wish to relate to each other.' );

define( '_MA_EWFC_MENU_INFO', 'Display Page Info' );
define( '_MA_EWFC_MENU_INFO_DSC', '' );
/**
 * WF-Channel Refer index defines
 */
define( '_MA_WFC_CMODIFYREFER', '' );

/**
 * WF-Channel Refer Edit Form
 */
define( '_MA_EWFC_REFER_TITLE', 'Refer Page Title:' );
define( '_MA_EWFC_REFER_TITLE_DSC', 'Enter the text for the Refer Page title' );
define( '_MA_EWFC_REFER_LOGO', 'Refer Page Logo: ' );
define( '_MA_EWFC_REFER_LOGO_DSC', 'Select an Image you wish to use as the Refer page logo.' );
define( '_MA_EWFC_REFER_INTRO', 'Refer Page Intro: ' );
define( '_MA_EWFC_REFER_INTRO_DSC', '' );
define( '_MA_EWFC_REFER_MENU', 'Menu Item: ' );
define( '_MA_EWFC_REFER_MENU_DSC', 'Select to add the refer page to the channel menu.' );
define( '_MA_EWFC_REFER_EMAIL', 'Use Senders Stored Email address?' );
define( '_MA_EWFC_REFER_EMAIL_DSC', 'Use Senders Stored Email address?' );
define( '_MA_EWFC_REFER_DEFBLURB', 'Refer Message:' );
define( '_MA_EWFC_REFER_DEFBLURB_DSC', 'Enter a message that you wish to be used by refers. This will be used instead of a user entry.' );
define( '_MA_EWFC_REFER_USERBLURB', 'User Message:' );
define( '_MA_EWFC_REFER_USERBLURB_DSC', 'If yes is selected, users will be able to enter their own message.' );
define( '_MA_EWFC_REFER_PDISPLAY', 'Privacy statement:' );
define( '_MA_EWFC_REFER_PDISPLAY_DSC', 'Select yes to display a privacy statement on the refer page.' );
define( '_MA_EWFC_REFER_PSTATEMENT', 'Privacy Statement Text:' );
define( '_MA_EWFC_REFER_PSTATEMENT_DSC', 'Enter the text you wish to display for this privacy statement.' );

/**
 * WF-Channel Link index defines
 */
define( '_MA_WFC_CMODIFYLINK', '' );

/**
 * WF-Channel Link Edit Form
 */
define( '_MA_EWFC_LINK_TITLE', 'Link Page Title' );
define( '_MA_EWFC_LINK_TITLE_DSC', 'Enter the text for the Link Page title' );
define( '_MA_EWFC_LINK_LOGO', 'Refer Link Logo: ' );
define( '_MA_EWFC_LINK_LOGO_DSC', 'Select an Image you wish to use as the Link page logo.' );
define( '_MA_EWFC_LINK_INTRO', 'Link Page Intro: ' );
define( '_MA_EWFC_LINK_MENU', 'Menu Item: ' );
define( '_MA_EWFC_LINK_MENU_DSC', 'Select to add the refer page to the channel menu.' );
define( '_MA_EWFC_LINK_TEXTLINK', 'Text Link:' );
define( '_MA_EWFC_LINK_TEXTLINK_DSC', 'Enter the text to be used with this link.' );
define( '_MA_EWFC_LINK_BUTTONLINK', 'Button Link:' );
define( '_MA_EWFC_LINK_BUTTONLINK_DSC', 'Select an image to use as the Button Link.' );
define( '_MA_EWFC_LINK_LOGOLINK', 'Logo Link:' );
define( '_MA_EWFC_LINK_LOGOLINK_DSC', 'Select an image to use as the Logo Link.' );
define( '_MA_EWFC_LINK_BANNERLINK', 'Banner Link:' );
define( '_MA_EWFC_LINK_BANNERLINK_DSC', 'Select an image to use as the Banner Link.' );
define( '_MA_EWFC_LINK_MICROLINK', 'Micro Link:' );
define( '_MA_EWFC_LINK_MICROLINK_DSC', 'Select an image to use as the Micro Link.' );
// define( '_MA_EWFC_LINK_NEWSFTITLE', 'Newsfeed Title: ' );
// define( '_MA_EWFC_LINK_NEWSFTITLE_DSC', 'Enter the text you wish to use for the newsfeed title.' );
define( '_MA_EWFC_LINK_NEWSFEED', 'Newsfeeds Link: ' );
define( '_MA_EWFC_LINK_NEWSFEED_DSC', 'Select yes to display a link to backend.php RSS.' );
define( '_MA_EWFC_LINK_NEWSFEEDJS', 'Javascript Newsfeeds Link: ' );
define( '_MA_EWFC_LINK_NEWSFEEDJS_DSC', 'Select yes to display a link to javascript backend.php RSS alternative.' );
/**
 * refers Page
 */
define( '_MA_WFCR_ADMINREFERS', 'Refers Page' );
define( '_MA_WFCR_ID', '#' );
define( '_MA_WFCR_UID', 'Sent By' );
define( '_MA_WFCR_DATE', 'Date Sent' );
define( '_MA_WFCR_IP', 'IP Address' );
define( '_MA_WFCR_REFERURL', 'Refer Url' );

define( '_MA_WFC_TOTALCOMENTS', 'Total Comments: ' );
define( '_MA_WFC_TOTALPAGEREADS', 'Total Page Reads: ' );
define( '_MA_WFC_PAGECREATED', 'Page Created: ' );
define( '_MA_WFC_LASUPDATED', 'Last Updated: ' );
define( '_MA_WFC_VIEWCOMMENTS', 'View Comments' );
define( '_MA_WFC_QUICKLINK', 'Quick Link: ' );
define( '_MA_WFC_QUICKVIEW', 'View Page' );
/**
 * Import
 */
define( '_MA_WFC_IMPORTHTML', 'Mass Import HTML' );
define( '_MA_EWFC_PAGE_UPLOADDIR', 'Enter Upload Directory' );
define( '_MA_EWFC_PAGE_UPLOADDIR_DSC', 'Please enter the path of the import folder. This folder must be within the XOOPS document root<br /><br />Example: uploads/import' );
define( '_MA_EWFC_FOLDERDOESNOTEXIST', '<strong>ERROR:</strong> The import folder either does not exist or is not readable.' );
define( '_MA_WFC_CHANIMAGEEXIST', 'File %s already exisits on the server, please try uploading another file.' );

define( '_MA_WFC_SELSTATUS', 'Set Page Status:' );
define( '_MA_WFC_SELSTATUS_DSC', 'Set the status of a page to one of the following:
<br /><b>Published:</b> Open to all viewers with permissions
<br /><b>Unpublished:</b> Sets Page to a submitted stage
<br /><b>Expired:</b> Sets Page as Archive/Expired
<br /><b>Inactive:</b> Sets the page as inactive keeps its orginal state
' );

define( '_MA_WFC_SELALL', 'All Pages' );
define( '_MA_WFC_SELPUBLIHSED', 'Published' );
define( '_MA_WFC_SELUNPUBLISHED', 'Unpublished' );
define( '_MA_WFC_SELEXPIRED', 'Expired' );
define( '_MA_WFC_SELOFFLINE', 'Inactive' );

/**
 * Tabs for Forms
 */
define( '_MA_WFC_TABMAIN', 'Main' );
define( '_MA_WFC_TABPUBLISH', 'Publish' );
define( '_MA_WFC_TABIMAGE', 'Image' );
define( '_MA_WFC_TABMETA', 'Meta' );
define( '_MA_WFC_TABPERMISSIONS', 'Permissions' );
define( '_MA_WFC_INFO', 'Info' );

define( '_MA_EWFC_MENU_IMGWIDTH', 'Image Width: ' );
define( '_MA_EWFC_MENU_IMGWIDTH_DSC', 'Enter the width you would like the image to be.' );
define( '_MA_EWFC_MENU_IMGHEIGHT', 'Image Height: ' );
define( '_MA_EWFC_MENU_IMGHEIGHT_DSC', 'Enter the height you would like the image to be.' );
?>