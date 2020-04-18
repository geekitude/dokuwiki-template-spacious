<?php
/**
 * DokuWiki Spacious Template
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 3 (https://www.gnu.org/licenses/gpl-3.0.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

session_start();
// Store ID from HTTP_REFERER (aka origin URL) into PHP Session if it contains current wiki URL and doesn't contain `admin` or `playground` 
if ((strpos($_SERVER["HTTP_REFERER"], DOKU_URL) !== false) and (strpos($_SERVER["HTTP_REFERER"], 'admin') === false) and (strpos($_SERVER["HTTP_REFERER"], 'playground') === false)) {
    // get what's after "id="
    $tmp = explode("id=", $_SERVER["HTTP_REFERER"]);
    // get what's before potential "&"
    $tmp = explode("&", $tmp[1]);
    // store in PHP session
    $_SESSION["origID"] = $tmp[0];
}


global $spacious;
$spacious = array();
spacious_init();
//dbg($spacious);
//dbg($_SESSION["origID"]);

?><!DOCTYPE html>
<html id="dokuwiki__top" lang="<?php echo $conf['lang'] ?>" dir="<?php echo (($_GET['dir'] <> null)) ? $_GET['dir'] : $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8" />
    <title><?php print $spacious['pagetitle'] ?> [<?php print strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php spacious_include("meta"); ?>
</head>
<body class="<?php print tpl_classes(); ?><?php print spacious_bodyclasses(); ?>">
    <!-- <div id="page" class="hfeed <?php //print ($showSidebar) ? tpl_getconf('sidebarPos').'-sidebar' : 'no-sidebar'; ?>"> -->
    <!-- <div id="page" class="site<?php //echo ($spacious['showSidebar']) ? ' showSidebar' : ''; ?><?php //echo ($hasSidebar) ? ' hasSidebar' : ''; ?>"> -->
    <div id="spacious__page" class="site">
        <div id="spacious__skip" class="<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : "a11y " ?>skip group">
            <span><a href="#spacious__main"><?php print $lang['skip_to_content'] ?></a></span>
        </div>
        <?php include('tpl_header.php') ?>
        <main role="main" id="spacious__main" class="group<?php print (strpos(tpl_getConf('neutralize'), 'toc') !== false) ? " neutoc" : "" ?>">
            <?php spacious_include("mainheader"); ?>
            <header id="spacious__pageheader" class="group<?php print (strpos(tpl_getConf('neutralize'), 'pageheader') !== false) ? " neu" : "" ?><?php print $ACT == "admin" ? " hidden" : "" ?>">
                <div class="inner-wrap">
                    <div id="spacious__pageheader-wrap" class="flex between wrap">
                        <div class="flex wrap">
                            <div class="content-logo-wrapper">
                                <?php
                                    //$link = null;
                                    $title = "ContextualLogo";
                                    if ($spacious['images']['nslogo']['target'] != null) {
                                        if ($spacious['images']['nslogo']['thumbnail'] != null) {
                                            print '<a href="'.$spacious['images']['nslogo']['target'].'" data-lity data-lity-desc="description"><img id="spacious__nslogo" src="'.$spacious['images']['nslogo']['thumbnail'].'" title="'.tpl_getLang('enlarge').'" alt="*'.$title.'*" width="48px" height="100%" /></a>';
                                        } else {
                                            print '<a href="'.$spacious['images']['nslogo']['target'].'" data-lity data-lity-desc="description"><img id="spacious__nslogo" src="'.$spacious['images']['nslogo']['target'].'" title="'.tpl_getLang('enlarge').'" alt="*'.$title.'*" width="48px" height="100%" /></a>';
                                        }
                                    }
                                ?>
                            </div><!-- /.content-logo-wrapper -->
                            <div class="content-title-wrapper">
                                <?php if((hsc($ID) != $spacious['pagetitle']) && ($ACT != "admin") && (tpl_getConf('pageheaderTitle'))): ?>
                                    <h1 class="header-post-title-class"><?php print $spacious['pagetitle'] ?></h1>
                                    <div class="pageId"><span><?php echo hsc($ID) ?></span></div>
                                <?php else: ?>
                                    <h1 class="pageId header-post-title-class"><span><?php print $spacious['pagetitle'] ?></span></h1>
                                <?php endif ?>
                                <?php if(isset($spacious['trans']['links']) && (count($spacious['trans']['links']) > 0) && ($ACT == "show")): ?>
                                    <nav class="breadcrumbs smallest">
                                        <div class="translations"><?php spacious_translations() ?></div>
                                    </nav>
                                <?php endif ?>
                            </div><!-- /.content-title-wrapper -->
                        </div><!-- /.flex -->
                        <nav>
                            <!-- BREADCRUMBS -->
                            <?php if($conf['breadcrumbs'] || $conf['youarehere'] || (($spacious['nsindex']['pages']) && (tpl_getConf('siblings')))): ?>
                                <nav class="breadcrumbs smallest">
                                    <?php if($conf['youarehere']): ?>
                                        <div class="youarehere"><?php spacious_youarehere() ?></div>
                                    <?php endif ?>
                                    <?php if($conf['breadcrumbs']): ?>
                                        <div class="trace"><?php spacious_trace() ?></div>
                                    <?php endif ?>
                                    <?php if(($spacious['nsindex']['pages']) && (tpl_getConf('siblings'))): ?>
                                        <div class="siblings"><?php spacious_siblings() ?></div>
                                    <?php endif ?>
                                </nav>
                            <?php endif ?>
                        </nav>
                    </div><!-- /#spacious__pageheader-wrap -->
                </div><!-- /.inner-wrap -->
            </header><!-- /#spacious__pageheader -->
<?php //dbg($spacious['images']); ?>
            <div id="spacious__main-flex" class="flex stretch spacer top-spacer">
                <!-- CONTEXTUAL TOOLS -->
                <aside id="spacious__contools" class="tools">
                    <?php if (tpl_getConf('contools') != '') : ?>
                        <ul class="flex column end">
                            <li class="label<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : " a11y" ?>" title="<?php print tpl_getLang('contools'); ?>">
                                <span><?php print tpl_getLang('contools'); ?></span>
                            </li>
                            <?php
                                print '<li class="action parent">';
                                if ((strpos(tpl_getConf('contools'), 'parent') !== false) and (explode(":", $ID)[0] != "playground")) {
                                    // If in "special" mode and we know what page the user came from
                                    if ((($ACT == "recent") or ($ACT == "media") or ($ACT == "index") or ($ACT == "admin")) and (isset($_SESSION["origID"]))) {
                                        tpl_link(wl($_SESSION["origID"]),spacious_glyph('previous', true).'<span>'.tpl_getLang('back_to_article').'</span>','title="'.$_SESSION["origID"].'"');
                                    // If first parent is a translated wiki home page
                                    } elseif (end($spacious['parents']) == $spacious['trans']['parts'][0].":".$conf['start']) {
                                        tpl_link(wl(end($spacious['parents'])),spacious_glyph('translated', true).'<span>['.$spacious['trans']['parts'][0].'] '.tpl_getLang('wikihome').'</span>','title="'.end($spacious['parents']).'"');
                                    // If there only one parent wich is wiki home
                                    //} elseif ((count($spacious['parents']) == 1) && (end($spacious['parents']) != $ID)) {
                                    } elseif ((count($spacious['parents']) == 1) && (end($spacious['parents']) == $conf['start'])) {
                                        tpl_link(wl(end($spacious['parents'])),spacious_glyph('home', true).'<span>'.tpl_getLang('wikihome').'</span>','title="'.end($spacious['parents']).'"');
                                    // If first parent is current NS start page
                                    } elseif (end($spacious['parents']) == cleanID(getNS($ID)).':'.$conf['start']) {
                                        tpl_link(wl(end($spacious['parents'])),spacious_glyph('namespace-start', true).'<span>'.tpl_getLang('nsstart').'</span>','title="'.end($spacious['parents']).'"');
                                    // Else we have a parent NS
                                    } elseif (count($spacious['parents']) > 1) {
                                        tpl_link(wl(end($spacious['parents'])),spacious_glyph('parent-namespace', true).'<span>'.tpl_getLang('parentns').'</span>','title="'.end($spacious['parents']).'"');
                                    }
                                }
                                print '</li>';
                            ?>
                            <?php if ((strpos(tpl_getConf('contools'), 'sidevision') !== false) and ($ACT != "edit") and ($ACT != "admin")) : ?>
                                <li class="action sidevision hide"><button onclick="js_spacious_sidevision()" title="<?php print tpl_getLang('sidebar_hide'); ?>"><?php spacious_glyph('hide'); ?><span><?php print tpl_getLang('sidebar_hide'); ?></span></button></li>
                                <li class="action sidevision show"><button onclick="js_spacious_sidebarvision()" title="<?php print tpl_getLang('sidebar_show'); ?>"><?php spacious_glyph('show'); ?><span><?php print tpl_getLang('sidebar_show'); ?></span></a></li>
                            <?php endif; ?>
                            <?php if ((strpos(tpl_getConf('contools'), 'syntax') !== false) and ($ACT == "edit")) : ?>
                                <li class="action syntax"><a href="/doku.php?id=wiki:syntax" title="wiki:syntax"><?php spacious_glyph('help'); ?><span><?php print tpl_getLang('syntax'); ?></span></a></li>
                            <?php endif; ?>
                            <?php
                                if ((strpos(tpl_getConf('contools'), 'playground') !== false) && (($conf['useacl'] == 1) && (isset($INFO['userinfo']))) or (($conf['useacl'] == 0))) {
                                    echo '<li class="action playground">';
                                        // If already in playground ...
                                        if (strpos($ID, 'playground') !== false) {
                                            // ... and we know what page the user came from
                                            if ((strpos($ID, 'playground') !== false) and (isset($_SESSION["origID"]))) {
                                                tpl_link(wl($_SESSION["origID"]),spacious_glyph('from-playground', true).'<span>'.tpl_getLang('back_to_article').'</span>','title="'.$_SESSION["origID"].'"');
                                            // ... and we don't know what page the user came from
                                            } else {
                                                tpl_link(wl(),spacious_glyph('from-playground', true).'<span>'.tpl_getLang('wikihome').'</span>','title="'.tpl_getLang('wikihome').'"');
                                            }
                                        // Else if not in playgraound
                                        } elseif (strpos($ID, 'playground') === false) {
                                            tpl_link(wl('playground:playground').'&amp;do=edit',spacious_glyph('playground', true).'<span>'.tpl_getLang('playground').'</span>','title="playground:playground"');
                                        }
                                    echo '</li>';
                                }
                            ?>
                            <?php if((strpos(tpl_getConf('contools'), 'savesettings') !== false) && ($INFO['isadmin'] || $INFO['ismanager']) && ($_GET['do'] == "admin") && ($_GET['page'] == "config")): ?>
                                <li class="action savesettings"><button type="submit" form="dw__configform" value="submit" title="<?php print $lang['btn_save']; ?> [s]"><?php spacious_glyph('save'); ?><span><?php print $lang['btn_save']; ?></span></button></li>
                            <?php endif; ?>
                            <?php if ((strpos(tpl_getConf('contools'), 'nsindex') !== false) && ($spacious['nsindex']['n'] > 0)) : ?>
                                <li class="action nsindex dropdown">
                                    <a class="nsindex" title="<?php print tpl_getLang('nsindex'); ?>"><?php spacious_glyph('map'); ?><span><?php print tpl_getLang('nsindex'); ?></span></a>
                                    <div class="dropdown-content">
                                        <ul>
                                            <?php
                                                //commented lines only needed if result wasn't split
                                                //if (isset($spacious['nsindex']['namespaces'])) {
                                                    foreach($spacious['nsindex']['namespaces'] as $key => $value) { print '<li>'.$spacious['nsindex']['namespaces'][$key]['link'].'</li>'; }
                                                    foreach($spacious['nsindex']['pages'] as $key => $value) { print '<li>'.$spacious['nsindex']['pages'][$key]['link'].'</li>'; }
                                                //} else {
                                                //    foreach($spacious['nsindex'] as $key => $value) { print '<li>'.$spacious['nsindex'][$key]['link'].'</li>'; }
                                                //}
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </aside>
                <div id="spacious__main-subflex" class="flex stretch">
                    <?php if($spacious['showSidebar']): ?>
                        <!-- ********** SIDEBAR ********** -->
<?php //dbg(spacious_findnearest($conf['sidebar'])); ?>
                        <aside id="spacious__sidebar" class="group smaller<?php print (strpos(tpl_getConf('neutralize'), 'sidebar') !== false) ? " neu" : "" ?>">
                            <?php spacious_include("sidebarheader"); ?>
                            <h6 class="toggle"><span class="label"><?php echo $lang['sidebar'] ?></span></h6>
                            <div class="content">
                                <?php tpl_flush() ?>
                                <?php tpl_includeFile('sidebarheader.html') ?>
                                <div id="spacious__sidecard" class="group">
                                    <?php
                                        if ($spacious['images']['sidecard']['target'] != null) {
                                            $link = null;
                                            $title = "SideCard";
                                            if ($link != null) {
                                                if ($link['accesskey'] != null) {
                                                    $link['label'] .= " [".strtoupper($link['accesskey'])."]";
                                                    $accesskey = 'accesskey="'.$link['accesskey'].'" ';
                                                }
                                                tpl_link(
                                                    $link['target'],
                                                    '<img src="'.$spacious['images']['sidecard']['target'].'" '.$accesskey.'title="'.$link['label'].'" alt="*'.$title.'*" '.$spacious['images']['sidecard']['size'][3].' class="'.tpl_getConf('sidecardstyle').'" />'
                                                );
                                            } else {
                                                print '<img src="'.$spacious['images']['sidecard']['target'].'" title="'.$title.'" alt="*'.$title.'*" '.$spacious['images']['sidecard']['size'][3].' class="'.tpl_getConf('sidecardstyle').'" />';
                                            }
                                        }
                                    ?>
                                </div><!-- #spacious__sidecard -->
                                <?php //tpl_include_page($conf['sidebar'], true, true) ?>
                                <?php spacious_replace($spacious['sidebar']) ?>
                                <?php tpl_includeFile('sidebarfooter.html') ?>
                            </div>
                            <?php spacious_include("sidebarfooter"); ?>
                            <hr class="<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : "a11y" ?>" />
<?php //dbg($spacious['parents']);dbg($ID);dbg(cleanID(getNS($ID))); ?>
                        </aside><!-- /#spacious__sidebar -->
                    <?php endif; ?>
                    <?php if($ACT=='show' && $spacious['showSidebar']): ?>
                        <div class="vr<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? " notvisibleifextracted" : " a11y" ?>"></div>
                    <?php endif; ?>
                    <article id="spacious__article">
                        <div id="spacious__content" class="group">
                            <div class="page group spacer">
                                <?php tpl_flush() ?>
                                <?php spacious_include("pageheader"); ?>
                                <!-- wikipage start -->
                                <?php tpl_content() ?>
                                <!-- wikipage stop -->
                                <?php spacious_include("pagefooter"); ?>
                            </div>
                            <hr class="spacer<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : " a11y" ?>" />
                            <?php if (($ACT == "show") or ($ACT == "edit")) { spacious_docinfo(); } ?>
                            <?php tpl_flush() ?>
                        </div><!-- #spacious__content -->
                    </article><!-- /#spacious__article -->
                </div><!-- /#spacious__main-subflex -->
                <!-- PAGE ACTIONS -->
                <nav id="spacious__pagetools" class="tools">
                    <ul class="flex column end">
                        <li class="label<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : " a11y" ?>" title="<?php echo $lang['page_tools']; ?>">
                            <span><?php echo $lang['page_tools']; ?></span>
                        </li>
                        <?php print (new \dokuwiki\Menu\PageMenu())->getListItems(); ?>
                    </ul>
                </nav>
                <div id="spacious__toc-placeholder">
                    <!-- Us tiniest possible image as a placeholder to avoid empty div (http://probablyprogramming.com/2009/03/15/the-tiniest-gif-ever) -->
                    <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" width="0" height="0" alt="" />
                </div><!-- /#spacious__toc-placeholder -->
            </div><!-- /#spacious__main-flex -->
            <?php spacious_include("mainfooter"); ?>
        </main><!-- #spacious__main -->
        <?php include('tpl_footer.php') ?>
    </div><!-- /#spacious__page -->
    <div id="spacious__housekeeper" class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="spacious__helper" class="no">Window width: <span> </span></div><?php /* helper to detect CSS media query in script.js and eventually display it if adding `&debug=1` to url*/ ?>
</body>
</html>
