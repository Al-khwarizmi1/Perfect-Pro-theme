<?php
/**
 * @Author      : Venkatesan
 * Author E-mail: venkatesan.ravi@contus.in
 * Creation Date: 12/07/2011
 * @Module      : mod_contus_bannerslider
 * @File        : default.php
 * @Description : To view the  contus_bannerslider module disign layout
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

class modBannerSliderHelper {

    function getparams($params) {
      jimport('joomla.application.component.model');
		JModel::addIncludePath(JPATH_ROOT.'/components/com_banners/models');
		$document	= JFactory::getDocument();
		$app		= JFactory::getApplication();
		
		$model = JModel::getInstance('Banners','BannersModel',array('ignore_request'=>true));
		$model->setState('filter.client_id', (int) $params->get('banner_clientid'));
		$model->setState('filter.category_id', $params->get('categories_id', array()));
		$model->setState('list.limit', (int) $params->get('banner_limit', 1));
		$model->setState('list.start', 0);
		$model->setState('filter.ordering', $params->get('ordering'));
		$model->setState('filter.language', $app->getLanguageFilter());

		$banners = $model->getItems();
		$model->impress();

		return $banners;
	}


        function getparamsJ15($params) {
        $client_id = $params->get('banner_clientid', '');
        $bannerLimit = $params->get('banner_limit', '');
        $categories_id = $params->get('categories_id');
        $ordering = trim($params->get('ordering', '0'));
        $where = '';
        $limit = '';
        $banner = null;
        if ($client_id != '') {
            $where = "\n AND cid IN ( " . (is_array($client_id) ? implode(',', $client_id) : $client_id) . " )";
        }
        if ($bannerLimit != '') {
            $limit = "\n LIMIT $bannerLimit";
        }
        if ($categories_id) {
            if (is_array($categories_id)) {
                $where .= "\n AND catid IN ( " . implode(',', $categories_id) . " )";
            } else {
                $where .= "\n AND catid = " . $categories_id . " ";
            }
        }
        if ('random' == $ordering) {
            $order = "\n ORDER BY RAND()";
        } else {
            $order = "\n ORDER BY ordering";
        }
        $db = & JFactory::getDBO();
        $query = "SELECT *"
                . "\n FROM #__banner"
                . "\n WHERE showBanner=1 "
                . $where
                . $order
                . $limit;
        $db->setQuery($query);
        $banners = $db->loadObjectList();
        return $banners;
    }

}