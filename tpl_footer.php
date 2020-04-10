<?php
/**
 * Template footer, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** FOOTER ********** -->
<div id="dokuwiki__footer">
    <div class="pad inner-wrap">

        <?php tpl_license(''); // license text ?>

    </div><!-- /.pad -->
        <div class="buttons neu">
            <?php
                tpl_license('button', true, false, false); // license button, no wrapper
                $target = ($conf['target']['extern']) ? 'target="'.$conf['target']['extern'].'"' : '';
            ?>
            <a href="https://www.dokuwiki.org/donate" title="Donate" <?php echo $target?>><img src="<?php echo tpl_basedir(); ?>images/button-donate.png" width="80" height="15" alt="Donate" /></a>
            <a href="https://php.net" title="Powered by PHP" <?php echo $target?>><img src="<?php echo tpl_basedir(); ?>images/button-php.png" width="80" height="15" alt="Powered by PHP" /></a>
            <a href="//validator.w3.org/check/referer" title="Valid HTML5" <?php echo $target?>><img src="<?php echo tpl_basedir(); ?>images/button-html5.png" width="80" height="15" alt="Valid HTML5" /></a>
            <a href="//jigsaw.w3.org/css-validator/check/referer?profile=css3" title="Valid CSS" <?php echo $target?>><img src="<?php echo tpl_basedir(); ?>images/button-css.png" width="80" height="15" alt="Valid CSS" /></a>
            <a href="https://dokuwiki.org/" title="Driven by DokuWiki" <?php echo $target?>><img src="<?php echo tpl_basedir(); ?>images/button-dw.png" width="80" height="15" alt="Driven by DokuWiki" /></a>
        </div><!-- /.buttons -->
</div><!-- /#dokuwiki__footer -->

<?php
tpl_includeFile('footer.html');
