<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 12/07/2011
 * @Module      : mod_contus_bannerslider
 * @File        : mod_contus_bannerslider.php
 * @Description : Controller of contus_bannerslider module
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).DS.'helper.php' );
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}

if($version !='1.5'){
    global  $mainframe;
    require_once JPATH_ROOT . '/administrator/components/com_banners/helpers/banners.php';
    BannersHelper::updateReset();
    $banners = modBannerSliderHelper::getparams( $params );
}else{
    global $mosConfig_offset, $mosConfig_live_site, $mosConfig_locale, $mainframe;
    $banners = modBannerSliderHelper::getparamsJ15( $params );
}
    //Get  params values
    $slideTimer 	 = intval( $params->get( 'slideTimer', 600 ) );
    $autoscroll 	 = trim( $params->get( 'autoscroll', 1 ) );
    $bannerEffect    = $params->get('bannerEffect','scrollHorz');
    $width           = $params->get('width',960);
    $height          = $params->get('height',300);
//To display the html layout path
require(JModuleHelper::getLayoutPath('mod_prefectpro_banner'));
