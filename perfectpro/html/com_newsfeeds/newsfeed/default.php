<?php // no direct acces
defined('_JEXEC') or die('Restricted access');
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version !='1.5'){
$lang = JFactory::getLanguage();
$myrtl = $this->newsfeed->rtl;
$direction = " ";

if ($lang->isRTL() && $myrtl == 0) {
	$direction = " redirect-rtl";
} else
	if ($lang->isRTL() && $myrtl == 1) {
		$direction = " redirect-ltr";
	} else
		if ($lang->isRTL() && $myrtl == 2) {
			$direction = " redirect-rtl";
		} else
			if ($myrtl == 0) {
				$direction = " redirect-ltr";
			} else
				if ($myrtl == 1) {
					$direction = " redirect-ltr";
				} else
					if ($myrtl == 2) {
						$direction = " redirect-rtl";
					}
?>
<div class="newsfeed<?php echo $this->pageclass_sfx?><?php echo $direction; ?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1 class="<?php echo $direction; ?>">
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>
	<h2 class="<?php echo $direction; ?>">
		<a href="<?php echo $this->newsfeed->channel['link']; ?>" target="_blank">
			<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['title']); ?></a>
	</h2>

<!-- Show Description -->
<?php if ($this->params->get('show_feed_description')) : ?>
	<div class="feed-description">
		<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['description']); ?>
	</div>
<?php endif; ?>

<!-- Show Image -->
<?php if (isset($this->newsfeed->image['url']) && isset($this->newsfeed->image['title']) && $this->params->get('show_feed_image')) : ?>
<div>
		<img src="<?php echo $this->newsfeed->image['url']; ?>" alt="<?php echo $this->newsfeed->image['title']; ?>" />
</div>
<?php endif; ?>

<!-- Show items -->
<ol>
	<?php foreach ($this->newsfeed->items as $item) :  ?>
		<li>
			<?php if (!is_null($item->get_link())) : ?>
				<a href="<?php echo $item->get_link(); ?>" target="_blank">
					<?php echo $item->get_title(); ?></a>
			<?php endif; ?>
			<?php if ($this->params->get('show_item_description') && $item->get_description()) : ?>
				<div class="feed-item-description">
				<?php $text = $item->get_description();
				if($this->params->get('show_feed_image', 0) == 0)
				{
					$text = JFilterOutput::stripImages($text);
				}
				$text = JHTML::_('string.truncate', $text, $this->params->get('feed_character_count'));
					echo str_replace('&apos;', "'", $text);
				?>

				</div>
			<?php endif; ?>
			</li>
		<?php endforeach; ?>
		</ol>
</div>
<?php }else{ 
		$lang = &JFactory::getLanguage();
		$myrtl =$this->newsfeed->rtl;
		 if ($lang->isRTL() && $myrtl==0){
		   $direction= "direction:rtl !important;";
		   $align= "text-align:right !important;";
		   }
		 else if ($lang->isRTL() && $myrtl==1){
		   $direction= "direction:ltr !important;";
		   $align= "text-align:left !important;";
		   }
		  else if ($lang->isRTL() && $myrtl==2){
		   $direction= "direction:rtl !important;";
		   $align= "text-align:right !important;";
		   }

		else if ($myrtl==0) {
		$direction= "direction:ltr !important;";
		   $align= "text-align:left !important;";
		   }
		else if ($myrtl==1) {
		$direction= "direction:ltr !important;";
		   $align= "text-align:left !important;";
		   }
		else if ($myrtl==2) {
		   $direction= "direction:rtl !important;";
		   $align= "text-align:right !important;";
		   }

?>
<div style="<?php echo $direction; ?><?php echo $align; ?>">
<?php if ($this->params->get('show_page_title', 1)) : ?>
	<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>" ><?php echo $this->escape($this->params->get('page_title')); ?></h2>
<?php endif; ?>
<table width="100%" class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
<tr>
	<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>" >
		<a href="<?php echo $this->newsfeed->channel['link']; ?>" target="_blank">
			<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['title']); ?></a>
	</h2>
</tr>
<?php if ( $this->params->get( 'show_feed_description' ) ) : ?>
<tr>
	<td>
		<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['description']); ?>
		<br />
		<br />
	</td>
</tr>
<?php endif; ?>
<?php if ( isset($this->newsfeed->image['url']) && isset($this->newsfeed->image['title']) && $this->params->get( 'show_feed_image' ) ) : ?>
<tr>
	<td>
		<img src="<?php echo $this->newsfeed->image['url']; ?>" alt="<?php echo $this->newsfeed->image['title']; ?>" />
	</td>
</tr>
<?php endif; ?>
<tr>
	<td>
		<ul>
		<?php foreach ( $this->newsfeed->items as $item ) :  ?>
			<li>
			<?php if ( !is_null( $item->get_link() ) ) : ?>
				<a href="<?php echo $item->get_link(); ?>" target="_blank">
					<?php echo $item->get_title(); ?></a>
			<?php endif; ?>
			<?php if ( $this->params->get( 'show_item_description' ) && $item->get_description()) : ?>
				<br />
				<?php $text = $this->limitText($item->get_description(), $this->params->get( 'feed_word_count' ));
					echo str_replace('&apos;', "'", $text);
				?>
				<br />
				<br />
			<?php endif; ?>
			</li>
		<?php endforeach; ?>
		</ul>
	</td>
</tr>
</table>
</div>
<?php } ?>
