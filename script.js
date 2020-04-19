if (JSINFO.LoadNewsTicker) {
    /* DOKUWIKI:include js/jquery.newsTicker-1.0.11.min.js */
}
if (JSINFO.LoadGumshoe) {
    /* DOKUWIKI:include js/gumshoe.min.js */
}


/**
 *  We handle several device classes based on browser width.
 *
 *  - desktop:   > 1201px
 *  - mobile:
 *    - tablet   >= 544px
 *    - phone    <= 543px
 *  And a special state when ToC and/or Sidebar are "extracted"
 */
var device_class = ''; // not yet known
var device_classes = 'extracted-toc extracted-sidebar desktop mobile tablet phone';
var screen_mode;
//var pagenav_width = 0;

function js_spacious_resize(){

    // the z-index of #mixture__helper div is (mis-)used on purpose for detecting the screen mode here
    screen_mode = jQuery('#spacious__helper').css('z-index') + '';
//console.log(screen_mode);

    // determine our device pattern
    switch (screen_mode) {
        case '1001':
            if (device_class.match(/phone/)) return;
            device_class = 'mobile phone';
//            jQuery('#js_lastchanges_container').hide();
            break;
        case '1002':
            if (device_class.match(/tablet/)) return;
            device_class = 'mobile tablet';
//            jQuery('#js_lastchanges_container').show();
            break;
        case '2001':
            if (device_class.match(/extracted-toc/)) return;
            device_class = 'desktop extracted-toc';
//            jQuery('#js_lastchanges_container').show();
            break;
        case '3001':
            if (device_class.match(/extracted-sidebar/)) return;
            device_class = 'desktop extracted-toc extracted-sidebar';
//            jQuery('#js_lastchanges_container').show();
            break;
        default:
            if (device_class == 'desktop') return;
//            jQuery('#js_lastchanges_container').show();
            device_class = 'desktop';
    }

    jQuery('html').removeClass(device_classes).addClass(device_class);

    // handle some layout changes based on change in device
//    var $bannertools = jQuery('#mixture__classic_nav h3.toggle');
    var $aside = jQuery('#spacious__sidebar h6.toggle');
    var $toc = jQuery('#dw__toc h3');

    if (device_class.match(/desktop/)){
        // reset for desktop mode
//        if($bannertools.length) {
//            $bannertools[0].setState(1);
//        }
        if($aside.length) {
            $aside[0].setState(1);
        }
        if($toc.length) {
            $toc[0].setState(1);
        }
        if (jQuery("body").hasClass("mix-layout")) {
            if (device_class.match(/extracted-toc/)){
                jQuery("#dw__toc").prependTo("#spacious__toc-placeholder");
                //console.log("prepend to placeholder");
            } else {
                jQuery("#dw__toc").prependTo("div.page");
                //console.log("prepend back");
            }
        }
    }

    if (device_class.match(/mobile/)){
        // toc and sidebar collapsed (toggles with titles shown)
//        if($bannertools.length) {
//            $bannertools[0].setState(-1);
//        }
        if($aside.length) {
            $aside.show();
            $aside[0].setState(-1);
        }
        if($toc.length) {
            $toc[0].setState(-1);
        }
    }

}

function js_spacious_sidevision(toggle) {
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

//function js_mixture_branding(){
//    // fix wiki title and tagline horizontal alignment when window is so tiny they go under logo
//    var brandingHeight = jQuery('#mixture__branding_start').height();
//    var brandingLogoHeight = jQuery('#mixture__branding_logo').height();
//    var brandingTextHeight = jQuery('#mixture__branding_text').height();
//    if (brandingHeight > brandingLogoHeight + brandingTextHeight) {
//        jQuery('#mixture__branding_text').css("text-align","center");
//    }
//    var brandingWidth = jQuery('#mixture__branding_start').width();
//    var brandingLogoWidth = jQuery('#mixture__branding_logo').width();
//    var brandingTextWidth = jQuery('#mixture__branding_text').width();
//    if (brandingWidth > brandingLogoWidth + brandingTextWidth) {
//        jQuery('#mixture__branding_text').css("text-align","initial");
//    }
//}

//function js_mixture_pagenav(){
//    var page_width = jQuery('#mixture__pagenav').width();
//    var pageid_width = jQuery('#mixture__pagenav div.pageId').outerWidth(true);
//    var pagetrs_width = 0;
//    jQuery('#mixture__pagenav li.trs').each(function() {
//        pagetrs_width += jQuery(this).outerWidth(true);
//    });
//    // 10 pixels substracted to add just a little security in the process
//    var available = page_width - pageid_width - pagetrs_width - 50;
//    if(pagenav_width > available){
//        // pagenav has overflow
//        jQuery('body').removeClass("inline-pagenav-dropdown");
//    } else {
//        // pagenav fits in page
//        jQuery('body').addClass("inline-pagenav-dropdown");
//    }
//}

jQuery(document).ready(function() {

    // the z-index in mobile.css is (mis-)used purely for detecting the screen mode here
    screen_mode = jQuery('#spacious__helper').css('z-index') + '';
    // turn sidebar title into a collapse toggle (like ToC)
    dw_page.makeToggle('#spacious__sidebar h6.toggle','#spacious__sidebar div.content');

    // Get sticky Pageheader height
    if (JSINFO.StickyPageheader) {
        var $pageheaderheight = jQuery('#spacious__pageheader').outerHeight();
    } else {
        var $pageheaderheight = 0;
    }

    if (JSINFO.LoadGumshoe) {
        //var spy = new Gumshoe('#dw__toc a');
        var spy = new Gumshoe('#dw__toc a',{
	      offset: (70 + $pageheaderheight)
        });
    }

    // Last changes ticker
    if (JSINFO.LoadNewsTicker) {
        jQuery('.js-lastchanges').newsTicker({
            max_rows: 1,
            row_height: parseFloat(jQuery("#spacious__topbar-newsticker").css("font-size")) + 4,
            speed: 600,
            direction: 'up',
            duration: 4000,
            autostart: 1,
            pauseOnHover: 1
        });
    }

    // CLICK WATCHER
//    jQuery('a[href*="#"]:not([href="#logoLinkImage"]):not([href="#sidebarLinkImage"]):not([href="#_fake_href"])').click(function() {
    jQuery('a[href*="#"]:not([href="#spacious__main"])').click(function() {
        var $target = jQuery(this.hash);
//console.log($delta);
//console.log($target);
//console.log(this.hash.substr(1));
//console.log(this.hash);
        //if ($target.length == 0) target = jQuery('a[name="' + this.hash.substr(1) + '"]');
        if ($target.length == 0) $target = jQuery('html');
        // Move to intended target
        jQuery('html, body').animate({ scrollTop: $target.offset().top - $pageheaderheight }, JSINFO.Animate);
        return false;
    });
 
    // RESIZE WATCHER
    // Prepare resize watcher and proceed a resize function first run to adjust layout
    jQuery(function(){
        var resizeTimer;

        // Proceed first run of resize watcher functions
        js_spacious_resize();
//        js_mixture_pagenav();
//        js_mixture_branding();
//        // Show some hidden elements only after jQuery initialisation
//        jQuery('#mixture__pagenav_nsindex').css("opacity","1");

        // RESIZE WATCHER
        jQuery(window).resize(function(){
//            // PageNav needs a very fast reaction (switching it is not a heavy process)
//            js_mixture_pagenav();
//            // Branding text needs a fast reaction time but can occur after PageNav
//            js_mixture_branding();
            // Other resize actions (mainly asides' toggles) can be less reactive without harming user experience
            if (resizeTimer) clearTimeout(resizeTimer);
            resizeTimer = setTimeout(js_spacious_resize,200);
        });

    });

});
