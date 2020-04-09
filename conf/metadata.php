<?php
/**
 * DokuWiki Spacious Template
 * Original Wordpress Theme URI: https://themegrill.com/themes/spacious
 * 
 * @link    https://www.dokuwiki.org/template:spacious
 * @author  Simon DELAGE <sdelage@gmail.com>
 * @license GPL 3 (https://www.gnu.org/licenses/gpl-3.0.html)
 * 
 * Configuration metadata
 */

$meta['layout']             = array('multichoice','_choices' => array('boxed','full-width')); /* boxed or not page layout */
$meta['dark']               = array('onoff'); /* dark color scheme or not */
$meta['bodyBg']             = array('multichoice','_choices' => array('pattern','color')); /* fill site background with pattern or color */
$meta['topbar']             = array('multicheckbox','_choices' => array('date','newsticker','socialnetworks'));
