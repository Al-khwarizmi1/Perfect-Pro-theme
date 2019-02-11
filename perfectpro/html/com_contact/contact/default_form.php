<?php
/** $Id: default_form.php 11917 2009-05-29 19:37:05Z ian $ */
defined( '_JEXEC' ) or die( 'Restricted access' );
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version !='1.5'){

    JHtml::_('behavior.keepalive');
	$script = '
		function validateForm(frm) {
			var valid = document.formvalidator.isValid(frm);
			if (valid == false) {
				// do field validation
				if (frm.email.invalid) {
					alert("' . JText::_('COM_CONTACT_CONTACT_ENTER_VALID_EMAIL', true) . '");
				} else if (frm.text.invalid) {
					alert("' . JText::_('COM_CONTACT_FORM_NC', true) . '");
				}
				return false;
			} else {
				frm.submit();
			}
		}';
	$document = JFactory::getDocument();
	$document->addScriptDeclaration($script); ?>

<?php if (isset($this->error)) : ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>

<div class="contact-form">
	<form action="<?php echo JRoute::_('index.php');?>" method="post" name="emailForm" id="emailForm" class="form-validate">
		<p class="form-required">
			<?php echo JText::_('COM_CONTACT_CONTACT_REQUIRED');?>
		</p>
		<div class="contact-email">
			<div>
				<label for="contact-formname">
					<?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_NAME');?>
				</label>
				<input type="text" name="name" id="contact-formname" size="30" class="inputbox" value="" />
			</div>
			<div>
				<label id="contact-emailmsg" for="contact-email">
					<?php echo JText::_('JGLOBAL_EMAIL');?>*
				</label>
				<input type="text" id="contact-email" name="email" size="30" value="" class="inputbox required validate-email" maxlength="100" />
			</div>
			<div>
				<label for="contact-subject">
					<?php echo JText::_('COM_CONTACT_CONTACT_MESSAGE_SUBJECT');?>:
				</label>
				<input type="text" name="subject" id="contact-subject" size="30" class="inputbox" value="" />
			</div>
			<div>
				<label id="contact-textmsg" for="contact-text">
					<?php echo JText::_('COM_CONTACT_CONTACT_ENTER_MESSAGE');?>:
				</label>
				<textarea cols="50" rows="10" name="text" id="contact-text" class="inputbox required"></textarea>
			</div>

			<?php if ($this->params->get('show_email_copy')) : ?>
			<div>
				<input type="checkbox" name="email_copy" id="contact-email-copy" value="1"  />
				<label for="contact-email-copy">
					<?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_A_COPY'); ?>
				</label>
			</div>
			<?php endif; ?>
			<div>
				<button class="button validate" type="submit"><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
			</div>
			<input type="hidden" name="option" value="com_contact" />
			<input type="hidden" name="view" value="contact" />
			<input type="hidden" name="id" value="<?php echo $this->contact->id; ?>" />
			<input type="hidden" name="task" value="contact.submit" />
			<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
<?php }else{
$app = JFactory::getApplication();
$templateName = $app->getTemplate();
	$script = '<!--
		function validateForm( frm ) {
			var valid = document.formvalidator.isValid(frm);
			if (valid == false) {
				// do field validation
				if (frm.email.invalid) {
					alert( "' . JText::_( 'Please enter a valid e-mail address.', true ) . '" );
				} else if (frm.text.invalid) {
					alert( "' . JText::_( 'CONTACT_FORM_NC', true ) . '" );
				}
				return false;
			} else {
				frm.submit();
			}
		}
		// -->';
	$document =& JFactory::getDocument();
	$document->addScriptDeclaration($script);
	
	if(isset($this->error)) : ?>
<tr>
	<td><?php echo $this->error; ?></td>
</tr>
<?php endif; ?>
<tr>
	<td colspan="2">
	 <h2 class="contentheading">Contact Us</h2>
	<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="emailForm" id="emailForm" class="form-validate   contactform">
           
               <div class="contact_email<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
                   <?php echo '<img src="'.JURI::Base().'templates/'.$templateName.'/images/contact.png" alt="contact" class="contactimage" title="contact" width="150" height="140"/>';?>
                       <label for="contact_name">
				&nbsp;<?php echo JText::_( 'Enter your name' );?>:
			</label> 
			<br />
                        
			<input type="text" name="name" id="contact_name" size="30" class="inputbox" value="" />
			<br />
			<label id="contact_emailmsg" for="contact_email">
				&nbsp;<?php echo JText::_( 'Email address' );?>:
			</label>
			<br />
			<input type="text" id="contact_email" name="email" size="30" value="" class="inputbox required validate-email" maxlength="100" />
			<br />
			<label for="contact_subject">
				&nbsp;<?php echo JText::_( 'Message subject' );?>:
			</label>
			<br />
			<input type="text" name="subject" id="contact_subject" size="30" class="inputbox" value="" />
			<br />
			<label id="contact_textmsg" for="contact_text">
				&nbsp;<?php echo JText::_( 'Enter your message' );?>:
			</label>
			<br />
			<textarea cols="50" rows="10" name="text" id="contact_text" class="inputbox required"></textarea>
			<?php if ($this->contact->params->get( 'show_email_copy' )) : ?>
			<br />
				<input type="checkbox" name="email_copy" id="contact_email_copy" value="1"  />
				<label for="contact_email_copy">
					<?php echo JText::_( 'EMAIL_A_COPY' ); ?>
				</label>
			<?php endif; ?>
			<br />
			<br />
			<button class="button validate" type="submit"><?php echo JText::_('Send'); ?></button>
		</div>

	<input type="hidden" name="option" value="com_contact" />
	<input type="hidden" name="view" value="contact" />
	<input type="hidden" name="id" value="<?php echo $this->contact->id; ?>" />
	<input type="hidden" name="task" value="submit" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<br />
	</td>
</tr>
<?php } ?>
