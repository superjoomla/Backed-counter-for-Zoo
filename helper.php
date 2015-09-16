<?php

/**
 * @package   SJ ZOO Counter
 * @author    Adam Bako
 * @copyright Copyright (C) SuperJoomla.com
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class SJ_zoo_backend_counter_helper {
    /**
     * @return mixed
     */
public static function SJ_zoo_backend_counter ()
{
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);

    $query = "select a.id, count(i.id) as all_items, a.name,  SUM(i.state = '1') published, SUM(i.state = '0') unpublished"
        . " FROM #__zoo_item as i"
        . " JOIN #__zoo_application a ON a.id = i.application_id"
        . " group by i.application_id"
        . " ORDER BY a.name ASC";

    $db->setQuery($query);

    $apps= $db->loadObjectList();
    return $apps;
}}
