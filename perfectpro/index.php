<?php
//no direct access
defined('_JEXEC') or die('Restricted access');
if(version_compare(JVERSION,'1.7.0','ge')) {
    $positionFirst='position-1';
    $positionZero='position-0';
    $positionSix='position-6';
    $positionEleven='position-11';
    $positionFooter='footerload';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $positionFirst='position-1';
    $positionZero='position-0';
    $positionSix='position-6';
    $positionEleven='position-11';
    $positionFooter='footerload';
} else {
    $positionFirst='user3';
    $positionZero='user4';
    $positionSix='right';
    $positionEleven='user5';
    $positionFooter='footer';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <jdoc:include type="head" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/accordion.js" type="text/javascript"></script>
        <?php
        //Variable declaration for logo and follow us
        $logo = $this->params->get('logo');
        $cTitle = $this->params->get('title');
        $cDescription = $this->params->get('description');
        $facebookURL = $this->params->get('facebook_url');
        $twitterURL = $this->params->get('twitter_url');
        $flickrURL = $this->params->get('flickr_url');
        $gmailURL = $this->params->get('gmail_url');
        $facebookURL=isset($facebookURL)?$facebookURL:'';
        $twitterURL=isset($twitterURL)?$twitterURL:'';
        $flickrURL=isset($flickrURL)?$flickrURL:'';
        $gmailURL=isset($gmailURL)?$gmailURL:'';
        $folderPath = JPATH_SITE.DS.'modules'.DS.'mod_prefectpro_banner';
        $contusBanner = JFolder::exists($folderPath);
        $isEnable = ($contusBanner)?true:false;
        $classPosition=$this->countModules( $positionSix );
        ?>
    </head>
    <body onload="init()">
        <!--Header container starts here-->
        <div id="wrapper">
            <div class="header">
 <?php if (!empty($logo)) {
                    ?>
                        <h1 class="logo"><a href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl . '/' . $logo; ?>" alt="perfectpro12"  width="167" height="22" /></a></h1>
                    <?php } else {
                    ?>
                        <h1 class="logo"><a href="<?php echo $this->baseurl ?>" ><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png" alt="perfectpro12" width="167" height="22" /></a></h1>
                    <?php } ?>
              <!--  <h1 class="logo"><img src="images/logo.png" alt="perfectpro logo" width="167" height="22" /></h1>-->
                <div class="top_header">
                    <div class="navigation"><jdoc:include type="modules" name="<?php echo $positionFirst; ?>" /></div>
                    <div class="search_container"><jdoc:include type="modules" name="<?php echo $positionZero;?>" />
                    </div>
                </div>
            </div>
        </div>
        <!--Header container ends here-->
        <?php
                $app = &JFactory::getApplication();
                $messages = $app->getMessageQueue();
                if (!empty($messages)) {
        ?>
                    <div class="error_msgcontainer">
                        <div class="error_msgcontent">
                            <jdoc:include type="message" />
                        </div>
                    </div>
        <?php } ?>
        <?php
        $menu = JSite::getMenu();
        $option = JRequest::getVar('option');
        if ($menu->getActive() == $menu->getDefault() && $option != 'com_search') {
        ?>
        <!-- banner starts here -->
        <?php if($isEnable){ ?>
           <jdoc:include type="modules" name="perfect-banner" />
       <?php } ?>
        <!-- banner ends here -->
        <!-- slide_wrapper starts here -->
          <div id="slidewrapper">
              <div class="slidecontent">
                  <div class="slidecontentlist">
                     <jdoc:include type="modules" name="perfect-category"/>
                  </div>
              </div>
          </div>

         <!-- slide_wrapper ends here -->
          <!-- container starts here -->
            <div class="container">
            	<jdoc:include type="component" />
                <div class="content_container">
                    <jdoc:include type="modules" name="perfect-bottom" />
                </div>
                <div class="container_three">
                    <jdoc:include type="modules" name="<?php echo $positionEleven;?>" style="xhtml" />
                </div>
            </div>
          <!-- container ends here -->
        <?php } else {
        ?>   <!--Inner page container starts here-->
            <div id="textcontainer">
                <div class="textcontent">
                     <?php if($classPosition >0)
                                $newClass='content';
                           else
                                $newClass='contentblock';
                     ?>
                    <div class="<?php echo $newClass;?>">
                    <?php
                    $app = &JFactory::getApplication();
                    $messages = $app->getMessageQueue();
                    if (!empty($messages)) {
                    ?>
                      <?php } ?>
                        <?php if($newClass == 'contentblock'){
                            $width='919px';
                        }else{
                            $width='680px';
                        }?>
                    <div class="contentleft" style="width:<?php echo $width;?> !important;"><jdoc:include type="component" /></div>
                    <?php if($classPosition >0){ ?>
                        <div class="contentright"><jdoc:include type="modules" name="<?php echo $positionSix;?>" style="rightmodule"/></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
                <!--Inner page container ends here-->
                <!--Footer container starts here-->
                <div id="footer_wrapper">
                    <div class="footer_conatiner">
                        <div class="footer">
                            <jdoc:include type="modules" name="perfect-footermenu" style="footermenu" />
                            <?php if($facebookURL || $twitterURL || $flickrURL || $gmailURL){?>
                                <div class="social_network">
                                     <h3>Share with Us</h3>
                                     <ul class="network">
                                         <?php if($facebookURL){?>
                                            <li><a href="<?php echo $facebookURL; ?>" target="_blank" ><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/facebook.png"  alt="network" width="31" height="31" /></a></li>
                                         <?php }  if($twitterURL){?>
                                            <li><a href="<?php echo $twitterURL; ?>" target="_blank" ><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/twitter.png" alt="twitter" width="31" height="31" /></a></li>
                                          <?php } if($flickrURL){?>
                                            <li><a href="<?php echo $flickrURL; ?>" target="_blank" ><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/flickr.png" alt="flickr" width="31" height="31" /></a></li>
                                          <?php } if($gmailURL){ ?>
                                            <li><a href="<?php echo $gmailURL; ?>" target="_blank"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/mail.png" alt="gmail" width="31" height="31" /></a></li>
                                          <?php } ?>
                                     </ul>
                                </div>
                            <?php } ?>
                        </div>
                    <div class="copyright"><jdoc:include type="modules" name="<?php echo $positionFooter;?>" /></div>
                </div>
             </div>
        <!--Footer container ends here-->
    </body>
</html>