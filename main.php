<?php
/**
 * DokuWiki Default Template 2012
 *
 * @link     http://dokuwiki.org/template
 * @author   Anika Henke <anika@selfthinker.org>
 * @author   Clarence Lee <clarencedglee@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */

//session_start();
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

$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT=='show');
?><!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>

<body class="<?php print spacious_bodyclasses(); ?>">
    <div id="spacious__skip" class="<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y') or ($_GET['debug'] == 'skip')) ? "" : "a11y " ?>group">
        <a href="#dokuwiki__content"><?php print strtoupper($lang['skip_to_content']); ?></a>
    </div><!-- /#spacious__skip -->
    <div id="dokuwiki__site">
        <?php if ((strpos(tpl_getConf('topbar'), 'date') !== false) or (strpos(tpl_getConf('topbar'), 'newsticker') !== false) or (strpos(tpl_getConf('topbar'), 'socialnetworks') !== false)) : ?>
            <div id="spacious__topbar-wrapper" class="group<?php print (strpos(tpl_getConf('neutralize'), 'topbar') !== false) ? " neu" : "" ?>">
                    <div id="spacious__topbar" class="inner-wrap flex between smallest">
                        <?php if ((strpos(tpl_getConf('topbar'), 'date') !== false) or (strpos(tpl_getConf('topbar'), 'newsticker') !== false)) : ?>
                            <div class="flex row">
                                <?php if (strpos(tpl_getConf('topbar'), 'date') !== false) : ?>
                                    <span id="spacious__topbar-date" title="<?php //spacious_date(); ?>">*DATE*<?php //spacious_glyph('date'); ?><span><?php //spacious_date(); ?></span></span>
                                <?php endif ?>
                                *NEWSTICKER*
                                <?php if ((strpos(tpl_getConf('topbar'), 'newsticker') !== false) and ($spacious['recents'] != null) and is_array($spacious['recents'])) : ?>
                                    <span id="spacious__topbar-newsticker" class="breaking-news" title="<?php print $lang['btn_recent']; ?>">
                                        <?php //spacious_glyph('news') ?><strong<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : ' class="a11y"' ?>><?php print $lang['btn_recent']; ?>:</strong>
                                        <?php //spacious_newsticker(); ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                        <?php if (strpos(tpl_getConf('topbar'), 'socialnetworks') !== false) : ?>
                            <div>
                                <span id="spacious__topbar-social">
                                *SOCIAL*
                                    <?php
                                        //if (count($spacious['social']) > 0) {
                                        //    spacious_glyph('social');
                                        //    if ($_GET['debug'] == 1) {
                                        //        print '<ul class="debug">';
                                        //    } else {
                                        //        print '<ul>';
                                        //    }
                                        //        foreach ($spacious['social'] as $key => $value) {
                                        //            spacious_social_link($key);
                                        //        }
                                        //    print '</ul>';
                                        //}
                                    ?>
                                </span>
                            </div>
                        <?php endif ?>
                    </div><!-- /#spacious__topbar -->
            </div><!-- /#spacious__topbar-wrapper -->
        <?php endif ?>
        <div id="dokuwiki__top" class="site  <?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'showSidebar' : ''; ?> <?php echo ($hasSidebar) ? 'hasSidebar' : ''; ?>">

            <?php include('tpl_header.php') ?>

            <div class="inner-wrap group">

                <?php if($showSidebar): ?>
                    <!-- ********** ASIDE ********** -->
                    <div id="dokuwiki__aside">
                        <div class="pad aside include group">
                            <h3 class="toggle"><?php echo $lang['sidebar'] ?></h3>
                            <div class="content">
                                <div class="group">
                                    <?php tpl_flush() ?>
                                    <?php tpl_includeFile('sidebarheader.html') ?>
                                    <?php tpl_include_page($conf['sidebar'], true, true) ?>
                                    <?php tpl_includeFile('sidebarfooter.html') ?>
                                </div><!-- /.group -->
                            </div><!-- /.content -->
                        </div><!-- /.pad.aside -->
                    </div><!-- /#dokuwiki__aside -->
                <?php endif; ?>

                <!-- ********** CONTENT ********** -->
                <div id="dokuwiki__content">
                    <div class="pad group">
                        <?php html_msgarea() ?>

                        <div class="pageId"><span><?php echo hsc($ID) ?></span></div>

                        <div class="page group">
                            <?php tpl_flush() ?>
                            <?php tpl_includeFile('pageheader.html') ?>
                            <!-- wikipage start -->
                            <?php tpl_content() ?>
                            <!-- wikipage stop -->
                            <?php tpl_includeFile('pagefooter.html') ?>
                        </div><!-- /.page.group -->

                        <div class="docInfo"><?php tpl_pageinfo() ?></div>

                        <?php tpl_flush() ?>
                    </div><!-- /.pad.group -->
                </div><!-- /#dokuwiki__content -->

                <hr class="a11y" />

                <!-- PAGE ACTIONS -->
                <div id="dokuwiki__pagetools">
                    <h3 class="a11y"><?php echo $lang['page_tools']; ?></h3>
                    <div class="tools">
                        <ul>
                            <?php echo (new \dokuwiki\Menu\PageMenu())->getListItems(); ?>
                        </ul>
                    </div><!-- /.tools -->
                </div><!-- /#dokuwiki__pagetools -->
            </div><!-- /.wrapper.group -->
        </div><!-- /#dokuwiki__top -->

        <?php include('tpl_footer.php') ?>

    </div><!-- /#dokuwiki__site -->

    <div id="spacious__housekeeper" class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>
