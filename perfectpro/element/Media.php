<?php

defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');

/**
 * Form Field class for the Media.
 */
class JElementMedia extends JElement {

    var $_name = 'Media';

    function fetchElement($name, $value, &$node, $control_name) {

        //Create new directory for Logo images.
        $dirPath = JPATH_SITE . '/images/stories/logoimages';
        $onClickEvnt = "document.getElementById('logo').value=''";
        $folder = "logoimages";
        
         If (!file_exists($dirPath)) {
            mkdir($dirPath);
        }
        JHtml::_('behavior.modal');
        // Build the script.        

        $script = array();
        $script[] = '  function jInsertEditorText(value,id) {  ';
        $script[] = '  src =value.match(/src="([^\"]*)"/)[1]; ';
        $script[] = '  var old_id = document.getElementById(id).value;';
        $script[] = '  if (old_id != id) {';
        $script[] = '  document.getElementById(id).value = src;';
        $script[] = '	}}';
        // Add the script to the document head.
        JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

        // Initialize variables.
        $html = array();

        // The text field.
        $html[] = '<div class="fltlft button2-left">';
        $html[] = '<input type="text" size="30" style="height:18px;" name="params[logo]" id="logo" value="' . $value . '" readonly="readonly"/>';
        $html[] = '</div>';

        // The button.
        $html[] = '<div class="button2-left">';
        $html[] = '<div class="blank">';
        $html[] = '<a class="modal" title="' . JText::_('Select') . '"' .
                ' href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=logo&amp;folder=' . $folder . '"' .
                ' rel="{handler: \'iframe\', size: {x: 800, y: 500}}">';
        $html[] = '' . JText::_('Select') . '</a>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '<div class="button2-left">';
        $html[] = '<div class="blank" >';
        $html[] = '<a  title="' . JText::_('Clear') . '" onclick="document.getElementById(\'logo\').value=\'\'">'.JText::_('Clear').'</a>';
        $html[] = '</div>';
        $html[] = '</div>';
        return implode("\n", $html);
    }

}