![Spacious - Dokuwiki template](/images/spacious-banner.png)

# dokuwiki-template-spacious

<!--
---- template ----
description   : [Spacious Wordpress theme](https://themegrill.com/themes/spacious/) by [ThemeGrill](https://themegrill.com/) ported to DokuWiki
author        : Simon DELAGE
email         : sdelage@gmail.com
lastupdate_dt : 2020-04-08
compatible    : !Greebo
depends       : 
conflicts     : # prefix templates by template:
similar       : 
screenshot_img: # URL to a screenshot (should be a bigger one)
tags          : experimental, flexbox, hooks, html5, modern, namespace, polymorphic, responsive, scrollspy, sidebar, topbar, translation, wordpress

downloadurl   : http://github.com/Geekitude/dokuwiki-template-spacious/zipball/master
bugtracker    : http://github.com/Geekitude/dokuwiki-template-spacious/issues
sourcerepo    : http://github.com/Geekitude/dokuwiki-template-spacious/
donationurl   : https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FE645CXCLH49U
----
-->

Porting [Spacious Wordpress theme](https://themegrill.com/themes/spacious/) by [ThemeGrill](https://themegrill.com/) to DokuWiki using [this guide](https://www.dokuwiki.org/devel:wp_to_dw_template).

    See template.info.txt for template details
    Spacious is distributed under the terms of the GNU GPL V3 (see LICENSE file or [this link](https://www.gnu.org/licenses/gpl-3.0.html) for details)

The result is a "namespace-aware" and polymorphic template that can be as sleek and straightforward as it's original Wordpress parent or more modern with extratible sidebar and/or TOC and potentially sticky elements.

*Version of Spacious Wordpress theme used as base for this project : 1.5.6 (2018-11-20)*

Since Dokuwiki's Starter template is too outdated for my development skill, mainly [because of new menus](https://github.com/selfthinker/dokuwiki_template_starter/issues/14), I started with a lightened version of Dokuwiki's default template.

## Credits

### About ThemeGrill

The copyright notice at the very bottom of page shouldn't be removed.

### Third party modules

* [Advanced News Ticker - 1.0.11](http://risq.github.io/jquery-advanced-news-ticker/), distributed under [GNU General Public License v2.0](https://www.gnu.org/licenses/gpl-2.0.en.html)
* [Web Font Loader - 1.6.28](https://github.com/typekit/webfontloader) to nicely load fonts from Google Web Fonts, distributed under [Apache License 2.0](https://www.apache.org/licenses/LICENSE-2.0)
* [JDENTICON - 1.8.0](https://jdenticon.com/) to add modern and highly recognizable identicons, distributed under [zlib License](https://www.zlib.net/zlib_license.html)
* Context logo Lighbox effect use [Lity](https://sorgalla.com/lity/)

### Extra

* Added optional background pattern from [Subtle Patterns](https://www.toptal.com/designers/subtlepatterns/)
* SVG icons come from [Material Design Icons](https://materialdesignicons.com)
* [Dummy avatar](https://imgbin.com/png/r454K96z) is free for non commercial use
* Font used for sample UI images (banner, widebanner and sidebar.png) is: [Rollandin by Emilie Rollandin](http://www.archistico.com/portfolio/nuovo-font-rollandin/).
* Special thanks to Giuseppe Di Terlizzi, author of [Bootstrap3](https://www.dokuwiki.org/template:bootstrap3) DokuWiki template who nicely acepted that I copy some of his code to build admin dropdown menu.

## Todo list

* [ ] Namespace dependent CSS (for colors and fonts)
* [ ] Namespace dependent UI images (background pattern, logo, banner, widebanner and a potential sidebar header)
* [ ] Google Fonts : each of main text, headings, condensed text (mostly nav bar) and monospaced text (```code``` syntax) can use a different Google font (be warned that main text font should be kept very readable)
* [ ] Can have a "scrollspy" ToC on wide screen
* [ ] Wide banner slider with latest changes at wiki home?
* [ ] Sub namespaces list based on [Twistienav](https://www.dokuwiki.org/plugin:twistienav) plugin?
* [ ] Test most common plugins

## Main features

* [x] Topbar with date, newsticker (based on current namespace and sub content) and social links
* [x] Easy to customize glyphs(*) (from [Material Design Icons](https://materialdesignicons.com/) like other DW's SVG glyphs or [IcoMoon](https://icomoon.io/) for social links)
* [x] Sidebar and ToC can be moved out of page content on wide screen (only works in boxed layout)
* [x] Hidable sidebar
* [x] Stickable pageheader, sidebar and docinfo
* [x] Dynamic navigation button (current NS home, parent NS start, home or "back to article")
* [x] Dark color scheme
* [x] High number of HTML hooks (based on [this document](https://www.dokuwiki.org/include_hooks))
* [x] A few HTML replace hooks that let you replace some elements with more fancy HTML code
* [x] Siblings based on [Twistienav](https://www.dokuwiki.org/plugin:twistienav) plugin (a breadcrumbs like list of other pages in current namespace)
* [x] Expanded debug mode to show some specific elements (sample code or images)
  * [x] *a11y* (visual accessibility helpers)
  * [x] *alerts*
  * [x] *banner*
  * [x] *card* (sidebar namespace card image)
  * [x] *conlogo* (namespace logo within page header aka context logo)
  * [x] *images* (all UI images)
  * [x] *include* (HTML include hooks)
  * [x] *logo*
  * [x] *replace* (HTML replace hooks)

(*) to replace a glyph by another, simply put desired SVG file (2kb max) in `conf/svg` folder (you will most likely need to create it) and name it after the following list of elements : about.svg, acl.svg, admin.svg, config.svg, discussion.svg, extensions.svg, from-playground.svg, help.svg, home.svg, menu.svg, namespace-start.svg, parent-namespace.svg, playground.svg, popularity.svg, private-page.svg, public-page.svg, recycle.svg, refresh.svg, revert.svg, search.svg, styling.svg, translation.svg, upgrade.svg, user.svg, usermanager.svg or unknown-user.svg (ellipsis is too specific and cannot be customized). Note that header menu icons can't be customized as they come from DokuWiki core code.

:warning: POSSIBLE SVG NAMES LIST ABOVE NEEDS TO BE UPDATED :warning:

## Settings and their default value

Default value is generally what will keep the look closer to original Wordpress theme. 

* layout (*boxed*) : choose global site layout between `boxed` and `full-width` or a mix of both
  * `boxed` wastes a little space around content on narrow screens
  * `mix` aesthically ressembles `full-width` but is still limited to **style.ini** file's `site-width` value
  * `full-width` is incompatible with "scrollspy" ToC and will override that setting
  * `box2full` switches from `boxed` on large screens to `full-width` in lower resolutions 
* bodyBg (*color*) : select how HTML body background is filled
  * `color` : `background_site` value from **style.ini** file
  * `pattern` : `pattern.png` image from **tpl/spacious/images** folder or wiki namespace or current namespace (``must be correctly set through namespace CSS)
* topbar (*nothing*) : select topbar elements
  * `date` : just the server's current date based on `datelocale` and `longdatestring` settings
  * `newsticker` : dynamic list of last changes in current namespace and sub ones (elements listed depen on `newsTicker` setting)
  * `socialnetworks` : list of social networks links (see [Topbar social links](https://github.com/geekitude/dokuwiki-template-spacious#topbar-social-links) below)
* datelocale (*fra*) : language used for dates
* longdatestring (*%A %d %B %Y*) : how long date strings are built (typically with full day of week, ...), [see this page](https://www.php.net/manual/fr/function.strftime.php)
* shortdatestring (*%d/%m/%Y*) : how short and typically fully numeric dates are built, [see this page](https://www.php.net/manual/fr/function.strftime.php) too
* newsTicker (*skip_minors,pages,media,5*): options use to built last changes list
  * `skip_deleted` : ignore deleted items
  * `skip_minors` : ignore minor updates
  * `skip_subspaces` : only consider elements from current namespace, not sub-namespaces
  * `pages` : show or ignore pages in list
  * `media` : show or ignore media files
  * the number in text field is the number of elements to show (starting from most recent)
* sidebarPos (*left*) : sidebar position
* flipTools (*OFF*) : flip page and context tools positions
* headerLogo (*ON*) : enable header logo or not
* stickies (*nothing*) : [stick](https://www.w3schools.com/howto/howto_css_sticky_element.asp) given element to top of screen (or bottom, depending on position) 
  * `pageheader` : will keep page header in sight at any time when scrolling down
  * `sidebar` : it will stick to top then start to scroll to match main content length (unless it's longer than content)
  * `docInfo` : will stick to the bottom of page with it's opacity reduced untill the mouse hovers it
* bannerfile (*banner.jpg*) : name of file to look for as banner wich goes in top right of header)
* widebannerfile (*widebanner.jpg*) : name of file to look for as widebanner that sits right above page header
* nslogofile (*nslogo.jpg*) : name of file to look for as namespace logo that comes inside page header right befor page ID or title
* sidecardfile (*banner.jpg*) : name of file to look for as sidebar header
* sidecardstyle (*mediacenter*) : CSS alignment rule to apply to sidebar header image
* headertoolsIcons (*ON*) : use glyphs for header tools or not
* [ ] pageheaderTitle
* [ ] breadcrumbsStyle
* [ ] breadcrumbsGlyphs
* [ ] truncatebc
* siblings (*10*) : a new type of breadcrumbs that adds links to other pages of current namespace under other breadcrumbs (**requires [TwistieNav](https://www.dokuwiki.org/plugin:twistienav ) plugin**)
  * `0` : choosing a value of 0 simply disables this featuredisables that feature
  * `any other integer` : set the maximum number of links to show (if there's more, a glyph will propose a link to site map)
* `contools` (*parent,sidetoggle,playground,nsindex,savesettings,syntax*) : choose wich context tools are shown on the opposite side of page tools (see [next section](https://github.com/geekitude/dokuwiki-template-spacious#context-tools) for details)
* avatars (*wiki:avatars*) : namespace where users should store their avatar (filename should be *username*.jpg, png or gif)
* [ ] links
* licenseVisual (*badge*) : image shown in footer licence widget
  * `badge` : largest available image
  * `button` : small image of same size as small buttons at very bottom of page
  * `none` : obviously no image
* qrcodes (*editor_mailto,locked_mailto,license_link,onlineversion_link*) : select wich QRCodes to show (requires [QRCode2](https://www.dokuwiki.org/plugin:qrcode2) plugin)
  * `editor_mailto` : a mailto last editor link in "docInfo" area (small untill hover)
  * `locked_mailto` : a mailto user currently locking page link in "docInfo" area (small untill hover)
  * `locked_mailto` : a mailto user currently locking page link in "docInfo" area (small untill hover)
  * `license_link` : link to current wiki license (only shown when printing page)
  * `onlineversion_link` : link to current page (only shown when printing page)
* neutralize (*topbar,pageheader,footersocket*) : use **style.ini** neutral colors for selected elements (neutral colors will however be applied to extracted ToC and sidebar in *boxed* and *box2full* layouts)
* extractible (*nothing*) : extract those elements from main content to the sides when there's enough room
  * `sidebar` (right sidebar is not extractible even if it is selected here)
  * `toc` (extracted ToC can be given [scrollspy](https://www.jqueryscript.net/demo/fixed-table-contents-scrollspy/) super-powers)
* animate (*500*) : duration in ms of any animation 
* print (*siteheader,docinfo,sitefooter,hrefs*) : print selected elements or not (selecting "hrefs" prints links' URL as subscript)

## Context tools

These tools appear on opposite side of page tools and here are the different possible glyphs and corresponding actions (how the "contect tools" name implies, the availability of each tools depends on context).

### Parent

* ![Namespace start](/images/svg/folder-home.svg) Namespace start : go to current namespace start page from any random (ie. *not start*) page
* ![Parent namespace](/images/svg/reply-all.svg) Parent namespace : go to parent namespace start from any second or deeper level namespace start page
* ![Translated Wiki Home](/images/svg/flag.svg) Translated Wiki Home : go to translated wiki home from any second level translated page (requires [Translation](https://www.dokuwiki.org/plugin:translation) plugin)
* ![Wiki home](/images/svg/home.svg) Wiki home : go to wiki home from any first level namespace start page
* ![Back to article](/images/svg/skip-previous.svg) Previous page : go back to article after switching to *admin*, *index*, *media* or *recent* modes

### Sidetoggle

![Hide sidebar](/images/svg/eye-off.svg) Hide or ![Show sidebar](/images/svg/eye.svg) show sidebar.

### Syntax

![Syntax](/images/svg/lifebuoy.svg) Simple link to syntax page (only available in *edit* mode).

### Playground

![Go to playground](/images/svg/shovel.svg) Go to playground or ![Back from playground](/images/svg/shovel-off.svg) back to article from playground.

### Savesettings

![Save settings](/images/svg/floppy.svg) Save settings (only available on configuration manager page).

## Topbar social links

After enabling `socialnetworks` setting, copy `dokuwiki/lib/tpl/spacious/images/debug/social.local.conf` file to `dokuwiki/conf` folder and complete relevant urls. You can add new lines for social networks that are not in the list yet. Note that the name must be lower case and contain no special characters (spaces must be replaced by underscores). `my_network` is a valid example.

As for other SVG glyphs, you can put your own SVG files in `conf/svg` folder as long as it is named exactly like corresponding target network in configuration file.

:bulb: you can add `<title>` tag within your SVG files to add a custom tooltip on hover.

## Footer links widget

Create a page named `links` (or change name in Spacious settings) that contain a list of links that will be shown as a footer widget.

Check [this page](https://www.dokuwiki.org/tips:topbar) on how to build that page.

## HTML hooks

Spacious can be customized using HTML files that will be displayed at one of the many available include or replace hooks. Include hooks add some content while replace hooks take place of standard content.
To get started, copy the correspondig HTML file from `spacious/debug` folder to `spacious` folder and change it to your liking (don't forget to remove existing `*-hook-sample` class).

You can add `noprint` class to avoid the content to be printed.

### Include hooks

* *meta.html* : just before `</head>` tag (use this to add additional styles or metaheaders)
* *header.html* : right above everything (except [Skip to Content])
* *brandingfooter.html* : just below site-logo/title/banner section
* *bannerheader.html* : above banner
* *bannerfooter.html* : below banner
* *toolsheader.html* : above header tools area
* *toolsfooter.html* : below header tools area
* *headerfooter.html* : below site header (just before widebanner area)
* *mainheader.html* : above main content area
* *sidebarheader.html* : before sidebar content
* *pageheader.html* : above actual DW page content
* *sidebarfooter.html* : after sidebar content
* *pagefooter.html* : right before site footer, below actual DW page content
* *mainfooter.html* : below main content area
* *footerheader.html* : at the very end of the page just before the `</body>` tag
* *footerwidget.html* : included in footer widgets area (after other widgets)
* *footer.html* : at the very end of the page just before the `</body>` tag

### Replace hooks

These specific HTML hooks let you change some template elements with fancier HTML code of your own
* *sidebar.html* : replacement for sidebar page
* *title.html* : replace wiki title string with HTML element
* *tagline.html* : replace wiki description string with HTML element
* *banner.html* : replaces potential banner image with HTML element
* *widebanner.html* : replaces potential banner image with HTML element

## Plugins integration

### QRCode2

Can automatically add a few usefull QRCodes in footer (there's a setting to enable or disable each) :
* *editor_mailto* : mailto last editor in `docInfo` area
* *locked_mailto* : mailto user currently locking current page in `docInfo` area
* *license_link* : link to wiki's license's details page (only shows up when printing page)
* *onlineversion_link* : reach page's online version (a special hidden footer widget that only shows up when printing page)

### Translation

Available translations list is shown in a breadcrumbs like format under `pageId` element

### Twistienav

Adds a breacrumbs like list of sibling pages (other pages in current namespace)

### Userhomepage

Simply used as it should to build user page(s) links

### Other tested plugins

Imagebox, 

## About UI Images

### Background pattern

By default, the template uses `spacious/images/pattern.png` image as background pattern.
To use another one, simply upload a `pattern.png` image inside `wiki` namespace.

## About jQuery

Here's the list of features that will not work on browsers without Javascript abilities :
* Newsticker
* Context logo Lightbox effect
* Sidebar visibility context tool
* Sidebar and TOC auto-collapsing when reaching tablet resolution
* Inner links will scroll a bit too far if Page header is set to stick on top of page
* Animated scrolling

## Expanded debug mode

Debug mode is meant to show usually hidden elements and add many ugly colors to test some of template's settings or features.

To enable "full" debug mode, simply add `&debug=1` or `?debug=1` at the end of URL, depending of current wiki mode (ie use "&" if there's already a "?" in URL, else use "?").

You can also use some specific keyword values instead of boolean to show only a given element category (e.g. `&debug=include`). Here's a complete list of possible keywords : 'a11y' (visual accessibility helpers), 'alerts', 'avatar', 'banner', 'card' (sidebar namespace card image), 'images' (all UI images), 'include' (HTML include hooks), 'logo' (namespace logo within page header), 'replace' (HTML replace hooks), 'sitelogo'.

Note that HTML replace hooks are not shown in "full" debug mode but only if using `&debug=replace`.
