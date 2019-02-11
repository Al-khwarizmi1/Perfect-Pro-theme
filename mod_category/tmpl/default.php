<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 29/06/2011
 * @Module      : mod_categoryList
 * @File        : default.php
 * @Description : Display the categoryList t
 */
$app = JFactory::getApplication();
$templateName = $app->getTemplate();
?>


<?php

foreach ($categoryList as $item) {
?>
    <ul>
        <li><h2><a href="index.php?option=com_content&view=categories&id=<?php echo $item->id ;?>" target="_blank" ><?php echo $item->title; ?></a></h2></li>
     <?php
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $item->description, $matches);
  $firstImg = ( isset($matches[1][0]) ) ? $matches[1][0] : '';
    ?>    
    <li class="moretext" >
      <?php  if (!empty($firstImg)) {
                    ?>
        <?php echo '<a href="index.php?option=com_content&view=categories&id=' . $item->id . '" target="_blank">  <img src="' . JURI::root() .$firstImg. '" alt="" title"" width="292"  height="105" /></a>'; ?>

     <?php } else {
                    ?>
              <?php echo '<a href="index.php?option=com_content&view=categories&id=' . $item->id . '" target="_blank"> <img src="' . JURI::root() .'modules/mod_category/tmpl/images/no-image.jpg" alt="No image" title="No image" width="292"  height="105" /></a>';?></li>
                    <?php } ?>
    </ul>
<?php
     
    }
?>


