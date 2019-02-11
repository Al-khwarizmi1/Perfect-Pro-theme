<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 29/06/2011
 * @Module      : mod_articlelist
 * @File        : default.php
 * @Description : Display the article list
 */
$app = JFactory::getApplication();
$templateName = $app->getTemplate();
?>

<?php
$i = 1;
foreach ($articleListfour as $item) {
?>
    <ul class="container1">
    <?php
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $item->introtext, $matches);
    $firstImg = ( isset($matches[1][0]) ) ? $matches[1][0] : '';
    ?>
    <h2><?php echo $item->title; ?></h2>
    <?php
    $contentText = $item->introtext;
    if ($firstImg) {
        $contentText = preg_replace("/<img[^>]+\>/i", "", $contentText);
        echo '<img src="' . JURI::Base() . $firstImg . '" alt="" title"" width="282"  height="78"/>';
        echo '<li>';
        echo (strlen($contentText) > 200) ? substr($contentText, 0, 200) . ' ...' : $contentText;
        echo '</li>';
    } else {
        echo '<li>';
        echo (strlen($contentText) > 200) ? substr($contentText, 0, 430) . ' ...' : $contentText;
        echo '</li>';
    }
    ?>
    <li class="more">
        <?php echo '<a href="index.php?option=com_content&view=article&id=' . $item->id . '">Learn More</a>'; ?></li>
</ul>
<?php
        $i++;
    }
?>
