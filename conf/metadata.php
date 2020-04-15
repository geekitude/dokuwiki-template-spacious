<?php
/**
 * DokuWiki Spacious Template
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 3 (https://www.gnu.org/licenses/gpl-3.0.html)
 * 
 * Configuration metadata
 */

$meta['layout']             = array('multichoice','_choices' => array('boxed','mix','full-width','box2full'));
$meta['bodyBg']             = array('multichoice','_choices' => array('pattern','color'));
$meta['topbar']             = array('multicheckbox','_choices' => array('date','newsticker','socialnetworks'));
$meta['datelocale']         = array('string');
$meta['longdatestring']     = array('string');
$meta['shortdatestring']    = array('string');
$meta['newsTicker']         = array('multicheckbox', '_choices' => array('skip_deleted','skip_minors','skip_subspaces','pages','media'));
$meta['sidebarPos']         = array('multichoice','_choices' => array('left','right'));
$meta['flipTools']          = array('onoff');
$meta['headerLogo']         = array('onoff');
$meta['stickies']           = array('multicheckbox','_choices' => array('pageheader','sidebar','docinfo'));
$meta['bannerfile']         = array('string');
$meta['widebannerfile']     = array('string');
$meta['nslogofile']         = array('string');
$meta['sidecardfile']       = array('string');
$meta['sidecardstyle']      = array('multichoice', '_choices' => array('mediacenter','medialeft','mediaright','mediastretch'));
$meta['headertoolsIcons']   = array('onoff');
$meta['pageheaderTitle']    = array('onoff'); /* enable or not page header's page title */
$meta['breadcrumbsStyle']   = array('multichoice', '_choices' => array('classic','pills'));
$meta['breadcrumbsGlyphs']  = array('onoff'); /* add glyphs to breadcrumbs to distinguish home, user public page, user home private ns, translated pages (note there will allways be a glyph for home in hierarchical trace) */
$meta['truncatebc']         = array('onoff'); /* truncate bradcrumbs links or not (see __breadcrumb_maxwidth__ in 'style.ini' file) */
$meta['siblings']           = array('numeric','_pattern' => '/^\d+$/');
$meta['contools']           = array('multicheckbox', '_choices' => array('parent','sidetoggle','playground','nsindex','savesettings','syntax'));
$meta['avatars']            = array('string');
$meta['links']              = array('string');
$meta['licenseVisual']      = array('multichoice','_choices' => array('badge','button','none'));
$meta['qrcodes']            = array('multicheckbox', '_choices' => array('editor_mailto','locked_mailto','license_link','onlineversion_link'));
$meta['neutralize']         = array('multicheckbox', '_choices' => array('topbar','pageheader','sidebar','toc','docinfo','footersocket'));
$meta['extractible']        = array('multicheckbox', '_choices' => array('sidebar','toc'));
$meta['scrollspyToC']       = array('onoff');
$meta['animate']            = array('numeric','_pattern' => '/^[0-9]\d*$/');
$meta['print']              = array('multicheckbox', '_choices' => array('siteheader','docinfo','sitefooter','hrefs'));
