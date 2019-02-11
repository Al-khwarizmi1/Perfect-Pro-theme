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
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
?>
<div class="categories-list<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>

	<?php if ($this->params->get('show_base_description')) : ?>
	<?php 	//If there is a description in the menu parameters use that; ?>
	       		<?php if($this->params->get('categories_description')) : ?>
		 <div class="category-desc base-desc">
			<?php echo  JHtml::_('content.prepare',$this->params->get('categories_description')); ?>
			</div>
		<?php  else: ?>
			<?php //Otherwise get one from the database if it exists. ?>
			<?php  if ($this->parent->description) : ?>
				<div class="category-desc  base-desc">
					<?php  echo JHtml::_('content.prepare', $this->parent->description); ?>
				</div>
			<?php  endif; ?>
		<?php  endif; ?>
	<?php endif; ?>
<?php
echo $this->loadTemplate('items');
?>
</div>
<?php }else{ ?>
<?php if ( $this->params->get( 'show_page_title', 1 ) ) : ?>
	<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h2>
<?php endif; ?>

<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
<?php if ( ($this->params->get('image') != -1) || $this->params->get('show_comp_description') ) : ?>
<tr>
	<td valign="top" class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php
		if ( isset($this->image) ) :  echo $this->image; endif;
		echo $this->escape($this->params->get('comp_description'));
	?>
	</td>
</tr>
<?php endif; ?>
</table>
<ul>
<?php foreach ( $this->categories as $category ) : ?>
	<li>
		<a href="<?php echo $category->link ?>" class="category<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($category->title);?></a>
		<?php if ( $this->params->get( 'show_cat_items' ) ) : ?>
		&nbsp;
		<span class="small">
			(<?php echo $category->numlinks;?>)
		</span>
		<?php endif; ?>
		<?php if ( $this->params->get( 'show_cat_description' ) && $category->description ) : ?>
		<br />
		<?php echo $category->description; ?>
		<?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>
