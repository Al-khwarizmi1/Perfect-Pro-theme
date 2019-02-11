<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
if (!defined('modMainMenuXMLCallbackDefined')) {
    function modMainMenuXMLCallback(&$node, $args) {
        $user = &JFactory::getUser();
        $menu = &JSite::getMenu();
        $active = $menu->getActive();
        $path = isset($active) ? array_reverse($active->tree) : null;

        if (($args['end']) && ($node->attributes('level') >= $args['end'])) {
            $children = $node->children();
            foreach ($node->children() as $child) {
                if ($child->name() == 'ul') {
                    $node->removeChild($child);
                }
            }
        }
        if ($node->name() == 'ul') {
            foreach ($node->children() as $child) {
                if ($child->attributes('access') > $user->get('aid', 0)) {
                    $node->removeChild($child);
                }
            }
        }
        if (($node->name() == 'li') && isset($node->ul)) {
            $node->addAttribute('class', 'parent');
        }
        if (isset($path) && (in_array($node->attributes('id'), $path) || in_array($node->attributes('rel'), $path))) {
            if ($node->attributes('class')) {
                $node->addAttribute('class', $node->attributes('class') . ' active');
            } else {
                $node->addAttribute('class', 'active');
            }
        } else {
            if (isset($args['children']) && !$args['children']) {
                $children = $node->children();
                foreach ($node->children() as $child) {
                    if ($child->name() == 'ul') {
                        $node->removeChild($child);
                    }
                }
            }
        }
        if (($node->name() == 'li') && ($id = $node->attributes('id'))) {
            if ($node->attributes('class')) {
                $node->addAttribute('class', $node->attributes('class') . ' item' . $id);
            } else {
                $node->addAttribute('class', 'item' . $id);
            }
        }
        if (isset($path) && $node->attributes('id') == $path[0]) {
            $node->addAttribute('id', 'current');
        } else {
            $node->removeAttribute('id');
        }
        $node->removeAttribute('rel');
        $node->removeAttribute('level');
        $node->removeAttribute('access');
    }

    define('modMainMenuXMLCallbackDefined', true);
}
$callback = 'modMainMenuXMLCallback';
switch ($params->get('menu_style', 'list')) {
    case 'list_flat' :
        // Include the legacy library file
        echo '<div class="list-menu">';
        require_once(dirname(__FILE__) . DS . 'legacy.php');
        mosShowHFMenu($params, 1);
        echo '</div>';
        break;
    case 'horiz_flat' :
        // Include the legacy library file
        echo '<div class="horiz-menu">';
        require_once(dirname(__FILE__) . DS . 'legacy.php');
        mosShowHFMenu($params, 0);
        echo '</div>';
        break;
    case 'vert_indent' :
        // Include the legacy library file
        echo '<div class="vert-menu">';
        require_once(dirname(__FILE__) . DS . 'legacy.php');
        mosShowVIMenu($params);
        echo '</div>';
        break;
    default :
        // Include the new menu class
        echo '<div class="list-menu">';
        $xml = modMainMenuHelper::getXML($params->get('menutype'), $params, $callback);
        if ($xml) {
            $class = $params->get('class_sfx');
            $xml->addAttribute('class', 'menu' . $class);
            if ($tagId = $params->get('tag_id')) {
                $xml->addAttribute('id', $tagId);
            }

            $result = JFilterOutput::ampReplace($xml->toString((bool) $params->get('show_whitespace')));
            $result = str_replace(array('<ul/>', '<ul />'), '', $result);
            echo $result;
        }
        echo '</div>';
        break;
}
//modMainMenuHelper::render($params, 'modMainMenuXMLCallback');

