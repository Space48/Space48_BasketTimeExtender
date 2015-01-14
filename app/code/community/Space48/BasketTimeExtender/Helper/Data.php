<?php
/**
 * Space48_Basket_Time_Extender extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Space48
 * @package        Space48_Basket_Time_Extender
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
class Space48_BasketTimeExtender_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * returns the admin setting enabled yes/no
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::getStoreConfig('space48_baskettimeextender/general/enabled');
    }

    /**
     * returns the cookie life in seconds
     * @return int
     */
    public function getTime()
    {
        return (int)Mage::getStoreConfig('space48_baskettimeextender/general/cookietime');
    }


}
	 