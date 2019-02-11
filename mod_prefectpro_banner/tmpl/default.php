<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 12/07/2011
 * @Module      : mod_contus_bannerslider
 * @File        : default.php
 * @Description : To view the  contus_bannerslider module disign layout
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
$templateName = $app->getTemplate();
$doc =& JFactory::getDocument();
$path=JURI::base();
$doc->addScript($path."templates/perfectpro/js/jquery.cycle.min.js");
$doc->addScript($path."templates/perfectpro/js/jquery.cycle.all.min.js");
?>
<!-- Contus BannerSlider Module  start here -->

<?php if(count($banners)>0){?>
<div id="bannerwrapper"><div class="banner">
<script type="text/javascript">
    var jpb=jQuery.noConflict();
    jpb(document).ready(function() {
        jpb('.slideshow').after('<ul id="navbar">').cycle({
            fx      : '<?php echo $bannerEffect; ?>' , // choose your transition type, ex: fade, scrollUp, shuffle, etc...
            autostop: false,
            speed   : <?php echo $slideTimer; ?>,
            pager   : '#navbar',
            timeout : <?php echo $autoscroll; ?>,
            width   :<?php echo $width; ?>,
            height  :<?php echo $height; ?>,
            after: function(curElement, nextElement, options, forwardFlag) {
                curr     = options.currSlide;
                clickval = document.getElementById('clickurl'+curr).value;
                document.getElementById('learnmore').href = clickval;
             },
            pagerAnchorBuilder: function(idx, slide) {
                return '<li><a href=""></a></li>';
            }
        });
    });

</script>
<style type="text/css">
    #navbar{float:right;background:url('<?php echo JURI::Base() . 'templates/' . $templateName . '/images/navbg.png'; ?>' ) repeat;width:930px;height:37px; padding:17px 0px 0px 30px;}
    #navbar a {  background: url('<?php echo JURI::Base() . 'templates/' . $templateName . '/images/bulletdisplay.png'; ?>' ) no-repeat; position: absolute; left:0; top:0; text-decoration: none; width:54px;height:36px;margin:0px 5px 0px 5px; display: block; }
    #navbar a.activeSlide {height: 62px;top:-35px;left:-17px; z-index: 10;background: url('<?php echo JURI::Base() . 'templates/' . $templateName . '/images/activebg.png'; ?>' ) no-repeat ;padding-top:10px;width:54px;position:absolute; display: block;}
    #navbar a:focus { outline: none; }
    .slideshow { height: 307px; width:960px; margin: auto; }
    #navbar li{list-style: none;float:left; padding: 0 0px;position:relative;height:30px; width:65px; }
    #navbar li:first-child{margin:0px 0px 0px 0px; }
    .learnmore{float:right;padding:0px 13px 0px 0px;margin-top:-54px;z-index:1000;background:#0C597F url('<?php echo JURI::Base() . 'templates/' . $templateName . '/images/readmorebg.png'; ?>' ) repeat-x;height:54px;}
    .learnmore h1 a{float:left;text-decoration:none;font-family:'arial';color:white;font-weight:bold;font-size:15px;text-align:center;padding:18px;background:url('<?php echo JURI::Base() . 'templates/' . $templateName . '/images/arrow.png'; ?>' ) 100% 50% no-repeat ;}
    .shadow1{float:left;width:960px;background:url('<?php echo JURI::Base() . 'templates/' . $templateName . '/images/bannershadow.png'; ?>' ) no-repeat ;height:50px;}
    img.arrow{float:right;padding:0px 0px 0px 0px;}
    .learnmore h1 a:hover{text-decoration:underline;}
</style>
<div class="slideshow">
    <?php
     $inc = 0;
    foreach ($banners as $banner) {
       if($version !='1.5'){
           $imageurl = JURI::Base() . $banner->params->get('imageurl');
           $bannerId=$banner->id;
       }
       else{
           $imageurl = "images/banners/" . $banner->imageurl;
           $bannerId=$banner->bid;
       }
       $link     = JRoute::_('index.php?option=com_banners&task=click&id=' . $bannerId);
       // $banner_text = $banner->description;
        echo '<a><img src="' . $imageurl . '" width="' . $width . '" height="' . $height . '" border="0" alt=""/>';
        echo '<input type="hidden" name="clickurl" id="clickurl'.$inc.'" value="'.$banner->clickurl.'" /></a>';
        $inc++;
    }
    ?>
</div>
<div class="learnmore">
    <h1><?php echo '<a id="learnmore" href="" target="_blank" />LEARN MORE</a>'; ?></h1>
</div>
<div class="shadow1">
</div>
</div></div>
<?php } ?>