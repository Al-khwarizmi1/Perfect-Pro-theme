<?php

/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 29/06/2011
 * @Module      : mod_articlelist
 * @File        : mod_articelist.php
 * @Description : Controller of article list module
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

global $mainframe;

//Include the model file
require_once(dirname(__FILE__) . DS . 'helper.php');

//Get the article details count four
$articleListfour = modList::getListDetailsCountfour();

//To display the html layout path
require(JModuleHelper::getLayoutPath('mod_articlelist'));
