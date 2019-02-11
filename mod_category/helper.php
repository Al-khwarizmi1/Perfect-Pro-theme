<?php

/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 29/06/2011
 * @Module      : mod_articlelist
 * @File        : helper.php
 * @Description : Database access
 */
class modListcat {

    function getcatListDetails() {
        global $mainframe;
        $db    = &JFactory::getDBO();
        $query = "SELECT id,title,description "
                . "FROM #__categories WHERE published=1 "
                . "ORDER BY id DESC LIMIT 3";
        $db->setQuery($query);
        $result = $db->loadObjectList();  
         return $result;
    }
}

?>
