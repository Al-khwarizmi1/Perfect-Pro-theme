<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version !='1.5'){
   $params = &$this->item->params;
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h2>
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
	<ul class="actions">
		<?php if ($params->get('show_print_icon')) : ?>
		<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($params->get('show_email_icon')) : ?>
		<li class="email-icon">
			<?php echo JHtml::_('icon.email', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($canEdit) : ?>
		<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
		</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
 <dl class="article-info">
 <dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category')) : ?>
		<dd class="parent-category-name">
			<?php $title = $this->escape($this->item->parent_title);
				$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_parent_category')) : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
		<dd class="category-name">
			<?php $title = $this->escape($this->item->category_title);
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_category')) : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
		<dd class="create">
		<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
		<dd class="modified">
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published">
		<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<dd class="createdby">
		<?php $author =  $this->item->author; ?>
		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

			<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
				<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
				 JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>

			<?php else :?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
		</dd>
<?php endif; ?>
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) :?>
 	</dl>
<?php endif; ?>

<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
		<p class="readmore">
				<a href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>
<?php }else{ ?>
<?php $canEdit   = ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')); ?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>

<?php if ($this->item->params->get('show_title') || $this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon') || $canEdit) : ?>
<table class="contentpaneopen<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>">
<tr>
	<?php if ($this->item->params->get('show_title')) : ?>
	<h3 class="contentheader<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>" width="100%">
		<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
		<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h3>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_pdf_icon')) : ?>
	<td align="right" width="100%" class="buttonheading">
	<?php echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?>
	</td>
	<?php endif; ?>

	<?php if ( $this->item->params->get( 'show_print_icon' )) : ?>
	<td align="right" width="100%" class="buttonheading">
	<?php echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?>
	</td>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_email_icon')) : ?>
	<td align="right" width="100%" class="buttonheading">
	<?php echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?>
	</td>
	<?php endif; ?>
	   <?php if ($canEdit) : ?>
	   <td align="right" width="100%" class="buttonheading">
	   <?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
	   </td>
   <?php endif; ?>
</tr>
</table>
<?php endif; ?>
<?php  if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>
<?php echo $this->item->event->beforeDisplayContent; ?>
<table class="contentpaneopen<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>">
<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
<tr>
	<td>
		<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
		<span>
			<?php if ($this->item->params->get('link_section')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->item->section); ?>
			<?php if ($this->item->params->get('link_section')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
				<?php if ($this->item->params->get('show_category')) : ?>
				<?php echo ' - '; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		<?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
		<span>
			<?php if ($this->item->params->get('link_category')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->item->category); ?>
			<?php if ($this->item->params->get('link_category')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
	</td>
</tr>
<?php endif; ?>

<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
<tr>
	<td width="70%"  valign="top" colspan="2">
		<span class="small">
			<?php JText::printf( 'Written by', ($this->escape($this->item->created_by_alias) ? $this->escape($this->item->created_by_alias) : $this->escape($this->item->author)) ); ?>
		</span>
		&nbsp;&nbsp;
	</td>
</tr>
<?php endif; ?>

<?php if ($this->item->params->get('show_create_date')) : ?>
<tr>
	<td valign="top" colspan="2" class="createdate">
		<?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')); ?>
	</td>
</tr>
<?php endif; ?>

<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
<tr>
	<td valign="top" colspan="2">
		<a href="http://<?php echo $this->escape($this->item->urls) ; ?>" target="_blank">
			<?php echo $this->escape($this->item->urls); ?></a>
	</td>
</tr>
<?php endif; ?>

<tr>
<td valign="top" colspan="2">
<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<?php echo $this->item->text; ?>
</td>
</tr>

<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
<tr>
	<td colspan="2"  class="modifydate">
		<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</td>
</tr>
<?php endif; ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
<tr>
	<td  colspan="2">
		<a href="<?php echo $this->item->readmore_link; ?>" class="readon<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
			<?php if ($this->item->readmore_register) :
				echo JText::_('Register to read more...');
			elseif ($readmore = $this->item->params->get('readmore')) :
				echo $readmore;
			else :
				echo JText::sprintf('Read more...');
			endif; ?></a>
	</td>
</tr>
<?php endif; ?>

</table>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>
<span class="article_separator">&nbsp;</span>
<?php echo $this->item->event->afterDisplayContent; ?>
<?php } ?>
