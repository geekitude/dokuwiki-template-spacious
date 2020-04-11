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

$meta['layout']             = array('multichoice','_choices' => array('boxed','full-width')); /* boxed or not page layout */
$meta['dark']               = array('onoff'); /* dark color scheme or not */
$meta['bodyBg']             = array('multichoice','_choices' => array('pattern','color')); /* fill site background with pattern or color */
$meta['topbar']             = array('multicheckbox','_choices' => array('date','newsticker','socialnetworks'));
$meta['datelocale']         = array('string');
$meta['longdatestring']     = array('string');
$meta['shortdatestring']    = array('string');
$meta['newsTicker']         = array('multicheckbox', '_choices' => array('skip_deleted','skip_minors','skip_subspaces','pages','media')); /* 'other' field should contain a single integer, the number of last changes to show */
$meta['sidebarPos']         = array('multichoice','_choices' => array('left','right')); /* left or right sidebar */
$meta['branding']           = array('multichoice','_choices' => array('logo_text','logo','text'));
$meta['stickies']           = array('multicheckbox','_choices' => array('pageheader','sidebar','docinfo'));
$meta['bannerfile']         = array('string');
$meta['widebannerfile']     = array('string');
$meta['nslogofile']         = array('string');
$meta['sidecardfile']       = array('string');
$meta['sidecardstyle']      = array('multichoice', '_choices' => array('mediacenter','medialeft','mediaright','stretch')); /* sidecard styling class */
$meta['headertoolsIcons']   = array('onoff'); /* enable or not site and user tools SVG icons */
$meta['pageheaderTitle']    = array('onoff'); /* enable or not page header's page title */
$meta['breadcrumbsStyle']   = array('multichoice', '_choices' => array('classic','pills'));
$meta['breadcrumbsGlyphs']  = array('onoff'); /* add glyphs to breadcrumbs to distinguish home, user public page, user home private ns, translated pages (note there will allways be a glyph for home in hierarchical trace) */
$meta['truncatebc']         = array('onoff'); /* truncate bradcrumbs links or not (see __breadcrumb_maxwidth__ in 'style.ini' file) */
$meta['siblings']           = array('numeric','_pattern' => '/^\d+$/'); /* add a breadcrumbs-like list of other pages in same namespace (number maxed by this value) */
$meta['contools']           = array('multicheckbox', '_choices' => array('parent','sidetoggle','playground','nsindex','savesettings','syntax'));
$meta['avatars']            = array('string');
$meta['links']              = array('string');
$meta['licenseVisual']      = array('multichoice','_choices' => array('button','badge','none')); /* visual representation of wiki license */
$meta['qrcodes']            = array('multicheckbox', '_choices' => array('editor_mailto','locked_mailto','license_link','onlineversion_link')); /* mailto QRCodes will show up in docInfo while license and obline version ones only show up when page is printed*/
$meta['neutralize']         = array('multicheckbox', '_choices' => array('topbar','pageheader','sidebar','toc','docinfo','footersocket')); /* use 'style.ini' "neu" colors */
$meta['extractible']        = array('multicheckbox', '_choices' => array('sidebar','toc')); /* extract sidebar or toc if there's enough room */
$meta['animate']            = array('numeric','_pattern' => '/^[0-9]\d*$/');
$meta['printhrefs']         = array('onoff'); /* print href attribute after links or not */
