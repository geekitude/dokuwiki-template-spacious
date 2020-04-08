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

Spacious Wordpress theme (https://themegrill.com/themes/spacious/) ported to DokuWiki using [this guide](https://www.dokuwiki.org/devel:wp_to_dw_template)

    See template.info.txt for template details
    Spacious is distributed under the terms of the GNU GPL V3 (see LICENSE file or [this link](https://www.gnu.org/licenses/gpl-3.0.html) for details)

The result is a "namespace-aware" and polymorphic template that can be as sleek and straightforward as it's original Wordpress parent or more modern with extratible sidebar and/or TOC and potentially sticky elements.

*Version of Spacious Wordpress theme used as base for this project : 1.7.1 (2020-02-19)*

Since Dokuwiki's Starter template is too outdated for my development skill, mainly [because of new menus](https://github.com/selfthinker/dokuwiki_template_starter/issues/14), I started with a lightened version of Dokuwiki's default template.

## Conversion TODO

* [ ] Basic HTML/PHP
  * [x] Meta elements
  * [ ] Site containers
  * [ ] Header
  * [ ] Content area
  * [ ] Footer
  * [ ] Sidebar
  * [ ] WP vs. DW functions
* [ ] Basic CSS
  * [ ] style.css
  * [ ] rtl.css
  * [ ] print.css
  * [ ] Necessary changes
* [ ] JS
* [ ] Further HTML/PHP
  * [ ] Other layouts
  * [ ] Special DW elements
  * [ ] Other actions
* [ ] Further CSS
  * [ ] style.ini
  * [ ] WP vs. DW classes
* [ ] Rename IDs
* [ ] Support specific custom WP theme functionality
  * [ ] Custom colours
  * [ ] Custom background

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

* [ ] Namespace dependent CSS placeholders (for colors and fonts)
* [ ] Namespace dependent UI images (background pattern, logo, banner, widebanner and a potential sidebar header)
* [ ] Google Fonts : each of main text, headings, condensed text (mostly nav bar) and monospaced text (```code``` syntax) can use a different Google font (be warned that main text font should be kept very readable)
* [ ] Can have a "scrollspy" ToC on wide screen
* [ ] Wide banner slider with latest changes at wiki home?
* [ ] Sub namespaces list based on [Twistienav](https://www.dokuwiki.org/plugin:twistienav) plugin?
* [ ] Test most common plugins

## Main features

* [ ] Topbar with date, newsticker (based on current namespace and sub content) and social links
* [ ] Easy to customize glyphs(*) (from [Material Design Icons](https://materialdesignicons.com/) like other DW's SVG glyphs or [IcoMoon](https://icomoon.io/) for social links)
* [ ] Sidebar and ToC can be moved out of page content on wide screen (only works in boxed layout)
* [ ] Hidable sidebar
* [ ] Stickable pageheader, sidebar and docinfo
* [ ] Dynamic navigation button (current NS home, parent NS start, home or "back to article")
* [ ] Dark color scheme
* [ ] High number of HTML [this document](https://www.dokuwiki.org/include_hooks)
* [ ] A few HTML replace hooks that let you replace some elements with more fancy HTML code
* [ ] Siblings based on [Twistienav](https://www.dokuwiki.org/plugin:twistienav) plugin (a breadcrumbs like list of other pages in current namespace)
* [ ] Can add Namespace based CSS stylesheet
* [ ] Expanded debug mode to show some specific elements (sample code or images)
  * [ ] *a11y* (visual accessibility helpers)
  * [ ] *alerts*
  * [ ] *banner*
  * [ ] *card* (sidebar namespace card image)
  * [ ] *conlogo* (namespace logo within page header aka context logo)
  * [ ] *images* (all UI images)
  * [ ] *include* (HTML include hooks)
  * [ ] *logo*
  * [ ] *replace* (HTML replace hooks)
