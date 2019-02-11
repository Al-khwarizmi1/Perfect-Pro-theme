<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 12/07/2011
 * @Module      : mod_contus_bannerslider
 * @File        : clients.php
 * @Description : get the banner from bannerclient of contus_bannerslider module
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementClients extends JElement {
    var $_name = 'Clients';

    function fetchElement($name, $value, &$node, $control_name)
    {
        $db    = &JFactory::getDBO();
        $class = $node->attributes('class');
        if (!$class) {
            $class = "inputbox";
        }

        $query = 'SELECT c.cid AS value, c.name AS text' .
                 ' FROM #__bannerclient AS c' .
                 ' ORDER BY c.name';
        $db->setQuery($query);
        $options = $db->loadObjectList();
        return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]',
                      'class="inputbox" size="5" multiple="multiple"',
                      'value', 'text', $value, $control_name.$name);
    }
}
?>