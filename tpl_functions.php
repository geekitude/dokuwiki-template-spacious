<?php
/**
 * DokuWiki Spacious Template PHP Functions
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 3 (https://www.gnu.org/licenses/gpl-3.0.html)
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
    global $ID, $conf, $ACT, $auth, $INFO, $license, $JSINFO;
    global $spacious, $translationHelper, $qrcode2Helper;

//dbg($license[$conf['license']]['url']);
    //session_start();

    // PREPARING USER EXTRA INFO
    $spacious['user'] = array();
    $spacious['user']['private'] = null;
    $spacious['user']['public'] = array();
//dbg($spacious['user']);

    // SOCIAL LINKS
    $spacious['social'] = array();
    // Load "social" links from DOKU_CONF/social.conf (or tpl/spacious/debug/social.conf) to global conf
    if ($_GET['debug'] == 1) {
        $socialFile = tpl_incdir().'debug/social.local.conf';
    } else {
        $socialFile = DOKU_CONF.'social.local.conf';
    }
    // If file exists...
    if ((@file_exists($socialFile)) and ((strpos(tpl_getConf('topbar'), 'socialnetworks') !== false) or ($_GET['debug'] == 1))) {
//dbg($socialFile);
        // ... read it's content
        $socialFile = confToHash($socialFile);
        // Sorting array in reverse alphabetical order on keys because they will float to the right (now done by default)
        // krsort($socialFile);
        // Get actual links from file content
//dbg($socialFile);
        foreach ($socialFile as $key => $value) {
//dbg($key." => ".$value);
            if (filter_var($value, FILTER_VALIDATE_URL)) { 
                $spacious['social'][$key] = $value;
            }
        }
//dbg($spacious['social']);
    }

    // GLYPHS
    // Search for default or custum default SVG glyphs
//    $spacious['glyphs']['about'] = 'help';
    $spacious['glyphs']['acl'] = 'key-variant';
//    $spacious['glyphs']['admin'] = 'settings';
    $spacious['glyphs']['config'] = 'tune';
//    $spacious['glyphs']['discussion'] = 'comment-text-multiple';
    $spacious['glyphs']['date'] = 'calendar-month';
    $spacious['glyphs']['editor'] = 'fountain-pen-tip';
    $spacious['glyphs']['ellipsis'] = 'ellipsis';
    $spacious['glyphs']['extension'] = 'puzzle';
    $spacious['glyphs']['extedit'] = 'desktop-classic';
    $spacious['glyphs']['from-playground'] = 'shovel-off';
    $spacious['glyphs']['help'] = 'lifebuoy';
    $spacious['glyphs']['hide'] = 'eye-off';
    $spacious['glyphs']['home'] = 'home';
    $spacious['glyphs']['locked'] = 'lock';
//    $spacious['glyphs']['login'] = 'login';
//    $spacious['glyphs']['logout'] = 'logout';
    $spacious['glyphs']['lastmod'] = 'calendar-clock';
    $spacious['glyphs']['link'] = 'web';
    $spacious['glyphs']['locked'] = 'lock';
    $spacious['glyphs']['map'] = 'sitemap';
//    $spacious['glyphs']['map-hover'] = 'map-search-outline';
//    $spacious['glyphs']['map-active'] = 'map-search';
//    $spacious['glyphs']['menu'] = 'menu';
    $spacious['glyphs']['namespace-start'] = 'folder-home';
    $spacious['glyphs']['news'] = 'alert-decagram';
    $spacious['glyphs']['pagepath'] = 'folder-open';
    $spacious['glyphs']['parent-namespace'] = 'reply-all';
    $spacious['glyphs']['playground'] = 'shovel';
    $spacious['glyphs']['popularity'] = 'star-half';
    $spacious['glyphs']['previous'] = 'skip-previous';
    $spacious['glyphs']['private-ns'] = 'folder-key';
    $spacious['glyphs']['profile'] = 'account-edit';
    $spacious['glyphs']['public-page'] = 'comment-account';
    $spacious['glyphs']['recycle'] = 'recycle';
    $spacious['glyphs']['refresh'] = 'autorenew';
    $spacious['glyphs']['revert'] = 'step-backward';
    $spacious['glyphs']['save'] = 'floppy';
    $spacious['glyphs']['search'] = 'magnify';
    $spacious['glyphs']['separator'] = 'cards-diamond';
    $spacious['glyphs']['show'] = 'eye';
    $spacious['glyphs']['social'] = 'account-network';
    $spacious['glyphs']['styling'] = 'palette';
    $spacious['glyphs']['translated'] = 'flag';
    $spacious['glyphs']['translation'] = 'translate';
    $spacious['glyphs']['upgrade'] = 'cloud-download';
//    $spacious['glyphs']['user'] = 'account';
//    $spacious['glyphs']['unknown-user'] = 'account-alert';
    $spacious['glyphs']['usermanager'] = 'account-group';
    foreach ($spacious['social'] as $key => $value) {
        $spacious['glyphs'][$key] = $key;
    }
    foreach ($spacious['glyphs'] as $key => $value) {
        /*if (is_file(DOKU_CONF."svg/".$key.".svg")) {*/
        /*if (is_file(tpl_incdir().'images/svg/custom/'.$key.'.svg')) {*/
        if (($key != "ellipsis") && (is_file(DOKU_CONF.'svg/'.$key.'.svg'))) {
            //$spacious['glyphs'][$key] = inlineSVG(DOKU_CONF.'svg/'.$key.'.svg', 2048);
            $spacious['glyphs'][$key] = DOKU_CONF.'svg/'.$key.'.svg';
        //} elseif (is_file('.'.tpl_basedir().'images/svg/'.$value.'.svg')) {
        } else {
            //$spacious['glyphs'][$key] = inlineSVG('.'.tpl_basedir().'images/svg/'.$value.'.svg', 2048);
            $spacious['glyphs'][$key] = DOKU_INC.tpl_basedir().'images/svg/'.$value.'.svg';
        //} else {
        //    $spacious['glyphs'][$key] = inlineSVG(DOKU_INC.'lib/images/menu/00-default_checkbox-blank-circle-outline.svg', 2048);
        }
    }

    // HELPER PLUGINS
    // Preparing usefull plugins' helpers
    // QRCode2
    $spacious['qrcode'] = array();
    if ((!plugin_isdisabled('qrcode2')) and (tpl_getConf('qrcodes') != null)) {
        $qrcode2Helper = plugin_load('helper','qrcode2');
//dbg($qrcode2Helper->get_img("http://example.com", true));
//$src = $qrcode2Helper->get_img("mailto:johndoe@example.com?subject=promotion", true);
//print "<img class='qrcode' src='".$src."' alt='*johndoe*' />";
//$qrcode2Helper->get_img("http://example.com", false);
        if (($INFO['editor']) and (strpos(tpl_getConf('qrcodes'), 'editor_mailto') !== false)) {
            $editor = $auth->getUserData($INFO['editor']);
//dbg($editor);
            if (isset($editor['mail'])) {
                $spacious['qrcode']['editor'] = $qrcode2Helper->get_img("mailto:".$editor['mail']."?subject=".$conf['title']." - ".$ID, true);
            } else {
                $spacious['qrcode']['editor'] = null;
            }
//print "<img class='qrcode' src='".$spacious['qrcode']['editor']."' alt='*last editor*' title='Contact last editor' />";
        }
        if (($INFO['locked']) and (strpos(tpl_getConf('qrcodes'), 'locked_mailto') !== false)) {
            $locked = $auth->getUserData($INFO['locked']);
            if (isset($locked['mail'])) {
                $spacious['qrcode']['locked'] = $qrcode2Helper->get_img("mailto:".$locked['mail']."?subject=".$conf['title']." - ".$ID, true);
            } else {
                $spacious['qrcode']['locked'] = null;
            }
        }
        if (strpos(tpl_getConf('qrcodes'), 'license_link') !== false) {
            $spacious['qrcode']['license'] = $qrcode2Helper->get_img($license[$conf['license']]['url'], true);
        }
//dbg(wl($ID,'', true));
        if (strpos(tpl_getConf('qrcodes'), 'onlineversion_link') !== false) {
            $spacious['qrcode']['id'] = $qrcode2Helper->get_img(wl($ID,'', true), true);
        }
//print "<img class='qrcode' src='".$spacious['qrcode']['id']."' alt='*this page*' />";
    }
    // Translation
    if (!plugin_isdisabled('translation')) {
        $spacious['trans']['defaultlang'] = $conf['lang'];
        if (isset($conf['lang_before_translation'])) {
            $spacious['trans']['defaultlang'] = $conf['lang_before_translation'];
        }
        $translationHelper = plugin_load('helper','translation');
        if ($conf['plugin']['translation']['dropdown']) {
            $spacious['trans']['dropdown'] = $translationHelper->showTranslations();
//dbg($spacious['trans']['dropdown']);
        }
        $spacious['trans']['parts'] = $translationHelper->getTransParts($ID);
        if (isset($conf['plugin']['translation']['translations'])) {
            $languages = explode(" ", $conf['plugin']['translation']['translations']);
            sort($languages);
        } else {
            $languages = array();
        }
        //if (($spacious['trans']['parts'][1] == $conf['start']) and (strpos($conf['plugin']['translation']['translations'], $spacious['trans']['parts'][0]) !== false)) {
        if (($spacious['trans']['parts'][1] == $conf['start']) and (($spacious['trans']['parts'][0] == null) or ($spacious['trans']['parts'][0] != $spacious['trans']['defaultlang']))) {
            $spacious['trans']['istranslatedhome'] = 1;
        } else {
            $spacious['trans']['istranslatedhome'] = 0;
        }
        if (!in_array($spacious['trans']['defaultlang'], $languages)) {
            array_push($languages, $spacious['trans']['defaultlang']);
            // building 'untranslatedhome' is pointless, use $spacious['trans']['translations'][$spacious['trans']['defaultlang']] instead
            //$spacious['trans']['untranslatedhome'] = $conf['start'];
        //} else {
            // building 'untranslatedhome' is pointless, use $spacious['trans']['translations'][$spacious['trans']['defaultlang']] instead
            //$spacious['trans']['untranslatedhome'] = $spacious['trans']['defaultlang'].':'.$conf['start'];
        }
        sort($languages);
        $spacious['trans']['translations'] = array();
        foreach ($languages as $lc) {
            $translation = $translationHelper->buildTransID($lc, $spacious['trans']['parts'][1]);
            $spacious['trans']['translations'][$lc] = ltrim($translation[0], ":");
            if (page_exists($translation[0])) {
                $classes = "wikilink1";
            } else {
                $classes = "wikilink2";
            }
            if ($spacious['trans']['translations'][$lc] != $ID) {
                $spacious['trans']['links'][$lc] = $translationHelper->getTransItem($lc, $spacious['trans']['parts'][1]);
            }
        }
//dbg($spacious['trans']['links']);
        if (($spacious['trans']['links'] != null) and (count($spacious['trans']['links']) > 0)) {
            // fix original links' syntax
            foreach ($spacious['trans']['links'] as $lc => $link) {
                $spacious['trans']['links'][$lc] = str_replace("<li><div class='li'>", "", $spacious['trans']['links'][$lc]);
                $spacious['trans']['links'][$lc] = str_replace("<li><div class='li cur'>", "", $spacious['trans']['links'][$lc]);
                $spacious['trans']['links'][$lc] = str_replace("</div></li>", "", $spacious['trans']['links'][$lc]);
                $spacious['trans']['links'][$lc] = str_replace("  ", " ", $spacious['trans']['links'][$lc]);
            }
        }
    }
//dbg($spacious['trans']['translations'][$spacious['trans']['defaultlang']]);
//dbg($spacious['trans']);
//if (isset($translationHelper)) { dbg($translationHelper->getLang('translations')); }
    // Twistienav
    $spacious['nsindex'] = array();
    if ((strpos(tpl_getConf('contools'), 'nsindex') !== false) && (!plugin_isdisabled('twistienav'))) {
        $tnHelper = plugin_load('helper','twistienav');
        $spacious['nsindex'] = $tnHelper->get_idx_data(cleanID(getNS($ID)), false, true);
        //commented lines only needed if result wasn't split
        //if (isset($spacious['nsindex']['namespaces'])) {
            $spacious['nsindex']['n'] = count($spacious['nsindex']['namespaces']) + count($spacious['nsindex']['pages']);
        //} else {
        //    $spacious['nsindex']['n'] = count($spacious['nsindex']);
        //}
    } else {
        $spacious['nsindex']['n'] = 0;
    }
//dbg($spacious['nsindex']['pages']);
    // Userhomepage
    if (!empty($_SERVER['REMOTE_USER'])) {
//dbg($spacious['user']['public']);
        // Build user's private and public pages IDs with UserHomePage plugin
        if (!plugin_isdisabled('userhomepage')) {
            $uhpHelper = plugin_load('helper','userhomepage');
            $spacious['user'] = $uhpHelper->getElements(false);
//dbg($spacious['user']);
        } else {
            // Without Userhomepage plugin, Public Page namespace is set by 'user' value in 'conf/interwiki.conf' and Private page is unknown
            $spacious['user']['public']['id'] = ltrim(str_replace('{NAME}', $_SERVER['REMOTE_USER'], getInterwiki()['user']),':');
            $spacious['user']['public']['title'] = tpl_getLang('public_page');
            $spacious['user']['public']['string'] = userlink();
            //if (page_exists($spacious['user']['public']['id'])) {
            //    $spacious['user']['public']['classes'] = 'wikilink1';
            //} else {
            //    $spacious['user']['public']['classes'] = 'wikilink2';
            //}
            ////$spacious['user']['public']['link'] = tpl_link(wl($spacious['user']['public']['id']), userlink()." ".spacious_glyph('public-page', true), $class.' rel="nofollow" title="'.$spacious['user']['public']['string'].'"', true);
        }
    }
//dbg($spacious['user']);
//$spacious['user']['public']['link'] = $uhpHelper->getAnyPublicLink("titi");

    // PAGE TITLE
    $spacious['pagetitle'] = tpl_pagetitle($ID, true);

    // TO SIDEBAR OR NOT
    //$hasSidebar = page_findnearest($conf['sidebar']);
    $spacious['sidebar'] = spacious_findnearest($conf['sidebar']);
//dbg($spacious['sidebar']);
    //$hasSidebar = DOKU_TPL.'debug/sidebar.html';
    /*$showSidebar = $hasSidebar && ($ACT=='show');*/
    $spacious['showSidebar'] = $spacious['sidebar'] && (tpl_getConf('sidebarPos') != 'none') && ($ACT=='show');
    // DokuWiki core public page (depends on 'user' value in 'conf/interwiki.conf')
//dbg($spacious['showSidebar']);

    // PATHS
//dbg('DOKU_CONF: '.realpath(DOKU_CONF).' - savedir: '.realpath($conf['savedir']));
    // DOKU_CONF and $conf['savedir'] give different results in classic and farm environments :
    // classic example : DOKU_CONF -> /var/www/dokuwiki/conf/ - savedir -> ./data
    // farm example (based on https://www.dokuwiki.org/farms) : DOKU_CONF -> /var/www/dokufarm/animal/conf/ - savedir: /var/www/dokufarm/animal/conf/../data
    // DOKU_CONF is always a reliable absolute path, $conf['savedir'] is not, but realpath($conf['savedir']) is always a reliable absolute path
    $spacious['paths']['conf'] = realpath(DOKU_CONF);
    $spacious['paths']['savedir'] = realpath($conf['savedir']);

    // CURRENT NS AND PATH
    // Get current namespace and corresponding path (resulting path will correspond to namespace's pages, media or conf files)
//    //$spacious['currentNs'] = getNS(cleanID($id));
    $spacious['ns']['current'] = $INFO['namespace'];
////dbg($spacious['currentNs']);
////    if ((isset($spacious['trans']['parts'][1])) and ($spacious['trans']['parts'][1] != null)) {
//////dbg($spacious['trans']['parts']);
////        if (strpos($conf['plugin']['translation']['translations'], $conf['lang']) !== false) {
//////dbg("ici? ".$conf['lang']);
////            $spacious['untranslatedNs'] = $conf['lang'].":".getNS(cleanID($spacious['trans']['parts'][1]));
////        } else {
//////dbg("là?");
////            $spacious['untranslatedNs'] = getNS(cleanID($spacious['trans']['parts'][1]));
////        }
////    } else {
////        $spacious['untranslatedNs'] = $spacious['currentNs'];
////    }
//////dbg($spacious['baseNs']);
////    if ($spacious['currentNs'] != null) {
////        $spacious['currentPath'] = "/".str_replace(":", "/", $spacious['currentNs']);
////    } else {
////        $spacious['currentPath'] = "/";
////    }
//dbg($spacious['ns']['current']);

    // CURRENT NS' PARENTS
    $spacious['parents'] = array();
    $parts = explode(":", $ID);
//dbg($parts);
    $tmp = null;
    if (count($parts) >= 1) {
//dbg($parts);
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $tmp .= ":".$parts[$i];
            if (ltrim($tmp.":".$conf['start'], ":") != $ID) {
                array_push($spacious['parents'], ltrim($tmp.":".$conf['start'], ":"));
            }
        }
    }
    // Add `start` at begining of $spacious['parents'] array if needed
    if ($spacious['parents'][0] != $conf['start']) {
        array_unshift($spacious['parents'], $conf['start']);
    }
//dbg($spacious['parents']);

    // IMAGES
    $spacious['images'] = array();
    $spacious['images']['logo']['size'] = array();
    if ((($_GET['debug'] == 1) or ($_GET['debug'] == "images") or ($_GET['debug'] == "logo")) and (file_exists(tpl_incdir('spacious')."images/spacious-logo.png"))) {
        $spacious['images']['logo']['target'] = tpl_getMediaFile(array("images/spacious-logo.png"), false, $spacious['images']['logo']['size']);
    } else {
        $spacious['images']['logo']['target'] = tpl_getMediaFile(array(':wiki:logo.png', ':wiki:logo.jpg', ':logo.png', ':logo.jpg', 'images/logo.png'), false, $spacious['images']['logo']['size']);
    }
    if ((tpl_getConf('bannerfile') != null) or ($_GET['debug'] == 1) or ($_GET['debug'] == "images") or ($_GET['debug'] == "banner")) {
        $spacious['images']['banner']['size'] = array();
        $spacious['images']['banner']['target'] = tpl_getMediaFile(array(':wiki:'.tpl_getConf('bannerfile').'.png', ':wiki:'.tpl_getConf('bannerfile').'.jpg', ':'.tpl_getConf('bannerfile').'.png', ':'.tpl_getConf('bannerfile').'.jpg', 'debug/banner.png'), false, $spacious['images']['banner']['size']);
        if ((strpos($spacious['images']['banner']['target'], "debug") !== false) and (($_GET['debug'] != 1) and ($_GET['debug'] != "images") and ($_GET['debug'] != "banner"))) {
            $spacious['images']['banner']['target'] = null;
        }
    }
    if ((tpl_getConf('widebannerfile') != null) or ($_GET['debug'] == 1) or ($_GET['debug'] == "images") or ($_GET['debug'] == "widebanner")) {
        $spacious['images']['widebanner']['size'] = array();
        $spacious['images']['widebanner']['target'] = tpl_getMediaFile(array(':wiki:'.tpl_getConf('widebannerfile').'.png', ':wiki:'.tpl_getConf('widebannerfile').'.jpg', ':'.tpl_getConf('widebannerfile').'.png', ':'.tpl_getConf('widebannerfile').'.jpg', 'debug/widebanner.png'), false, $spacious['images']['widebanner']['size']);
        if ((strpos($spacious['images']['widebanner']['target'], "debug") !== false) and (($_GET['debug'] != 1) and ($_GET['debug'] != "images") and ($_GET['debug'] != "widebanner"))) {
            $spacious['images']['widebanner']['target'] = null;
        }
    }
    if ((tpl_getConf('conlogofile') != null) or ($_GET['debug'] == 1) or ($_GET['debug'] == "images") or ($_GET['debug'] == "conlogo")) {
        $spacious['images']['conlogo']['size'] = array();
        $ns = cleanID(getNS($ID));
        $spacious['images']['conlogo']['target'] = tpl_getMediaFile(array(':'.$ID.'.png', ':'.$ID.'.jpg', ':'.$ns.':'.tpl_getConf('conlogofile').'.png', ':'.$ns.':'.tpl_getConf('conlogofile').'.jpg', 'debug/conlogo.png'), false, $spacious['images']['conlogo']['size']);
        $spacious['images']['conlogo']['thumbnail'] = tpl_getMediaFile(array(':'.$ID.'-thumbnail.png', ':'.$ID.'-thumbnail.jpg', ':'.$ns.':'.tpl_getConf('conlogofile').'-thumbnail.png', ':'.$ns.':'.tpl_getConf('conlogofile').'-thumbnail.jpg', 'debug/conlogo-thumbnail.png'), false);
        if ((strpos($spacious['images']['conlogo']['target'], "debug") !== false) and (($_GET['debug'] != 1) and ($_GET['debug'] != "images") and ($_GET['debug'] != "conlogo"))) {
            $spacious['images']['conlogo']['target'] = null;
            $spacious['images']['conlogo']['thumbnail'] = null;
        }
    }
    if ((tpl_getConf('sidecardfile') != null) or ($_GET['debug'] == 1) or ($_GET['debug'] == "images") or ($_GET['debug'] == "card")) {
        $spacious['images']['sidecard']['size'] = array();
        $spacious['images']['sidecard']['target'] = tpl_getMediaFile(array(':wiki:'.tpl_getConf('sidecardfile').'.png', ':wiki:'.tpl_getConf('sidecardfile').'.jpg', ':'.tpl_getConf('sidecardfile').'.png', ':'.tpl_getConf('sidecardfile').'.jpg', 'debug/sidecard.png'), false, $spacious['images']['sidecard']['size']);
        if ((strpos($spacious['images']['sidecard']['target'], "debug") !== false) and (($_GET['debug'] != 1) and ($_GET['debug'] != "images") and ($_GET['debug'] != "card"))) {
            $spacious['images']['sidecard']['target'] = null;
        }
    }
//dbg($spacious['images']);
//dbg($_SERVER['REMOTE_USER']);
//dbg(':user:'.$_SERVER['REMOTE_USER'].':'.tpl_getConf('avatar').'.png');
//dbg(':wiki:'.$_SERVER['REMOTE_USER'].'.png');
    //if ((isset($_SERVER['REMOTE_USER'])) and (tpl_getConf('avatar') != null)) {
    if (isset($_SERVER['REMOTE_USER'])) {
        //$spacious['images']['avatarsize'] = array();
        //$spacious['images']['avatar']['size'] = array();
        //$spacious['images']['avatar'] = tpl_getMediaFile(array(':wiki:'.tpl_getConf('avatar').'.png', ':'.tpl_getConf('avatar').'.png', 'debug/sidebar.png'), false, $spacious['images']['avatarsize']);
        //$spacious['images']['avatar'] = tpl_getMediaFile(array(':user:'.$_SERVER['REMOTE_USER'].':'.tpl_getConf('avatar').'.png', ':wiki:'.$_SERVER['REMOTE_USER'].'.png', 'debug/avatar.svg'), false, $spacious['images']['avatarsize']);
        //$spacious['images']['avatar'] = tpl_getMediaFile(array(':'.tpl_getConf('avatars').':'.$_SERVER['REMOTE_USER'].'.png', ':'.tpl_getConf('avatars').':'.$_SERVER['REMOTE_USER'].'.jpg', 'debug/avatar.png'), false, $spacious['images']['avatar']['size']);
        $spacious['images']['avatar']['target'] = tpl_getMediaFile(array(':'.tpl_getConf('avatars').':'.$_SERVER['REMOTE_USER'].'.png', ':'.tpl_getConf('avatars').':'.$_SERVER['REMOTE_USER'].'.jpg', 'debug/avatar.png'), false);
        $spacious['images']['avatar']['thumbnail'] = tpl_getMediaFile(array(':'.tpl_getConf('avatars').':'.$_SERVER['REMOTE_USER'].'-thumbnail.png', ':'.tpl_getConf('avatars').':'.$_SERVER['REMOTE_USER'].'-thumbnail.jpg'), false);
    //} elseif (((isset($_SERVER['REMOTE_USER'])) and (tpl_getConf('avatar') != null)) or ($_GET['debug'] == 1) or ($_GET['debug'] == "images") or ($_GET['debug'] == "avatar")) {
        //if ((strpos($spacious['images']['avatar'], "debug") !== false) and (($_GET['debug'] != 1) and ($_GET['debug'] != "images") and ($_GET['debug'] != "avatar"))) {
        //    $spacious['images']['avatar'] = null;
        //}
        //if (file_exists($spacious['images']['avatar'])) { dbg("avatar existant"); }
        //if (file_exists(substr($string, 0, -3)
    }
//dbg($spacious['images']['avatar']);
//dbg($spacious['images']['avatarsize']);
//dbg($spacious['images']);
//dbg(file_exists($spacious['images']['conlogo']['thumbnail']));

    // BUILD LAST CHANGES LIST
//    if ((strpos(tpl_getConf('topbar'), 'newsticker') !== false) and ($ID != $conf['start'])) {
    if (strpos(tpl_getConf('topbar'), 'newsticker') !== false) {
    // Retrieve number of last changes to show from digit at the end of setting ("other" field)
        $spacious['recents'] = array();
        $showLastChanges = intval(end(explode(',', tpl_getConf('newsTicker'))));
        $flags = 0;
        if (strpos(tpl_getConf('newsTicker'), 'skip_deleted') !== false) {
            $flags = RECENTS_SKIP_DELETED;
        }
        if (strpos(tpl_getConf('newsTicker'), 'skip_minors') !== false) {
            $flags += RECENTS_SKIP_MINORS;
        }
        if (strpos(tpl_getConf('newsTicker'), 'skip_subspaces') !== false) {
            $flags += RECENTS_SKIP_SUBSPACES;
        }
        if ((strpos(tpl_getConf('newsTicker'), 'pages') !== false) and (strpos(tpl_getConf('newsTicker'), 'media') !== false)) {
            $flags += RECENTS_MEDIA_PAGES_MIXED;
        } if ((strpos(tpl_getConf('newsTicker'), 'pages') === false) and (strpos(tpl_getConf('newsTicker'), 'media') !== false)) {
            $flags += RECENTS_MEDIA_CHANGES;
        }
        $spacious['recents'] = getRecents(0,$showLastChanges,$spacious['ns']['current'],$flags);
//dbg($spacious['recents']);
    }

    // JSINFO
    // Add a value for connected user (false if none, true otherwise)
    //if (empty($_SERVER['REMOTE_USER'])) {
    //    $JSINFO['user'] = false;
    //} else {
    //    $JSINFO['user'] = true;
    //}
    // Store options into $JSINFO for later use
    //$JSINFO['ScrollDelay'] = tpl_getConf('scrollDelay');
    //if ((strpos(tpl_getConf('topbar'), 'newsticker') !== false) and (count($spacious['recents']) > 0)) {
    if (strpos(tpl_getConf('topbar'), 'newsticker') !== false) {
        $JSINFO['LoadNewsTicker'] = true;
    } else {
        $JSINFO['LoadNewsTicker'] = false;
    }
    if (strpos(tpl_getConf('stickies'), 'pageheader') !== false) {
        $JSINFO['StickyPageheader'] = true;
    } else {
        $JSINFO['StickyPageheader'] = false;
    }
    //if (tpl_getConf('smallNewsBar') == true) {
    //    $JSINFO['NewsTickerOffset'] = 3;
    //} else {
    //    $JSINFO['NewsTickerOffset'] = 5;
    //}
    $JSINFO['Animate'] = tpl_getConf('animate');
//$JSINFO['ScrollspyToc'] = tpl_getConf('scrollspyToc');
//dbg($JSINFO);

    // DEBUG
    // Adding test alerts if debug is enabled
    if (($_GET['debug'] == 1) or ($_GET['debug'] == "alerts")) {
        msg("This is an error [-1] alert with a <a href='#'>dummy link</a>", -1);
        msg("This is an info [0] message with a <a href='#'>dummy link</a>", 0);
        msg("This is a success [1] message with a <a href='#'>dummy link</a>", 1);
        msg("This is a notification [2] with a <a href='#'>dummy link</a>", 2);
    }

}/* /spacious_init */

/**
 * Returns body classes according to settings
 */
function spacious_bodyclasses() {
    /*global $conf, $ACT;*/
    global $spacious;

    $classes = array();
    //$pattern = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);
    /*if (tpl_getConf('bodyBg') == "pattern") {
        $pattern = tpl_getMediaFile(array(':wiki:pattern.png', 'images/pattern.png'), false, $patternSize);
        if ($pattern == "/lib/tpl/spacious/images/pattern.png") {
            $bgClass = "tpl-pattern-bg";
        } else {
            $bgClass = "wiki-pattern-bg";
        }
    } else {
        $bgClass = "color-bg";
    }*/
    /*if (tpl_getConf('textWrap')) {
        $textWrap = "wrap";
    } else {
        $textWrap = "";
    }*/
    /*
    if ($ACT=='show') {
        $sidebar = tpl_getConf('sidebarPos').'-sidebar';
    } else {
        $sidebar = 'no-sidebar';
    }*/
    /*$classes = array(
        tpl_getConf('layout').'-layout',
        $bgClass,
        $textWrap,
        $sidebar,
    );*/

    if ((tpl_getConf('bodyBg') == "pattern") and ($_GET['debug'] != 1)) {
        $pattern = tpl_getMediaFile(array(':wiki:pattern.png', 'images/pattern.png'), false, $patternSize);
        if ($pattern == "/lib/tpl/spacious/images/pattern.png") {
            $bgClass = "tpl-pattern-bg";
        } else {
            $bgClass = "wiki-pattern-bg";
        }
    } else {
        $bgClass = "color-bg";
    }

//    if ($spacious['showSidebar']) {
//        $sidebar = tpl_getConf('sidebarPos')."-sidebar";
//    } else {
//        //$sidebar = "no-".tpl_getConf('sidebarPos')."-sidebar";
//      $sidebar = "no-sidebar";
//    }
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

//    array_push($classes, 'better-responsive-menu', tpl_getConf('layout').'-layout', tpl_getConf('breadcrumbsStyle').'-breadcrumbs', $bgClass, (tpl_getConf('dark')) ? 'dark' : '', $sidebar, (tpl_getConf('truncatebc')) ? 'truncatebc' : '', (strpos(tpl_getConf('stickies'), 'pageheader') !== false) ? 'sticky-pageheader' : '', (strpos(tpl_getConf('stickies'), 'sidebar') !== false) ? 'sticky-sidebar' : '', (strpos(tpl_getConf('stickies'), 'docinfo') !== false) ? 'sticky-docinfo' : '', ((strpos(tpl_getConf('extractible'), 'toc') !== false) and (tpl_getConf('layout') == "boxed")) ? 'extractible-toc' : '', ((strpos(tpl_getConf('extractible'), 'sidebar') !== false) and (tpl_getConf('layout') == "boxed")) ? 'extractible-sidebar' : '', ($_GET['debug']==1) ? 'debug' : '');
//    array_push($classes, tpl_getConf('layout').'-layout', tpl_getConf('breadcrumbsStyle').'-breadcrumbs', $bgClass, (tpl_getConf('dark')) ? 'dark' : '', $sidebar, (tpl_getConf('truncatebc')) ? 'truncatebc' : '', (strpos(tpl_getConf('stickies'), 'pageheader') !== false) ? 'sticky-pageheader' : '', (strpos(tpl_getConf('stickies'), 'docinfo') !== false) ? 'sticky-docinfo' : '', ((strpos(tpl_getConf('extractible'), 'toc') !== false) and (tpl_getConf('layout') == "boxed")) ? 'extractible-toc' : '', ($_GET['debug']==1) ? 'debug' : '', (tpl_getConf('printhrefs')) ? 'printhrefs' : '');
    array_push($classes, tpl_getConf('layout').'-layout', tpl_getConf('breadcrumbsStyle').'-breadcrumbs', $bgClass, (tpl_getConf('dark')) ? 'dark' : '', $sidebar, (tpl_getConf('truncatebc')) ? 'truncatebc' : '', (strpos(tpl_getConf('stickies'), 'pageheader') !== false) ? 'sticky-pageheader' : '', (strpos(tpl_getConf('stickies'), 'docinfo') !== false) ? 'sticky-docinfo' : '', ((strpos(tpl_getConf('extractible'), 'toc') !== false) and (tpl_getConf('layout') == "boxed")) ? 'extractible-toc' : '', ($_GET['debug']==1) ? 'debug' : '', (tpl_getConf('printhrefs')) ? 'printhrefs' : '');
//dbg($classes);
    /* TODO: better home detection than core */
    return ' '.rtrim(join(' ', array_filter($classes)));
}/* /spacious_bodyclasses */

/**
 * Adapted from page_findnearest() core function
 *
 * Find an element (page, image or conf file) in the current namespace
 * (determined from $ID) or any higher namespace that can be accessed
 * by the current user (this can be overriden by an optional parameter).
 * Note there's no ACL check for conf files as it is irrelevant.
 *
 * Used for sidebars, but can be used other stuff as well
 *
 * @param   string  $page the pagename you're looking for
 * @param   string  $type the type of element you're looking for ("page", "media" or "conf"
 * @param   bool    $useacl only return elements readable by the current user, false to ignore ACLs
 * @return false|string the full page id of the found element, false if none
 */
function spacious_findnearest($element, $type = "page", $useacl = true) {
    if (!$element) return false;
    global $conf, $ID;

    if ($type == "conf") {
        //$path = DOKU_CONF."tpl/spacious/".$searchnspath;
        $path = DOKU_CONF;
    } elseif ($type == "media") {
        //$path = $conf['savedir']."/media/".$searchnspath;
        $path = $conf['savedir']."/media/";
    } else {
        $path = $conf['savedir']."/pages/";
    }

    $ns = $ID;
    do {
        $ns = getNS($ns);

        $search = cleanID("$ns:$element");
        if ($type == "conf") {
            dbg("TODO");
//$result = glob(DOKU_CONF.'tpl/spacious'.$value.'/'.$fileName.'.ini');
        } elseif ($type == "media") {
            dbg("TODO");
            //$result = glob(DOKU_INC.$conf['savedir'].'/media'.$value.'/'.$fileName.'.{jpg,gif,png}', GLOB_BRACE);
        } else {
            if(!$useacl || auth_quickaclcheck($search) >= AUTH_READ){
//dbg(DOKU_INC.$path.str_replace(":", "/", $search).".txt");
//$result = glob(DOKU_INC.$conf['savedir'].'/pages'.$value.'/'.$fileName.'.txt');
                if (file_exists(DOKU_INC.$path.str_replace(":", "/", $search).".txt")) {
                    return $search;
                }
            }
        }
    } while($ns);

    return false;
}

/**
 * adapted from core
 *
 * See original function in inc/template.php for details
 */
function spacious_searchform($ajax = true, $autocomplete = true, $dw = false) {
    global $spacious;
    global $lang, $ACT, $QUERY;

    // don't print the search form if search action has been disabled
    if(!actionOK('search')) return false;

//                            <form action="http://demo.themegrill.com/spacious/" class="search-form searchform clearfix" method="get">
//                                <div class="search-wrap">
//                                    <input type="text" placeholder="Search" class="s field" name="s">
//                                    <button class="search-icon" type="submit"></button>
//                                </div>
//                            </form><!-- .searchform -->


    print '<form id="search-form" action="'.wl().'" accept-charset="utf-8" class="search searchform clearfix';
//    if ($dw) { print ' dw'; }
//    print '" method="get" role="search"><div class="no">';
    print '" method="get" role="search"><div class="no">';
//    print '<div class="search-wrap">';
    print '<input type="hidden" name="do" value="search" />';
    print '<input type="text" ';

//    print '<form action="'.wl().'" accept-charset="utf-8" class="form-inline search" id="dw__search" method="get" role="search"><div class="no">';
//    print '<input type="hidden" name="do" value="search" />';
//    print '<input type="text" ';
    if($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
//    print 'placeholder="&#xF002; '.$lang['btn_search'].'" ';
    print 'placeholder="'.$lang['btn_search'].'" ';
    if(!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" accesskey="f" name="id" class="s field" title="[F]" />';
    if (!$dw) {
        print '<button type="submit" title="'.$lang['btn_search'].'">'.spacious_glyph("search", true).'</button>';
    }
//    print '</div>';
//  REMOVED JSpopup class because when used, quick search result doesn't show up ("Found pages"). Original line: if ($ajax) print '<div id="qsearch__out" class="panel panel-default ajax_qsearch JSpopup"></div>';
    if ($ajax) print '<div id="qsearch__out" class="panel panel-default ajax_qsearch"></div>';
    print '</div></form>';
    return true;
}/* /spacious_searchform */

function spacious_usertools() {
    global $ID, $ACT, $lang, $INFO;

    $objects = (new \dokuwiki\Menu\UserMenu())->getItems();

    $object =  (array) $objects;
    // If no user is logged in
    foreach ($object as $key => $value) {
        //dbg($object);
        $field = (array) $value;
//        $liclasses = "action ";
//        if (($field["\0*\0type"] == "login") || ($field["\0*\0type"] == "register") || ($field["\0*\0type"] == "profile") || ($field["\0*\0type"] == "logout")) {
//            $liclasses .= $field["\0*\0type"];
//        } else {
//            $liclasses .= "debug";
//        }
//        $target = $ID;
//        $string = $lang['btn_'.$field["\0*\0type"]];
//        if ($field["\0*\0type"] == "login") {
//            $target .= '#spacious__userwidget';
//        } elseif ($field["\0*\0type"] == "register") {
//            $target .= '&amp;do=register';
//        } elseif ($field["\0*\0type"] == "profile") {
//            $target .= '#spacious__userwidget';
//            $string = $lang['profile'];
//        } elseif ($field["\0*\0type"] == "logout") {
//            $target .= '&amp;do=logout&amp;sectok='.$field["\0*\0params"]['sectok'];
//        } else {
//            $target .= '&amp;do='.$field["\0*\0type"];
//        }
//        print '<li class="'.$liclasses.'"><a href="/doku.php?id='.$target.'" rel="nofollow" title="'.$string.'"><span class="a11y">'.$string.'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
//        if (($field["\0*\0type"] == "login") && ($ACT != "denied")) {
        if (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) {
            $class = null;
        } else {
            $class = ' class="a11y"';
        }
        if ($field["\0*\0type"] == "login") {
            if ($ACT == "denied") {
                //print '<li class="action login"><a href="/doku.php?id='.$ID.'#spacious__content" rel="nofollow" title="'.$lang['btn_login'].'"><span class="a11y">'.$lang['btn_login'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
                print '<li class="action login"><a href="#spacious__content" rel="nofollow" title="'.$lang['btn_login'].'"><span'.$class.'>'.$lang['btn_login'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
            } else {
                //print '<li class="action login"><a href="/doku.php?id='.$ID.'#spacious__userwidget" rel="nofollow" title="'.$lang['btn_login'].'"><span class="a11y">'.$lang['btn_login'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
                print '<li class="action login"><a href="#spacious__userwidget" rel="nofollow" title="'.$lang['btn_login'].'"><span'.$class.'>'.$lang['btn_login'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
            }
        } elseif (($field["\0*\0type"] == "register") && ($ACT != "register")) {
            print '<li class="action register"><a href="/doku.php?id='.$ID.'&amp;do=register" rel="nofollow" title="'.$lang['btn_register'].'"><span'.$class.'>'.$lang['btn_register'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
        } elseif ($field["\0*\0type"] == "profile") {
            //print '<li class="action profile"><a href="/doku.php?id='.$ID.'#spacious__userwidget" rel="nofollow" title="'.$lang['profile'].'"><span class="a11y">'.$lang['profile'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
            print '<li class="action profile"><a href="#spacious__userwidget" rel="nofollow" title="'.$lang['profile'].'"><span'.$class.'>'.$lang['profile'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
        } elseif (($field["\0*\0type"] == "admin") && ($_SERVER['REMOTE_USER'] != NULL) && ($INFO['isadmin'])) {
            print '<li class="action admin has-dropdown">';
                print '<a href="/doku.php?id='.$ID.'&do=admin" rel="nofollow" title="'.$lang['btn_admin'].'"><span'.$class.'>'.$lang['btn_admin'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a>';
                spacious_admin();
            print '</li><!-- .action.admin -->';
        } elseif ($field["\0*\0type"] == "logout") {
            print '<li class="action logout"><a href="/doku.php?id='.$ID.'&amp;do=logout&amp;sectok='.$field["\0*\0params"]['sectok'].'" rel="nofollow" title="'.$lang['btn_logout'].'"><span'.$class.'>'.$lang['btn_logout'].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
        } else {
            print '<li class="action debug '.$field["\0*\0type"].'"><a title="'.$field["\0*\0type"].'"><span'.$class.'>'.$field["\0*\0type"].'</span>'.inlineSVG($field["\0*\0svg"]).'</a></li>';
//dbg($field["\0*\0type"]);
//dbg($field["\0*\0type"]);
//dbg($field["\0*\0svg"]);
//dbg($lang['btn_'.$field["\0*\0type"]]);
//dbg($field);
        }
    }
}/* /spacious_usertools */

/**
 * The loginform
 * adapted from html_login() because spacious doesn't need autofocus on username input
 *
 * See original function in inc/html.php for details
 */
function spacious_loginform($context = "null") {
    global $lang;
    global $conf;
    global $ID;
    global $INPUT;

    if ($context == "widget") {
        $tmp = explode("</h1>", p_locale_xhtml('login'));
        $title = explode(">", $tmp[0])[1];
        $tmp = str_replace("! ", "!<br />", $tmp[1]);
        $tmp = str_replace(". ", ".<br />", $tmp);
        print '<h6 class="widget-title title-block-wrap clearfix"><span class="label">';
            print $title;
        print '</span></h6>';
        print $tmp;
    } else {
        print p_locale_xhtml('login');
    }
    print '<div>'.NL;
    //if ($context == "widget") {
    //    $form = new Doku_Form(array('id' => 'spacious__login'));
    //} else {
    //    $form = new Doku_Form(array('id' => 'dw__login'));
    //}
    $form = new Doku_Form(array('id' => 'dw__login'));
    $form->startFieldset($lang['btn_login']);
    $form->addHidden('id', $ID);
    $form->addHidden('do', 'login');
    $form->addElement(form_makeTextField('u', ((!$INPUT->bool('http_credentials')) ? $INPUT->str('u') : ''), $lang['user'], 'username', 'block'));
    $form->addElement(form_makePasswordField('p', $lang['pass'], '', 'block'));
    if($conf['rememberme']) {
        $form->addElement(form_makeCheckboxField('r', '1', $lang['remember'], 'remember__me', 'simple'));
    }
    $form->addElement(form_makeButton('submit', '', $lang['btn_login']));
    $form->endFieldset();

    if(actionOK('register')){
        $form->addElement('<p>'.explode("?", $lang['reghere'])[0].'? '.tpl_actionlink('register','','','',true).'.</p>');
    }

    if (actionOK('resendpwd')) {
        $form->addElement('<p>'.explode("?", $lang['pwdforget'])[0].'? '.tpl_actionlink('resendpwd','','','',true).'.</p>');
    }

    html_form('login', $form);
    print '</div>'.NL;
}/* /spacious_loginform */

function spacious_target($ret = false) {
    global $conf;
    $output = null;

    if ($conf['target']['extern'] != null) {
        $output = " target='".$conf['target']['extern']."'";
    }

    if ($ret) {
        return $output;
    } else {
        print $output;
        return true;
    }
}/* /spacious_target */

/**
 * PRINT HIERARCHICAL BREADCRUMBS, adapted from core (template.php) to use a CSS separator solution and respect existing/non-existing page link colors
 *
 * This code was suggested as replacement for the usual breadcrumbs.
 * It only makes sense with a deep site structure.
 *
 * @return bool
 */
function spacious_youarehere() {
    global $conf, $ID, $lang, $spacious;

    // check if enabled
    if(!$conf['youarehere']) return false;

    $parts = explode(':', $ID);
    $count = count($parts);
//dbg($parts);
    print '<ul>';
    if (tpl_getConf('breadcrumbsStyle') == "classic") {
        print '<li><span class="label" title="'.rtrim($lang['youarehere'], ':').'">'.$lang['youarehere'].'</span></li>';
    }
    // print the startpage unless we're in translated namespace (in wich case trace will start with current language start page)
//dbg($spacious['trans']);
    //if ((isset($spacious['trans']['parts'][0])) and (isset($spacious['trans']['defaultlang'])) and ($spacious['trans']['parts'][0] == $spacious['trans']['defaultlang'])) {
    if (((isset($spacious['trans']['parts'][0])) and (isset($spacious['trans']['defaultlang'])) and ($spacious['trans']['parts'][0] == $spacious['trans']['defaultlang'])) or ((!plugin_isdisabled('translation')) and (strpos($conf['plugin']['translation']['translations'], $spacious['trans']['defaultlang']) === false)) or (plugin_isdisabled('translation'))) {
        echo '<li class="home">';
            tpl_pagelink(':'.$conf['start']);
        echo '</li>';
    }
    // print intermediate namespace links
    $part = '';
    for($i = 0; $i < $count - 1; $i++) {
        $part .= $parts[$i].':';
//dbg($part);
        $page = $part;
        //if($page == $conf['start']) continue; // Skip startpage
        $class = spacious_breadcrumbsClass($page);
//dbg($page."=".$class);
        // output
        // skip if current target leads to untranslated wiki start
        //if ((isset($spacious['trans']['defaultlang'])) and ($page != $spacious['trans']['defaultLang'].":")) {
        if ($class != null) {
            echo "<li$class>";
        } else {
            echo "<li>";
        }
        if (p_get_metadata($page.$conf['start'], 'plugin_croissant_bctitle') != null) {
            tpl_pagelink($page, p_get_metadata($page.$conf['start'], 'plugin_croissant_bctitle'));
        } else {
//dbg("eh ben?".$page);
            tpl_pagelink($page);
        }
        //print '<bdi>'.spacious_html_wikilink($page).'</bdi>';
        echo "</li>";
    }

    // print current page, skipping start page, skipping for namespace index
    resolve_pageid('', $page, $exists);
    if(isset($page) && $page == $part.$parts[$i]) {
        echo "</ul>";
        return true;
    }
    $page = $part.$parts[$i];
    if ($page == $conf['start']) {
        echo "</ul>";
        return true;
    }
    $class = spacious_breadcrumbsClass($page);
    echo "<li$class>";
//    echo "<li>";
        if (p_get_metadata($page, 'plugin_croissant_bctitle') != null) {
            tpl_pagelink($page, p_get_metadata($page, 'plugin_croissant_bctitle'));
        } else {
            tpl_pagelink($page);
        }
    echo "</li>";
    echo "</ul>";
    return true;
}/* /spacious_youarehere */

/**
 * PRINT TRACE BREADCRUMBS, adapted from core (template.php) to use a CSS separator solution and respect existing/non-existing page link colors
 *
 * @return bool
 */
function spacious_trace() {
    global $lang, $conf, $ID;

    //check if enabled
    if(!$conf['breadcrumbs']) return false;

    $crumbs = breadcrumbs(); //setup crumb trace
//dbg($crumbs);
    // Make sure current page crumb is last in list (this also occurs with 'dokuwiki' template so it seems to be a core code minor bug)
    // COULD BE FIXED WITH FOLLOWING LINE BUT THIS BREAKS TWISTIENAV AS IT IS BASED ON CORE BREADCRUMBS()
    //$value = $crumbs[$ID];
    //unset($crumbs[$ID]);
    //$crumbs = array_merge($crumbs); 
    //$crumbs[$ID] = $value;
//dbg($crumbs);


    if (count($crumbs) > 0) {
//dbg($crumbs);
        //render crumbs, highlight the last one
        print '<ul>';
        if (tpl_getConf('breadcrumbsStyle') == "classic") {
            print '<li><span class="label" title="'.rtrim($lang['breadcrumb'], ':').'">'.$lang['breadcrumb'].'</span></li>';
        }
        $last = count($crumbs);
        $i    = 0;
        foreach($crumbs as $target => $name) {
            $i++;
            $class = spacious_breadcrumbsClass($target);
            print '<li'.$class.'>';
//        print '<li>';
            if (page_exists($target)) {
                $class = "wikilink1";
            } else {
                $class = "wikilink2";
            }
            if (count(explode(":",$target)) == 1) { $target = ":".$target; }
            if (p_get_metadata($target, 'plugin_croissant_bctitle') != null) {
                tpl_pagelink($target, p_get_metadata($target, 'plugin_croissant_bctitle'));
            } else {
                tpl_pagelink($target);
            }
            print '</li>';
        }
        echo "</ul>";
        return true;
    } else {
        return false;
    }
}/* /spacious_trace */

/**
 * PRINT SIBLINGS PSEUDO-BREADCRUMBS, adapted from core (template.php) to use a CSS separator solution and respect existing/non-existing page link colors
 *
 * @return bool
 */
function spacious_siblings() {
    global $lang, $conf, $spacious, $ID;
//dbg($spacious['nsindex']['pages']);

    //checking if siblings are enabled and have data or not is obsolete as it is tested in 'main.php'
    //if((!tpl_getConf('siblings')) or (!$spacious['nsindex']['pages'])) return false;

    $siblings = $spacious['nsindex']['pages'];
//dbg($siblings);

    //render siblings
    print '<ul>';
        if (tpl_getConf('breadcrumbsStyle') == "classic") {
            print '<li><span class="label" title="'.tpl_getLang('siblings').'">'.tpl_getLang('siblings').':</span></li>';
        }
        $i = 0;
        foreach($siblings as $value) {
            $i++;
            $class = spacious_breadcrumbsClass($value['id']);
            print '<li'.$class.'>';
                print $value['link'];
            print '</li>';
            // exit loop if we reached max number of siblings and add link to core index page
            if ($i == tpl_getConf('siblings')) {
                print '<li class="tools">';
                                tpl_link(
                                    wl($ID)."&do=index",
                                    spacious_glyph("ellipsis", true),
                                    'title="'.$lang['btn_index'].'"'
                                );
                print '</li>';
                break;
            }
        }
    echo "</ul>";
    return true;
}/* /spacious_siblings */

/**
 * PRINT TRANSLATIONS PSEUDO-BREADCRUMBS, adapted from core (template.php) to use a CSS separator solution and respect existing/non-existing page link colors
 *
 * @return bool
 */
function spacious_translations() {
    global $lang;
    global $spacious, $translationHelper;
//dbg($spacious['nsindex']['pages']);

    //render translations
    if ($spacious['trans']['dropdown'] != null) {
        print $spacious['trans']['dropdown'];
    } else {
        print '<ul>';
            if (tpl_getConf('breadcrumbsStyle') == "classic") {
                print '<li><span title="'.$translationHelper->getLang('translations').'">'.$translationHelper->getLang('translations').':</span></li>';
            }
            foreach ($spacious['trans']['links'] as $key => $link) {
                print '<li>';
                    print $link;
                print '</li>';
            }
        echo "</ul>";
    }
    return true;
}/* /spacious_translations */

/**
 * SELECT BREADCRUMBS SPECIAL CLASS IF NEEDED
 *
 * @return string
 */
function spacious_breadcrumbsClass($target = null) {
    global $ID, $conf, $translationHelper, $spacious;

    $classes = "";
//dbg($target);
//dbg($spacious['user']);
//dbg(substr($spacious['user']['private']['id'], 0, 0-strlen($conf['start'])));
    if ($target != null) {
        if (tpl_getConf('breadcrumbsGlyphs')) {
            if ($target == $conf['start']) {
                $classes .= " home";
            } elseif (($spacious['user']['private']['id'] != null) and (($target == $spacious['user']['private']['id']) or ($target == substr($spacious['user']['private']['id'], 0, 0-strlen($conf['start']))) or (substr($target, 0, strlen(substr($spacious['user']['private']['id'], 0, 0-strlen($conf['start'])))) == substr($spacious['user']['private']['id'], 0, 0-strlen($conf['start']))))) {
                $classes .= " userprivate";
            } elseif (($target == $spacious['user']['public']['id']) and ($target != "user:start")) {
                $classes .= " userpublic";
            } elseif (isset($translationHelper)) {
                $tmp = $translationHelper->getTransParts($target);
                //if (($tmp[0] != null) and ($tmp[0] != $conf['lang'])) {
                // If first part of $ID is a language code other than default language
                if (($tmp[0] != null) and ($tmp[0] != $spacious['trans']['defaultlang'])) {
                    $classes .= " translated";
                }
            }
        }
        if (($target == $ID) or ($target == rtrim($ID, $conf['start']))) {
            $classes .= " active";
        }
    }
    if ($classes != null) {
        return ' class="'.$classes.'"';
    } else {
        return null;
    }
}/* /spacious_breadcrumbsClass */

function spacious_glyph($glyph, $return = false) {
    global $spacious;
//dbg($glyph);

    if (isset($spacious['social'][$glyph])) {
        $maxsize = 4096;
    } else {
        $maxsize = 2048;
    }
    if ((isset($spacious['glyphs'][$glyph])) and (file_exists($spacious['glyphs'][$glyph]))) {
        $result = inlineSVG($spacious['glyphs'][$glyph], $maxsize);
//dbg("ici?");
    } else {
        $result = inlineSVG(DOKU_INC.'lib/images/menu/00-default_checkbox-blank-circle-outline.svg', 2048);
//dbg("là");
    }
    if ($return) {
        return $result;
    } else {
        print $result;
        return 1;
    }
}/* spacious_glyph */

function spacious_include($file, $widget = false) {
    if ((($_GET['debug'] == 1) or ($_GET['debug'] == 'include')) && (file_exists(tpl_incdir().'debug/'.$file.'.html'))) {
        if ($widget) {
            print '<aside id="spacious__'.$file.'" class="widget include-hook-sample">';
        }
        include(tpl_incdir().'debug/'.$file.'.html');
    } elseif (file_exists(tpl_incdir().$file.'.html')) {
        if ($widget) {
            print '<aside id="spacious__'.$file.'" class="widget">';
        }
        include(tpl_incdir().$file.'.html');
    } else {
        print p_wiki_xhtml($file, '', false);
    }
    if ($widget) {
        print '</aside>';
    }
}/* /spacious_include */

function spacious_replace($file, $string = null) {
    if (($_GET['debug'] == 'replace') && (file_exists(tpl_incdir().'debug/'.$file.'.html'))) {
        include(tpl_incdir().'debug/'.$file.'.html');
    } elseif (file_exists(tpl_incdir().$file.'.html')) {
        include(tpl_incdir().$file.'.html');
    } elseif ($string != null) {
        print $string;
    } else {
        print p_wiki_xhtml($file, '', false);
    }
}/* /spacious_replace */

/*
function spacious_widgetize($file) {
    if ((($_GET['debug'] == 1) or ($_GET['debug'] == 'include')) or (file_exists(tpl_incdir().$file.'.html'))) {
            print '<aside id="footer-widget-'.$file.'" class="widget widget_text">';
                spacious_include($file);
            print '</aside>';
    }
}
*/

/**
 * Adapted from tpl_admin.php file of Bootstrap3 template by Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 */
function spacious_admin() {
    global $ID, $ACT, $auth, $conf, $spacious;

    print '<div class="dropdown">';
        $admin_plugins = plugin_list('admin');
        $tasks = array('usermanager', 'acl', 'extension', 'config', 'styling', 'revert', 'popularity', 'upgrade');
        $addons = array_diff($admin_plugins, $tasks);
        $adminmenu = array(
            'tasks' => $tasks,
            'addons' => $addons
        );
        foreach ($adminmenu['tasks'] as $task) {
            if(($plugin = plugin_load('admin', $task, true)) === null) continue;
    //        if($plugin->forAdminOnly() && !$INFO['isadmin']) continue;
            if($task == 'usermanager' && ! ($auth && $auth->canDo('getUsers'))) continue;
            $label = $plugin->getMenuText($conf['lang']);
            if (! $label) continue;
            if ($task == "popularity") { $label = preg_replace("/\([^)]+\)/","",$label); }
            //$class = 'action '.$task;
            if (($ACT == 'admin') and ($_GET['page'] == $task)) { $class .= ' active'; }
            //print sprintf('<div class="action '.$task.'"><a href="%s" title="%s"><span>%s</span>'.inlineSVG($spacious['glyphs'][$task]).'</a></div>', wl($ID, array('do' => 'admin','page' => $task)), ucfirst($task), $label);
            print sprintf('<div class="action '.$task.'"><a href="%s" title="%s"><span>%s</span>'.spacious_glyph($task, true).'</a></div>', wl($ID, array('do' => 'admin','page' => $task)), ucfirst($task), $label);
        }
        $f = fopen(DOKU_INC.'inc/lang/'.$conf['lang'].'/adminplugins.txt', 'r');
        $line = fgets($f);
        fclose($f);
        $line = preg_replace('/=/', '', $line);
//dbg($adminmenu['addons']);
        if (count($adminmenu['addons']) > 0) {
            print '<div class="label">'.$line.'</div>';
            foreach ($adminmenu['addons'] as $task) {
//dbg($task);
                if(($plugin = plugin_load('admin', $task, true)) === null) continue;
                if ($task == "move_tree") {
                    $parts = explode('<a href="%s">', $plugin->getLang('treelink'));
                    $label = substr($parts[1], 0, -4);
                } else {
                    $label = $plugin->getMenuText($conf['lang']);
                }
                if($label == null) { $label = ucfirst($task); }
                //$class = 'action '.$task;
                if (($ACT == 'admin') and ($_GET['page'] == $task)) { $class .= ' active'; }
                //print sprintf('<div class="action '.$task.'"><a href="%s" title="%s"><span>%s</span>'.$spacious['glyphs'][$task].'</a></div>', wl($ID, array('do' => 'admin','page' => $task)), ucfirst($task), ucfirst($label));
                print sprintf('<div class="action '.$task.'"><a href="%s" title="%s"><span>%s</span>'.spacious_glyph($task, true).'</a></div>', wl($ID, array('do' => 'admin','page' => $task)), ucfirst($task), ucfirst($label));
            }
        }
        print '<div class="label">'.tpl_getLang('cache').'</div>';
        print '<div class="action">';
            print '<a href="'.wl($ID, array("do" => $_GET['do'], "page" => $_GET['page'], "purge" => "true")).'">';
                //print '<span>'.tpl_getLang('purgepagecache').'</span>'.inlineSVG($spacious['glyphs']["recycle"]);
                print '<span>'.tpl_getLang('purgepagecache').'</span>'.spacious_glyph("recycle", true);
            print '</a>';
        print '</div>';
        print '<div class="action">';
            print '<a href="'.DOKU_URL.'lib/exe/js.php">';
                //print '<span>'.tpl_getLang('purgejscache').'</span>'.inlineSVG($spacious['glyphs']["refresh"]);
                print '<span>'.tpl_getLang('purgejscache').'</span>'.spacious_glyph("refresh", true);
            print '</a>';
        print '</div>';
        print '<div class="action">';
            print '<a href="'.DOKU_URL.'lib/exe/css.php">';
                //print '<span>'.tpl_getLang('purgecsscache').'</span>'.inlineSVG($spacious['glyphs']["refresh"]);
                print '<span>'.tpl_getLang('purgecsscache').'</span>'.spacious_glyph("refresh", true);
            print '</a>';
        print '</div>';
    print '</div><!-- .dropdown (ADMIN MENU) -->';
}

/**
 * Adapted from page_findnearest() core function
 *
 * Print some info about the current page
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 *
 * @param bool $ret return content instead of printing it
 * @return bool|string
 */
function spacious_docinfo($ret = false) {
    global $conf;
    global $lang;
    global $INFO;
    global $ID;
    global $spacious;

    // return if we are not allowed to view the page
    if(!auth_quickaclcheck($ID)) {
        return false;
    }

    // prepare date and path
    $fn = $INFO['filepath'];
    if(!$conf['fullpath']) {
        if($INFO['rev']) {
            $fn = str_replace($conf['olddir'].'/', '', $fn);
        } else {
            $fn = str_replace($conf['datadir'].'/', '', $fn);
        }
    }
    $fn   = utf8_decodeFN($fn);
    $date = dformat($INFO['lastmod']);
    $date = spacious_date("short", $INFO['lastmod'], true, true);
    // print it
    if($INFO['exists']) {
        $out = '';
//print "<img class='qrcode' src='".$spacious['qrcode']['id']."' alt='*this page*' />";
        if($INFO['editor']) {
            $out .= '<span title="'.tpl_getLang('lasteditor').'" class="editor">'.spacious_glyph('editor', true);
            if ((isset($spacious['qrcode']['editor'])) and ($spacious['qrcode']['editor'] != null)) {
                $out .= "<img class='qrcode editor' src='".$spacious['qrcode']['editor']."' alt='*last editor*' title='Contact editor' />";
            }
            $out .= '<bdi>'.ucfirst(editorinfo($INFO['editor'])).'</bdi>';
        } else {
            $out .= '<span class="editor svgonly" title="'.ucfirst($lang['external_edit']).'">'.spacious_glyph('extedit', true);
            //$out .= '['.$lang['external_edit'].']';
        }
        $out .= '</span>';
        $out .= '<span title="'.explode(':',$lang['lastmod'])[0].'">'.spacious_glyph('lastmod', true).$date.'</span>';
        if($INFO['locked']) {
            $out .= '<span title="'.$lang['lockedby'].'" class="locked">'.spacious_glyph('locked', true);
            if ((isset($spacious['qrcode']['locked'])) and ($spacious['qrcode']['locked'] != null)) {
                $out .= "<img class='qrcode locked' src='".$spacious['qrcode']['locked']."' alt='*locked by*' title='Contact locker' />";
            }
            $out .= '<bdi>'.ucfirst(editorinfo($INFO['locked'])).'</bdi>';
            $out .= '</span>';
        }
        $out .= '<span title="'.tpl_getLang('pagepath').'" class="path">'.spacious_glyph('pagepath', true);
        $out .= '<bdi>'.$fn.'</bdi></span>';
        if($ret) {
            return $out;
        } else {
            $classes = "docInfo flex evenly wrap smallest";
            if (strpos(tpl_getConf('neutralize'), 'docinfo') !== false) {
                $classes .= " neu";
            }
            echo '<div class="'.$classes.'">';
            echo $out;
            echo '</div>';
            return true;
        }
    }
    return false;
}

/**
 * RETURN A DATE
 * 
 * @param string    $type "long" for long date based on 'dateString' setting, "short" for numeric
 * @param integer   $timestamp timestamp to use (null for current server time)
 * @param bool      $clock if true, add hour to the result
 * @param bool      $print if true, print the result instead of returning it
 */
function spacious_date($type = "long", $timestamp = null, $clock = false, $return = false) {
    global $conf;
    $datelocale = tpl_getConf('datelocale');
    if ($datelocale != null) {
        if (strpos($datelocale, ',') !== false) {
            $datelocale = explode(",", $datelocale)[1];
        }
        setlocale(LC_TIME, $datelocale);
    }
    if ($type == "short") {
        $format = tpl_getConf('shortdatestring');
    } else {
        $format = tpl_getConf('longdatestring');
    }
    if ($clock) {
        $format .= ' %H:%M';
    }
    if ($timestamp == null) {
        $result = utf8_encode(ucwords(strftime($format)));
    } else {
        $result = utf8_encode(ucwords(strftime($format, $timestamp)));
    }
    if ($return) {
        return $result;
    } else {
        print $result;
        return 1;
    }
}

function spacious_social_link($network = null) {
    global $conf, $spacious;
//dbg($network);

//    // If there's a social network name and current wiki url is not included in given social network url
////dbg($spacious['social'][$network]." vs ".trim(DOKU_URL, "/"));
//    if (($network != null) and (strpos($spacious['social'][$network], trim(DOKU_URL, "/")) === false)) {
    if ($network != null) {
        $target = $conf['target']['extern'];
//dbg($spacious['social'][$network]);
        $result = '<li><a href="'.$spacious['social'][$network].'" class="social '.$network.'"';
        if ($target != null) { $result .= ' target="'.$target.'"'; }
        if (($network == "digg") or ($network == "dribbble") or ($network == "facebook") or ($network == "flickr") or ($network == "reddit")) {
            $tooltip = $network;
        } elseif ($network == "codepen") {
            $tooltip = "CodePen";
        } elseif ($network == "github") {
            $tooltip = "GitHub";
        } elseif ($network == "google-plus") {
            $tooltip = "Google+";
        } elseif ($network == "stumbleupon") {
            $tooltip = "StumbleUpon";
        } elseif ($network == "wordpress") {
            $tooltip = "WordPress";
        } elseif ($network == "youtube") {
            $tooltip = "YouTube";
        } else {
            $tooltip = ucwords(str_replace("_", " ", $network));
        }
        if ($tooltip != null) { $result .= ' title="'.$tooltip.'"'; }
        $result .= ' rel="nofollow">';
//dbg($spacious['glyphs'][$network]);
//dbg($spacious['glyphs']['default']);
        //if (($spacious['glyphs'][$network] != null) and ($spacious['glyphs'][$network] != $spacious['glyphs']['default'])) {
        //    $result .= $spacious['glyphs'][$network];
        //} else {
        //    $result .= $tooltip;
        //}
        $result .= spacious_glyph($network, true);
        if (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) {
            $class = "";
        } else {
            $class=' class="a11y"';
        }
        $result .= '<span'.$class.'>'.$tooltip.'</span>';
        $result .= '</a></li>';
        if ($return) {
            return $result;
        } else {
            print $result;
            return 1;
        }
    }
}

/**
 * PRINT LAST CHANGES LIST
 * 
 * Print an <ul> loaded with @param last changes.
 *
 * @param integer   $n number of last changes to show in the list
 */
function spacious_newsticker($context = null) {
    global $spacious, $conf, $lang;
//dbg($spacious['recents']);

    $mediaPath = str_replace("/pages", "/media", $conf['datadir']);
    if (count($spacious['recents']) > 1) {
        print '<ul class="newsticker">';
    }
    $i = 0;
    foreach ($spacious['recents'] as $key => $value) {
        $details = null;
        if ($value['sum'] != null) {
            //$details = ucfirst(trim($value['sum'], "."));
            $details = ucfirst(trim($value['sum'], "."));
        } else {
            $details = ucfirst(trim(str_replace(":", "", $lang['mail_changed']), chr(0xC2).chr(0xA0)));
        }
        if ($value['date'] != null) {
            $details .= " (".spacious_date("long", $value['date'], false, true).")";
        }
        if ($context == "landing") {
            $details .= ".";
        }
        //print '<li title="'.$value['id'].'">';
        if (count($spacious['recents']) > 1) {
            print '<li title="'.$details.'">';
        } else {
            print '<span title="'.$details.'">';
        }
            if ($value['media']) {
                if (is_file($mediaPath."/".str_replace(":", "/", $value['id']))) {
                    $exist = "wikilink1";
                } else {
                    $exist = "wikilink2";
                }
            } else {
                if (page_exists($value['id'])) {
                    $exist = "wikilink1";
                } else {
                    $exist = "wikilink2";
                }
            }
            if (($context == null) or ($conf['useheading'] == 0) or (p_get_first_heading($value['id']) == null)) {
                $pageName = $value['id'];
            } else {
                $pageName = p_get_first_heading($value['id']);
            }
            if ($value['media']) {
                tpl_link(
                    ml($value['id'],'',false),
                    $pageName,
                    'class="'.$exist.' medialink"'
                );
            } else {
                tpl_link(
                    wl($value['id']),
                    $pageName,
                    'class="'.$exist.'"'
                );
            }
            $by = null;
            if ($value['user'] != null) {
                $by = " ".$lang['by']." ";
            }
            if ($context == null) {
                //print '<span class="display-none xs-display-initial md-display-none wd-display-initial">'.$by.'<span class="text-capitalize"><bdi>'.$value['user'].'</bdi></span></span>';
                print '<span class="display-none xs-display-initial">'.$by.'<span class="text-capitalize"><bdi>'.$value['user'].'</bdi></span></span>';
            }
            $i++;
        if (count($spacious['recents']) > 1) {
            print '</li>';
        } else {
            print '</span>';
        }
    }
    if (count($spacious['recents']) > 1) {
        print '</ul>';
    }
}
