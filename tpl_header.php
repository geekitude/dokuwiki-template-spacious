<?php
/**
 * DokuWiki Spacious Template
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 3 (https://www.gnu.org/licenses/gpl-3.0.html)
 * 
 * Template header, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** HEADER ********** -->
<!-- <header id="masthead" class="site-header group"> -->
<header id="spacious__head" class="group">
    <?php spacious_include("header"); ?>
    <?php if ((strpos(tpl_getConf('topbar'), 'date') !== false) or (strpos(tpl_getConf('topbar'), 'newsticker') !== false) or (strpos(tpl_getConf('topbar'), 'socialnetworks') !== false)) : ?>
        <div id="spacious__topbar-wrapper" class="group<?php print (strpos(tpl_getConf('neutralize'), 'topbar') !== false) ? " neu" : "" ?>">
            <div class="inner-wrap">
                <div id="spacious__topbar" class="flex between smallest">
                    <?php if ((strpos(tpl_getConf('topbar'), 'date') !== false) or (strpos(tpl_getConf('topbar'), 'newsticker') !== false)) : ?>
                        <div class="flex row">
                            <?php if (strpos(tpl_getConf('topbar'), 'date') !== false) : ?>
                                <span id="spacious__topbar-date" title="<?php spacious_date(); ?>"><?php spacious_glyph('date'); ?><span><?php spacious_date(); ?></span></span>
                            <?php endif ?>
                            <?php if ((strpos(tpl_getConf('topbar'), 'newsticker') !== false) and ($spacious['recents'] != null) and is_array($spacious['recents'])) : ?>
                                <span id="spacious__topbar-newsticker" class="breaking-news" title="<?php print $lang['btn_recent']; ?>">
                                    <?php spacious_glyph('news') ?><strong<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : ' class="a11y"' ?>><?php print $lang['btn_recent']; ?>:</strong>
                                    <?php spacious_newsticker(); ?>
                                </span>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                    <?php if (strpos(tpl_getConf('topbar'), 'socialnetworks') !== false) : ?>
                        <div>
                            <span id="spacious__topbar-social">
                                <?php
                                    //if ((($_GET['debug'] == 1) or ($_GET['debug'] == "replace")) and (file_exists(tpl_incdir().'debug/social.html'))) {
                                    //    spacious_glyph('social');
                                    //    spacious_replace('social.html');
                                    //} elseif (count($spacious['social']) > 0) {
                                    if (count($spacious['social']) > 0) {
                                        spacious_glyph('social');
                                        if ($_GET['debug'] == 1) {
                                            print '<ul class="debug">';
                                        } else {
                                            print '<ul>';
                                        }
                                            foreach ($spacious['social'] as $key => $value) {
                                                spacious_social_link($key);
                                            }
                                        print '</ul>';
                                    }
                                ?>
                            </span>
                        </div>
                    <?php endif ?>
                </div><!-- /#spacious__topbar -->
            </div><!-- /.inner-wrap -->
        </div><!-- /#spacious__topbar-wrapper -->
    <?php endif ?>
    <div id="spacious__head-text-nav-container">
        <div class="inner-wrap">
            <div id="spacious__head-text-nav-wrap" class="flex between stretch">
                <div id="spacious__head-branding-wrap" class="flex column stretch">
                    <div id="spacious__head-branding" class="flex row start narrow-spacer">
                        <?php if (tpl_getConf('headerLogo')) : ?>
                            <div id="spacious__head-logo-wrap" style="<?php print 'height:'.$spacious['images']['logo']['size'][1].'px"'; ?>>
                                <?php
                                    // display logo as a link to the home page
                                    tpl_link(
                                        wl(),
                                        '<img src="'.$spacious['images']['logo']['target'].'" width="100%" height="'.$spacious['images']['logo']['size'][1].'" alt="" />',
                                        'accesskey="h" title="'.tpl_getLang('wikihome').' [H]"'
                                    );
                                ?>
                            </div><!-- /#spacious__head-logo-wrap -->
                        <?php endif ?>
                        <div id="spacious__head-text-wrap">
                            <h1 id="spacious__site-title">
                                <?php
                                    //if (($_GET['debug'] == "replace") and (file_exists(tpl_incdir('spacious')."debug/title.html"))) {
                                    //    include(tpl_incdir('spacious')."debug/title.html");
                                    //} else {
                                    //    tpl_link(wl(),$conf['title'],'accesskey="h" title="'.tpl_getLang('wikihome').' [H]"');
                                    //}
                                ?>
                                <?php spacious_replace('title', tpl_link(wl(),$conf['title'],'accesskey="h" title="'.tpl_getLang('wikihome').' [H]"',true)) ?>
                            </h1>
                            <?php if ($conf['tagline']): ?>
                                <p id="spacious__site-tagline">
                                    <?php
                                        //if (($_GET['debug'] == "replace") and (file_exists(tpl_incdir('spacious')."debug/tagline.html"))) {
                                        //    include(tpl_incdir('spacious')."debug/tagline.html");
                                        //} else {
                                        //    tpl_link(wl(),$conf['tagline'],'accesskey="h" title="'.tpl_getLang('wikihome').' [H]"');
                                        //}
                                    ?>
                                    <?php spacious_replace('tagline', tpl_link(wl(),$conf['tagline'],'accesskey="h" title="'.tpl_getLang('wikihome').' [H]"', true)) ?>
                                </p>
                            <?php endif ?>
                        </div><!-- /#spacious__head-text-wrap -->
                    </div><!-- /#spacious__head-branding -->
                    <?php spacious_include("brandingfooter"); ?>
                </div><!-- /.flex.column -->
                <div id="spacious__head-tools">
                    <div id="spacious__head-tools-wrap" class="flex column end">
                        <div id="spacious__head-banner-wrap">
                            <?php spacious_include("bannerheader"); ?>
                            <?php
                                if (($_GET['debug'] == "replace") and (file_exists(tpl_incdir('spacious')."debug/banner.html"))) {
                                    include(tpl_incdir('spacious')."debug/banner.html");
                                } elseif (file_exists(tpl_incdir('spacious')."banner.html")) {
                                    include(tpl_incdir('spacious')."banner.html");
                                } elseif ($spacious['images']['banner']['target'] != null) {
                                    $link = null;
                                    $title = "Banner";
                                    if ($link != null) {
                                        if ($link['accesskey'] != null) {
                                            $link['label'] .= " [".strtoupper($link['accesskey'])."]";
                                            $accesskey = 'accesskey="'.$link['accesskey'].'" ';
                                        }
                                        tpl_link(
                                            $link['target'],
                                            '<img src="'.$spacious['images']['banner']['target'].'" '.$accesskey.'title="'.$link['label'].'" alt="*'.$title.'*" '.$spacious['images']['banner']['size'][3].' class="spacer" />'
                                        );
                                    } else {
                                        print '<img src="'.$spacious['images']['banner']['target'].'" title="'.$title.'" alt="*'.$title.'*" '.$spacious['images']['banner']['size'][3].' class="spacer" />';
                                    }
                                }
                            ?>
                            <?php spacious_include("bannerfooter"); ?>
                        </div><!-- /#spacious__head-banner-wrap -->
                        <div class="tools flex column stretch">
                            <?php spacious_include("toolsheader"); ?>
                            <!-- USER TOOLS -->
                            <?php if ($conf['useacl']): ?>
                                <div id="dokuwiki__usertools" class="flex column end">
                                    <h6<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : ' class="a11y"' ?>><span class="label"><?php echo $lang['user_tools']; ?></span></h6>
                                    <ul>
                                        <li class="form">
                                            <?php spacious_searchform(); ?>
                                        </li>
                                        <?php
                                            spacious_usertools();
                                            //echo (new \dokuwiki\Menu\UserMenu())->getListItems('action ');
                                        ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                            <!-- SITE TOOLS -->
                            <div id="dokuwiki__sitetools" class="flex column end">
                                <h6<?php print (($_GET['debug'] == 1) or ($_GET['debug'] == 'a11y')) ? "" : ' class="a11y"' ?>><span class="label"><?php echo $lang['site_tools']; ?></span></h6>
                                <div class="mobileTools">
                                    <?php //echo (new \dokuwiki\Menu\MobileMenu())->getDropdown($lang['tools']); ?>
                                </div>
                                <ul>
                                    <?php echo (new \dokuwiki\Menu\SiteMenu())->getListItems('action ', tpl_getConf('headertoolsIcons')); ?>
                                </ul>
                            </div>
                            <?php spacious_include("toolsfooter"); ?>
                        </div><!-- /.tools -->
                    </div><!-- /#spacious__head-tools-wrap -->
                </div><!-- /#spacious__head-tools -->
            </div><!-- /#spacious__head-text-nav-wrap -->
        </div><!-- /.inner-wrap -->
        <div id="spacious__alerts" class="group">
            <?php
                html_msgarea();
                // If in playground...
                if (strpos($ID, 'playground') !== false) {
                    // ...and admin, show a link to managing page...
                    if ($INFO['isadmin']) {
                        msg(tpl_getLang('playground_admin'), 2);
                    // ...else, show a few hints on what it's for
                    } else {
                        msg(tpl_getLang('playground_user'), 0);
                    }
                }
            ?>
        </div><!-- /#spacious__alerts -->
    </div><!-- /#spacious__head-text-nav-container -->
    <?php spacious_include("headerfooter"); ?>
    <div id="spacious__widebanner-wrap" class="group<?php print $ACT == "admin" ? " hidden" : "" ?>">
        <?php
            if (($_GET['debug'] == "replace") and (file_exists(tpl_incdir('spacious')."debug/widebanner.html"))) {
                include(tpl_incdir('spacious')."debug/widebanner.html");
            } elseif (file_exists(tpl_incdir('spacious')."widebanner.html")) {
                include(tpl_incdir('spacious')."widebanner.html");
            } elseif ($spacious['images']['widebanner']['target'] != null) {
                $link = null;
                $title = "WideBanner";
                if ($link != null) {
                    if ($link['accesskey'] != null) {
                        $link['label'] .= " [".strtoupper($link['accesskey'])."]";
                        $accesskey = 'accesskey="'.$link['accesskey'].'" ';
                    }
                    tpl_link(
                        $link['target'],
                        '<img src="'.$spacious['images']['widebanner']['target'].'" '.$accesskey.'title="'.$link['label'].'" alt="*'.$title.'*" '.$spacious['images']['widebanner']['size'][3].' />'
                    );
                } else {
                    print '<img src="'.$spacious['images']['widebanner']['target'].'" title="'.$title.'" alt="*'.$title.'*" '.$spacious['images']['widebanner']['size'][3].' />';
                }
            }
        ?>
    </div><!-- #spacious__widebanner-wrap -->
</header><!-- /#spacious__head -->
