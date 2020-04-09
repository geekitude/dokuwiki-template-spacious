<?php
/**
 * DokuWiki Spacious Template PHP Functions
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 2 (https://www.gnu.org/licenses/gpl-3.0.html)
 * 
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * INITALIZE
 * 
 * Load usefull informations and plugins' helpers.
 */
function spacious_init() {
//    global $ID, $conf, $ACT, $auth, $INFO, $license, $JSINFO;
    global $spacious;
}/* /spacious_init */

/**
 * Returns body classes according to settings
 */
function spacious_bodyclasses() {
    global $spacious;

    $classes = array();

    if ($_GET['debug'] == 1) {
        $bgClass = "tpl-debug-bg";
    //} elseif ((tpl_getConf('bodyBg') == "pattern") and ($_GET['debug'] != 1)) {
    } elseif (tpl_getConf('bodyBg') == "pattern") {
        $pattern = tpl_getMediaFile(array(':'.getNS($ID).':pattern.png', ':wiki:pattern.png', 'images/pattern.png'), false, $patternSize);
        if ($pattern == "/lib/tpl/spacious/images/pattern.png") {
            $bgClass = "tpl-pattern-bg";
        } elseif (strpos($pattern, getNS($ID)) !== false) {
            $bgClass = "ns-pattern-bg";
        } else {
            $bgClass = "wiki-pattern-bg";
        }
    } else {
        $bgClass = "color-bg";
    }

    $sidebar = "no-sidebar";
    if ($spacious['showSidebar'] == 1) {
        if (tpl_getConf('sidebarPos') == "left") {
            $sidebar = "left-sidebar";
        } else {
            $sidebar = "right-sidebar";
        }
        if (strpos(tpl_getConf('stickies'), 'sidebar') !== false) {
            $sidebar .= " sticky-sidebar";
        }
        if ((strpos(tpl_getConf('extractible'), 'sidebar') !== false) and (tpl_getConf('layout') == "boxed")) {
            $sidebar .= " extractible-sidebar";
        }
    }

    array_push($classes, tpl_getConf('layout').'-layout', $bgClass, (tpl_getConf('dark')) ? 'dark' : '', $sidebar, (tpl_getConf('truncatebc')) ? 'truncatebc' : '', (strpos(tpl_getConf('stickies'), 'pageheader') !== false) ? 'sticky-pageheader' : '', (strpos(tpl_getConf('stickies'), 'docinfo') !== false) ? 'sticky-docinfo' : '', ((strpos(tpl_getConf('extractible'), 'toc') !== false) and (tpl_getConf('layout') == "boxed")) ? 'extractible-toc' : '', ($_GET['debug']==1) ? 'debug' : '', (tpl_getConf('printhrefs')) ? 'printhrefs' : '');
    /* TODO: better home detection than core */
    return rtrim(join(' ', $classes));
}/* /spacious_bodyclasses */
