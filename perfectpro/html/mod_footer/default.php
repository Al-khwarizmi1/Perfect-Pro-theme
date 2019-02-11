<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_footer
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version !='1.5'){
?>
<div class="copyright<?php echo $moduleclass_sfx ?>">
    Theme designed by <a href="http://www.apptha.com/joomla" target="_blank">Apptha Themes</a>
</div>
<?php }else{ ?>
<div class="copyright">
    Theme designed by <a href="http://www.apptha.com/joomla" target="_blank">Apptha Themes</a>
</div>
<?php } ?>