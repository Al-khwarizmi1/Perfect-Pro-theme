<?php

/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 29/06/2011
 * @Module      : mod_articlelist
 * @File        : helper.php
 * @Description : Database access
 */
class modList {

    function getListDetailsCountfour() {
        global $mainframe;
        $db    = &JFactory::getDBO();
        $query = "SELECT id,title,introtext "
                . "FROM #__content WHERE state=1 "
                . "ORDER BY id DESC LIMIT 2";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        return $result;
    }

}

?>
