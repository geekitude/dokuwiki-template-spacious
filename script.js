/**
 *  We handle several device classes based on browser width.
 *
 *  - desktop:   > __tablet_width__ (as set in style.ini)
 *  - mobile:
 *    - tablet   <= __tablet_width__
 *    - phone    <= __phone_width__
 */
var device_class = ''; // not yet known
var device_classes = 'desktop mobile tablet phone';

function tpl_dokuwiki_mobile(){

    // the z-index in mobile.css is (mis-)used purely for detecting the screen mode here
    var screen_mode = jQuery('#screen__mode').css('z-index') + '';

    // determine our device pattern
    // TODO: consider moving into dokuwiki core
    switch (screen_mode) {
        case '1':
            if (device_class.match(/tablet/)) return;
            device_class = 'mobile tablet';
            break;
        case '2':
            if (device_class.match(/phone/)) return;
            device_class = 'mobile phone';
            break;
        default:
            if (device_class == 'desktop') return;
            device_class = 'desktop';
    }

    jQuery('html').removeClass(device_classes).addClass(device_class);

    // handle some layout changes based on change in device
    //var $handle = jQuery('#spacious__sidebar');
    var $toc = jQuery('#dw__toc h3');

    if (device_class == 'desktop') {
        // reset for desktop mode
        if($handle.length) {
            $handle[0].setState(1);
            $handle.hide();
        }
        if($toc.length) {
            $toc[0].setState(1);
        }
    }
    if (device_class.match(/mobile/)){
        // toc and sidebar hiding
        if($handle.length) {
            $handle.show();
            $handle[0].setState(-1);
        }
        if($toc.length) {
            $toc[0].setState(-1);
        }
    }
}

jQuery(function(){
    var resizeTimer;
    dw_page.makeToggle('#spacious__sidebar h6.toggle','#spacious__sidebar div.content');

    tpl_dokuwiki_mobile();
    jQuery(window).on('resize',
        function(){
            if (resizeTimer) clearTimeout(resizeTimer);
            resizeTimer = setTimeout(tpl_dokuwiki_mobile,200);
        }
    );

    // increase sidebar length to match content (desktop mode only)
    var sidebar_height = jQuery('.desktop #spacious__sidebar').height();
    var pagetool_height = jQuery('.desktop #dokuwiki__pagetools ul:first').height();
    // pagetools div has no height; ul has a height
    var content_min = Math.max(sidebar_height || 0, pagetool_height || 0);

    var content_height = jQuery('#spacious__content div.page').height();
    if(content_min && content_min > content_height) {
        var $content = jQuery('#spacious__content div.page');
        $content.css('min-height', content_min);
    }

    // blur when clicked
    jQuery('#dokuwiki__pagetools div.tools>ul>li>a').on('click', function(){
        this.blur();
    });
});

function js_spacious_sidebar_toggle(toggle) {
    if (typeof toggle === "undefined" && jQuery('#spacious__sidebar').css('display') === "none" || (typeof toggle !== "undefined" && toggle == "show")) {
        jQuery('#spacious__sidebar').show(JSINFO.Animate);
        jQuery('#spacious__main-subflex .vr').css('display', 'initial');
        jQuery('#spacious__main-subflex .vr').css('border-width', '0 1px 0 0');
        jQuery('#spacious__contools li.show').css('display', 'none');
        jQuery('#spacious__contools li.hide').css('display', 'inline-block');
        jQuery('#spacious__article').removeClass('hidden-sidebar');
    } else if (typeof toggle === "undefined" && jQuery('#spacious__sidebar').css('display') === "block" || (typeof toggle !== "undefined" && toggle == "hide")) {
        jQuery('#spacious__sidebar').hide(JSINFO.Animate);
        jQuery('#spacious__main-subflex .vr').css('display', 'none');
        jQuery('#spacious__main-subflex .vr').css('border-width', '0');
        jQuery('#spacious__contools li.hide').css('display', 'none');
        jQuery('#spacious__contools li.show').css('display', 'inline-block');
        jQuery('#spacious__article').addClass('hidden-sidebar');
    }
}
