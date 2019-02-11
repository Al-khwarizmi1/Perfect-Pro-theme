<?php
/** $Id: default_address.php 12387 2009-06-30 01:17:44Z ian $ */
defined( '_JEXEC' ) or die( 'Restricted access' );
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version !='1.5'){
?>
<?php if (($this->params->get('address_check') > 0) &&  ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
	<div class="contact-address">
	<?php if ($this->params->get('address_check') > 0) : ?>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_address'); ?>
		</span>
		<address>
	<?php endif; ?>
	<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
		<span class="contact-street">
			<?php echo nl2br($this->contact->address); ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
		<span class="contact-suburb">
			<?php echo $this->contact->suburb; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
		<span class="contact-state">
			<?php echo $this->contact->state; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
		<span class="contact-postcode">
			<?php echo $this->contact->postcode; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
		<span class="contact-country">
			<?php echo $this->contact->country; ?>
		</span>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->params->get('address_check') > 0) : ?>
	</address>
	</div>
<?php endif; ?>

<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	<div class="contact-contactinfo">
<?php endif; ?>
<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_email'); ?>
		</span>
		<span class="contact-emailto">
			<?php echo $this->contact->email_to; ?>
		</span>
	</p>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_telephone'); ?>
		</span>
		<span class="contact-telephone">
			<?php echo nl2br($this->contact->telephone); ?>
		</span>
	</p>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_fax'); ?>
		</span>
		<span class="contact-fax">
		<?php echo nl2br($this->contact->fax); ?>
		</span>
	</p>
<?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_mobile'); ?>
		</span>
		<span class="contact-mobile">
			<?php echo nl2br($this->contact->mobile); ?>
		</span>
	</p>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
		</span>
		<span class="contact-webpage">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank">
			<?php echo $this->contact->webpage; ?></a>
		</span>
	</p>
<?php endif; ?>
<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	</div>
<?php endif; ?>
<?php }else{ ?>

<?php if ( ( $this->contact->params->get( 'address_check' ) > 0 ) &&  ( $this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode ) ) : ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<?php if ( $this->contact->params->get( 'address_check' ) > 0 ) : ?>
<tr>
	<td rowspan="6" valign="top" width="<?php echo $this->contact->params->get( 'column_width' ); ?>" >
		<?php echo $this->contact->params->get( 'marker_address' ); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->address && $this->contact->params->get( 'show_street_address' ) ) : ?>
<tr>
	<td valign="top">
		<?php echo nl2br($this->escape($this->contact->address)); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->suburb && $this->contact->params->get( 'show_suburb' ) ) : ?>
<tr>
	<td valign="top">
		<?php echo $this->escape($this->contact->suburb); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->state && $this->contact->params->get( 'show_state' ) ) : ?>
<tr>
	<td valign="top">
		<?php echo $this->escape($this->contact->state); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->postcode && $this->contact->params->get( 'show_postcode' ) ) : ?>
<tr>
	<td valign="top">
		<?php echo $this->escape($this->contact->postcode); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->country && $this->contact->params->get( 'show_country' ) ) : ?>
<tr>
	<td valign="top">
		<?php echo $this->escape($this->contact->country); ?>
	</td>
</tr>
<?php endif; ?>
</table>
<?php endif; ?>
<?php if ( ($this->contact->email_to && $this->contact->params->get( 'show_email' )) || 
			($this->contact->telephone && $this->contact->params->get( 'show_telephone' )) || 
			($this->contact->fax && $this->contact->params->get( 'show_fax' )) || 
			($this->contact->mobile && $this->contact->params->get( 'show_mobile' )) || 
			($this->contact->webpage && $this->contact->params->get( 'show_webpage' )) ) : ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<?php if ( $this->contact->email_to && $this->contact->params->get( 'show_email' ) ) : ?>
<tr>
	<td width="<?php echo $this->contact->params->get( 'column_width' ); ?>" >
		<?php echo $this->contact->params->get( 'marker_email' ); ?>
	</td>
	<td>
		<?php echo $this->contact->email_to; ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->telephone && $this->contact->params->get( 'show_telephone' ) ) : ?>
<tr>
	<td width="<?php echo $this->contact->params->get( 'column_width' ); ?>" >
		<?php echo $this->contact->params->get( 'marker_telephone' ); ?>
	</td>
	<td>
		<?php echo nl2br($this->escape($this->contact->telephone)); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->fax && $this->contact->params->get( 'show_fax' ) ) : ?>
<tr>
	<td width="<?php echo $this->contact->params->get( 'column_width' ); ?>" >
		<?php echo $this->contact->params->get( 'marker_fax' ); ?>
	</td>
	<td>
		<?php echo nl2br($this->escape($this->contact->fax)); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->mobile && $this->contact->params->get( 'show_mobile' ) ) :?>
<tr>
	<td width="<?php echo $this->contact->params->get( 'column_width' ); ?>" >
	<?php echo $this->contact->params->get( 'marker_mobile' ); ?>
	</td>
	<td>
		<?php echo nl2br($this->escape($this->contact->mobile)); ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->webpage && $this->contact->params->get( 'show_webpage' )) : ?>
<tr>
	<td width="<?php echo $this->contact->params->get( 'column_width' ); ?>" >
	</td>
	<td>
		<a href="<?php echo $this->escape($this->contact->webpage); ?>" target="_blank">
			<?php echo $this->escape($this->contact->webpage); ?></a>
	</td>
</tr>
<?php endif; ?>
</table>
<?php endif; ?>

<?php if ( $this->contact->misc && $this->contact->params->get( 'show_misc' ) ) : ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td width="<?php echo $this->contact->params->get( 'column_width' ); ?>" valign="top" >
		<?php echo $this->contact->params->get( 'marker_misc' ); ?>
	</td>
	<td>
		<?php echo nl2br($this->contact->misc); ?>
	</td>
</tr>
</table>

<?php endif; ?>
<?php } ?>
