<?php
/**
 * DokuWiki Spacious Template
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 3 (https://www.gnu.org/licenses/gpl-3.0.html)
 * 
 * Template footer, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** FOOTER ********** -->
<!-- <footer id="colophon" class="group"> -->
<footer id="spacious__foot" class="group">
    <div id="spacious__foot-widgets-container" class="group dark smaller">
        <?php spacious_include("footerheader"); ?>
        <div class="inner-wrap">
            <div id="spacious__foot-widgets-wrap" class="flex evenly start wrap">
                <?php if ($conf['useacl'] && $ACT != "login" && $ACT != "denied"): ?>
                    <aside id="spacious__userwidget" class="widget">
                        <?php
                            //if (($conf['useacl']) and (empty($_SERVER['REMOTE_USER'])) and (strpos(tpl_getConf('widgets'), 'footer_login') !== false))
                            if (($conf['useacl']) && (empty($_SERVER['REMOTE_USER']))) {
                                //<!-- LOGIN FORM -->
                                spacious_loginform('widget');
                            //} elseif ($spacious['show']['tools']) {
                            } else {
                                print '<h6 class="widget-title title-block-wrap group"><span class="label">'.$lang['profile'].'</span></h6>';
                                if ($spacious['images']['avatar']['target'] != null) {
                                    if (strpos($spacious['images']['avatar']['target'], "debug") !== false) {
                                        print '<a href="/doku.php?id='.$ID.'&amp;do=media&amp;ns='.tpl_getConf('avatars').'&amp;tab_files=upload" title="'.tpl_getLang('upload_avatar').'"><img id="spacious__user-avatar" src="'.$spacious['images']['avatar']['target'].'" title="'.tpl_getLang('upload_avatar').'" alt="*'.tpl_getLang('upload_avatar').'*" width="64px" height="100%" /></a>';
                                    } else {
                                        if ($spacious['images']['avatar']['thumbnail'] != null) {
                                            print '<a href="'.$spacious['images']['avatar']['target'].'" data-lity data-lity-desc="'.tpl_getLang('your_avatar').'" title="'.tpl_getLang('your_avatar').'"><img id="spacious__user-avatar" src="'.$spacious['images']['avatar']['thumbnail'].'" title="'.tpl_getLang('your_avatar').'" alt="*'.tpl_getLang('your_avatar').'*" width="64px" height="100%" /></a>';
                                        } else {
                                            print '<a href="'.$spacious['images']['avatar']['target'].'" data-lity data-lity-desc="'.tpl_getLang('your_avatar').'" title="'.tpl_getLang('your_avatar').'"><img id="spacious__user-avatar" src="'.$spacious['images']['avatar']['target'].'" title="'.tpl_getLang('your_avatar').'" alt="*'.tpl_getLang('your_avatar').'*" width="64px" height="100%" /></a>';
                                        }
                                    }
                                }
                                print '<ul>';
                                    print '<li>'.$lang['fullname'].' : <em>'.$INFO['userinfo']['name'].'</em></li>'; 
                                    print '<li>'.$lang['user'].' : <em>'.$_SERVER['REMOTE_USER'].'</em></li>'; 
                                    print '<li>'.$lang['email'].' : <em>'.$INFO['userinfo']['mail'].'</em></li>'; 
                                print '</ul>';
                                echo '<p class="user">';
                                    // If user has public page ID but no private space ID (most likely because UserHomePage plugin is not available)
                                    //if (($spacious['user']['private'] == null) && ($spacious['user']['public']['link'] != null)) {
                                    if (($spacious['user']['public']['id'] != null) && ($spacious['user']['private']['id'] != null)) {
dbg("vérifier ces liens");
                                        tpl_link(wl($spacious['user']['private']['id']),'<span>'.$spacious['user']['private']['title'].'</span>','title="'.$spacious['user']['private']['title'].'" class="'.$spacious['user']['private']['classes'].'"');
                                        print " - ";
                                        tpl_link(wl($spacious['user']['public']['id']),'<span>'.$spacious['user']['public']['title'].'</span>','title="'.$spacious['user']['public']['title'].'" class="'.$spacious['user']['public']['classes'].'"');
                                    } elseif (($spacious['user']['public']['id'] != null) && ($spacious['user']['private'] == null)) {
                                        //print $lang['loggedinas']." ".$spacious['user']['public']['link'];
                                        //print $lang['loggedinas']." ";
//                                    tpl_link(wl($spacious['user']['public']['id']),'<span>'.$spacious['user']['public']['string'].'</span>'.spacious_glyph('public-page', true),'title="'.$spacious['user']['public']['title'].'" class="'.$spacious['user']['public']['classes'].'"');
                                        //tpl_link(wl($spacious['user']['public']['id']),'<span>'.$spacious['user']['public']['string'].'</span>','title="'.$spacious['user']['public']['title'].'" class="'.$spacious['user']['public']['classes'].'"');
                                        print '<span title="'.$spacious['user']['public']['title'].'">'.$spacious['user']['public']['string'].'</span>';
                                    // If user has both public page ID and private space ID
                                    // In any other case, use DW's default function
                                    //} else {
                                    //    print $lang['loggedinas'].' '.userlink(); /* 'Logged in as ...' */
                                    }
                                echo '</p>';
                                echo '<p class="profile">';
                                    print '<a href="/doku.php?id='.$ID.'&amp;do=profile" rel="nofollow" title="'.$lang['btn_profile'].'"><span>'.$lang['btn_profile'].'</span>'.spacious_glyph("profile", true).'</a>';
                                echo '</p>';
                            }
                        ?>
                    </aside><!-- /#spacious__usertools -->
                <?php endif; ?>
                <?php if (page_findnearest(tpl_getConf('links'), $useacl)): ?>
                    <aside id="spacious__linkswidget" class="widget">
                        <h6 class="widget-title"><span class="label"><?php print tpl_getLang('links'); ?></span></h6>
                        <?php tpl_include_page(tpl_getConf('links')) /* includes the wiki page "topbar" */ ?>
                    </aside>
                <?php endif; ?>
                <?php spacious_include("footerwidget", true); ?>
                <aside id="spacious__licensewidget" class="widget">
                    <h6 class="widget-title"><span class="label"><?php print tpl_getLang('license'); ?></span></h6>
                    <?php if ((isset($spacious['qrcode']['license'])) and ($spacious['qrcode']['license'] != null)) : ?>
                        <img class="qrcode license" src="<?php print $spacious['qrcode']['license']; ?>" alt="*qrcode*" title="<?php print tpl_getLang('license'); ?>" />
                    <?php endif; ?>
                    <?php tpl_license(tpl_getConf('licenseVisual')) /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
                </aside>
                <?php if ((isset($spacious['qrcode']['id'])) and ($spacious['qrcode']['id'] != null)) : ?>
                    <aside id="spacious__onlinewidget" class="widget">
                        <h6 class="widget-title"><span class="label"><?php print tpl_getLang('onlineversion'); ?></span></h6>
                        <img class="qrcode url" src="<?php print $spacious['qrcode']['id']; ?>" alt="*qrcode*" title="<?php print tpl_getLang('onlineversion'); ?>" />
                    </aside>
                <?php endif; ?>
            </div><!-- /#spacious__foot-widgets-wrap -->
        </div><!-- /.inner-wrap -->
        <?php spacious_include("footer"); ?>
    </div><!-- /#spacious__foot-widgets-container -->
    <div class="footer-socket-wrapper group smallest<?php print (strpos(tpl_getConf('neutralize'), 'footersocket') !== false) ? " neu" : "" ?>">
        <div class="inner-wrap">
            <div class="footer-socket-area flex between">
                <div class="copyright">
                    <a href="https://themegrill.com/themes/spacious"<?php spacious_target(); ?> title="Spacious" ><span>Spacious</span><!-- <img src="/lib/tpl/spacious/images/Spacious_51x14.png" width="51" height="14" alt="*Spacious*" /> --></a> &copy; 2020 <a href="https://themegrill.com/"<?php spacious_target(); ?> title="ThemeGrill" rel="author"><span>ThemeGrill</span><!-- <img src="/lib/tpl/spacious/images/ThemeGrill_103x11.png" width="103" height="11" alt="*ThemeGrill*" /> --></a>
                </div><!-- /.copyright -->
                <nav class="small-menu group">
                    <ul class="menu buttons">
                        <li><a href="http://dokuwiki.org/" title="Driven by DokuWiki"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-dw.png" width="80" height="15" alt="Driven by DokuWiki" /></a></li>
                        <li class="noprint"><a href="http://www.dokuwiki.org/donate" title="Donate to DokuWiki"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-donate.png" width="80" height="15" alt="Donate to DokuWiki" /></a></li>
                        <li class="noprint"><a href="https://translate.dokuwiki.org/" title="Localized (you can help)"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-localized.png" width="80" height="15" alt="Localized" /></a></li>
                        <li><a href="http://php.net" title="Powered by PHP"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-php.png" width="80" height="15" alt="Powered by PHP" /></a></li>
                        <li><a href="http://validator.w3.org/check/referer" title="Check HTML5"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-html5.png" width="80" height="15" alt="Check HTML5" /></a></li>
                        <li><a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="Check CSS"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-css.png" width="80" height="15" alt="Check CSS" /></a></li>
                        <li><a href="https://github.com/geekitude/dokuwiki-template-spacious" title="Spacious template"<?php spacious_target(); ?>><img src="<?php print tpl_basedir(); ?>images/button-spacious.png" width="80" height="15" alt="Spacious tmplate" /></a></li>
                    </ul><!-- /.menu.buttons -->
                </nav><!-- /.small-menu -->
            </div><!-- /.footer-socket-area -->
        </div><!-- /.inner-wrap -->
    </div><!-- /.footer-socket-wrapper -->
</footer><!-- /#spacious__foot -->
<?php
tpl_includeFile('footer.html');
