<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 12/07/2011
 * @Module      : mod_contus_bannerslider
 * @File        : categories.php
 * @Description : get the banner from categories of contus_bannerslider module
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementCategories extends JElement {
    var $_name = 'Categories';

    function fetchElement($name, $value, &$node, $control_name)
    {
        $db = &JFactory::getDBO();
        $section  = $node->attributes('section');
        $class    = $node->attributes('class');
        if (!$class) {
            $class = "inputbox";
        }
        if (!isset ($section)) {
            // alias for section
            $section = $node->attributes('scope');
            if (!isset ($section)) {
                $section = 'content';
            }
        }
        if ($section == 'content') {
                   
           $query = 'SELECT c.id AS value, CONCAT_WS( "/",s.title, c.title ) AS text' .
                    ' FROM #__categories AS c' .
                    ' LEFT JOIN #__sections AS s ON s.id=c.section' .
                    ' WHERE c.published = 1' .
                    ' AND s.scope = '.$db->Quote($section).
                    ' ORDER BY s.title, c.title';
        } else {
           $query = 'SELECT c.id AS value, c.title AS text' .
                    ' FROM #__categories AS c' .
                    ' WHERE c.published = 1' .
                    ' AND c.section = '.$db->Quote($section).
                    ' ORDER BY c.title';
        }
        $db->setQuery($query);
        $options = $db->loadObjectList();

        return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]',
                      'class="inputbox" 
                       size="5"
                       multiple="multiple"',
                      'value', 'text', $value, $control_name.$name);
    }
}
?>