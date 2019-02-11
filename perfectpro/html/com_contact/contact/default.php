<?php
/**
 * $Id: default.php 11917 2009-05-29 19:37:05Z ian $
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version !='1.5'){
    $cparams = JComponentHelper::getParams ('com_media');
?>
<div class="contact<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>
	<?php if ($this->contact->name && $this->params->get('show_name')) : ?>
		<h2>
			<span class="contact-name"><?php echo $this->contact->name; ?></span>
		</h2>
	<?php endif;  ?>
	<?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
		<h3>
			<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
		</h3>
	<?php endif; ?>
	<?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
		<h3>
			<span class="contact-category"><a href="<?php echo $contactLink; ?>">
				<?php echo $this->escape($this->contact->category_title); ?></a>
			</span>
		</h3>
	<?php endif; ?>
	<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
		<form action="#" method="get" name="selectForm" id="selectForm">
			<?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>:
			<?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
		</form>
	<?php endif; ?>
	<?php  if ($this->params->get('presentation_style')!='plain'){?>
		<?php  echo  JHtml::_($this->params->get('presentation_style').'.start', 'contact-slider'); ?>
	<?php  echo JHtml::_($this->params->get('presentation_style').'.panel',JText::_('COM_CONTACT_DETAILS'), 'basic-details'); } ?>
	<?php if ($this->params->get('presentation_style')=='plain'):?>
		<?php  echo '<h3>'. JText::_('COM_CONTACT_DETAILS').'</h3>';  ?>
	<?php endif; ?>
	<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
		<div class="contact-image">
			<?php echo JHTML::_('image',$this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
		<p class="contact-position"><?php echo $this->contact->con_position; ?></p>
	<?php endif; ?>

	<?php echo $this->loadTemplate('address'); ?>

	<?php if ($this->params->get('allow_vcard')) :	?>
		<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
			<a href="<?php echo JURI::base(); ?>index.php?option=com_contact&amp;view=contact&amp;id=<?php echo $this->contact->id; ?>&amp;format=vcf">
				<?php echo JText::_('COM_CONTACT_VCARD');?></a>
	<?php endif; ?>
	<p></p>
	<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>

		<?php if ($this->params->get('presentation_style')!='plain'):?>
			<?php  echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form');  ?>
		<?php endif; ?>
		<?php if ($this->params->get('presentation_style')=='plain'):?>
			<?php  echo '<h3>'. JText::_('COM_CONTACT_EMAIL_FORM').'</h3>';  ?>
		<?php endif; ?>
		<?php  echo $this->loadTemplate('form');  ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_links')) : ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<?php if ($this->params->get('presentation_style')!='plain'):?>
			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
			<?php endif; ?>
			<?php if  ($this->params->get('presentation_style')=='plain'):?>
			<?php echo '<h3>'. JText::_('JGLOBAL_ARTICLES').'</h3>'; ?>
			<?php endif; ?>
			<?php echo $this->loadTemplate('articles'); ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<?php if ($this->params->get('presentation_style')!='plain'):?>
			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
		<?php endif; ?>
		<?php if ($this->params->get('presentation_style')=='plain'):?>
			<?php echo '<h3>'. JText::_('COM_CONTACT_PROFILE').'</h3>'; ?>
		<?php endif; ?>
		<?php echo $this->loadTemplate('profile'); ?>
	<?php endif; ?>
	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
		<?php if ($this->params->get('presentation_style')!='plain'){?>
			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc');} ?>
		<?php if ($this->params->get('presentation_style')=='plain'):?>
			<?php echo '<h3>'. JText::_('COM_CONTACT_OTHER_INFORMATION').'</h3>'; ?>
		<?php endif; ?>
				<div class="contact-miscinfo">
					<div class="<?php echo $this->params->get('marker_class'); ?>">
						<?php echo $this->params->get('marker_misc'); ?>
					</div>
					<div class="contact-misc">
						<?php echo $this->contact->misc; ?>
					</div>
				</div>
	<?php endif; ?>
	<?php if ($this->params->get('presentation_style')!='plain'){?>
			<?php echo JHtml::_($this->params->get('presentation_style').'.end');} ?>
</div>
<?php }else{
$app = JFactory::getApplication();
$templateName = $app->getTemplate();
$cparams = JComponentHelper::getParams ('com_media');
?>
<?php if ( $this->params->get( 'show_page_title', 1 ) && !$this->contact->params->get( 'popup' ) && $this->params->get('page_title') != $this->contact->name ) : ?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->params->get( 'page_title' ); ?>
	</div>
<?php endif; ?>
<div id="component-contact">
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
<?php if ( $this->params->get( 'show_contact_list' ) && count( $this->contacts ) > 1) : ?>
<tr>
	<td colspan="2" align="center">
		<br />
		<form action="<?php echo JRoute::_('index.php') ?>" method="post" name="selectForm" id="selectForm">
		<?php echo JText::_( 'Select Contact' ); ?>:
			<br />
			<?php echo JHTML::_('select.genericlist',  $this->contacts, 'contact_id', 'class="inputbox" onchange="this.form.submit()"', 'id', 'name', $this->contact->id);?>
			<input type="hidden" name="option" value="com_contact" />
		</form>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->name && $this->contact->params->get( 'show_name' ) ) : ?>
<!--<tr>
	<td width="100%" class="contentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->contact->name); ?>
	</td>
</tr>-->
<?php endif; ?>
<?php if ( $this->contact->con_position && $this->contact->params->get( 'show_position' ) ) : ?>
<!--<tr>
	<td colspan="2">
	<?php echo $this->escape($this->contact->con_position); ?>
		
	</td>
</tr>-->
<?php endif; ?>
<!--<tr>
	<td>
                <table border="0" width="100%">
		<tr>
			<td></td>
			<td rowspan="2" align="right" valign="top">
			<?php if ( $this->contact->image && $this->contact->params->get( 'show_image' ) ) : ?>
				<div style="float: right;">
					<?php echo JHTML::_('image', 'images/stories' . '/'.$this->contact->image, JText::_( 'Contact' ), array('align' => 'middle')); ?>
				</div>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->loadTemplate('address'); ?>
			</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
</tr>-->
<?php if ( $this->contact->params->get( 'allow_vcard' ) ) : ?>
<tr>
	<td colspan="2">
	<?php echo JText::_( 'Download information as a' );?>
		<a href="<?php echo JURI::base(); ?>index.php?option=com_contact&amp;task=vcard&amp;contact_id=<?php echo $this->contact->id; ?>&amp;format=raw&amp;tmpl=component">
			<?php echo JText::_( 'VCard' );?></a>
	</td>
</tr>
<?php endif;
if ( $this->contact->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id))
	echo $this->loadTemplate('form');
?>
</table>
</div>
<?php } ?>
