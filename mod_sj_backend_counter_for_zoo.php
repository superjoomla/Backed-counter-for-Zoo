<?php

/**
 * @package   SJ ZOO Counter
 * @author    Adam Bako
 * @copyright Copyright (C) SuperJoomla.com
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// load config
jimport('joomla.filesystem.file');
if (!JFile::exists(JPATH_ADMINISTRATOR.'/components/com_zoo/config.php') || !JComponentHelper::getComponent('com_zoo', true)->enabled) {
    return;
}

require_once(JPATH_ADMINISTRATOR.'/components/com_zoo/config.php');
require_once dirname(__FILE__) . '/helper.php';

// make sure App class exists
if (!class_exists('App')) {
    return;
}

$zoo = App::getInstance('zoo');

$applications = $zoo->table->application->all(array('order' => 'name'));

if (empty($applications)) {
    return;
}

$appky = SJ_zoo_backend_counter_helper::SJ_zoo_backend_counter();

?>
    <style type="text/css">
        tr.counter_apps:hover{background: #eee; cursor: pointer;}
        tr.counter_apps td {padding: 4px 10px;}
        tr.counter_apps a {color:#555;}
        tr.counter_apps a:hover {text-decoration:none;}
    </style>

    <div class="sidebar-nav quick-icons" style="margin-bottom:25px;">
        <h2 class="nav-header">ZOO Apps Item Counter</h2>
        <table width="100%" style="margin-bottom:20px;">
            <tr>
                <td width="55%"><strong><?php echo JText::_( 'SJ_ZOO_COUNTER_NAME' );?></strong></td>
                <td width="15%" style="text-align: center;"><strong><?php echo JText::_( 'SJ_ZOO_COUNTER_ALL' );?></strong></td>
                <td width="15%" style="text-align: center;"><strong><?php echo JText::_( 'SJ_ZOO_COUNTER_PUBLISHED' );?></strong></td>
                <td width="15%" style="text-align: center;"><strong><?php echo JText::_( 'SJ_ZOO_COUNTER_UNPUBLISHED' );?></strong></td>
            </tr>
            <?php
                foreach ($appky as $appka) : ?>
                <tr class="counter_apps" height="20px" onclick="window.document.location='<?php echo JRoute::_('index.php?option=com_zoo&changeapp='.$appka->id); ?>';"  >
                    <?php foreach ($applications as $application) : ?>
                        <?php if ($appka->id == $application->id) { ?>
                            <td width="55%">
                                <a href="<?php echo JRoute::_('index.php?option='.$zoo->component->self->name.'&changeapp='.$application->id); ?>">
                                    <img style="width:24px; height:24px;" alt="<?php echo $application->name; ?>" src="<?php echo $application->getIcon(); ?>" />
                                    <span><?php echo $application->name; ?></span>
                                </a>
                            </td>
                        <?php } ?>
                    <?php endforeach; ?>
                    <td  width="15%" style="text-align: center;"><?php echo $appka->all_items; ?></td>
                    <td  width="15%" style="text-align: center;"><?php echo $appka->published; ?></td>
                    <td  width="15%" style="text-align: center;"><?php echo $appka->unpublished; ?></td>
                </tr>
                <?php endforeach; ?>
        </table>
    </div>
