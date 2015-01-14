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
class Space48_BasketTimeExtender_Model_Observer
{
    const COOKIE_NAME = 'basketextender';

    /**
     * Checks to see if the cookie is set, if set loads the quote and restores the basket
     * @param Varien_Event_Observer $observer
     */
    public function controllerFrontInitBefore(Varien_Event_Observer $observer)
    {
        if ($this->isEnabled() && !$this->cookieIsActive() && !$this->userLoggedIn()) {
            $cookie = Mage::getModel('core/cookie');

            if ($cookie->get(self::COOKIE_NAME)) {
                $cookieToken = $cookie->get(self::COOKIE_NAME);
                if ($cookieToken) {

                    $quote = Mage::getSingleton('sales/quote')->getCollection();
                    $quote->addFieldToSelect('space48_basket_extender_token');
                    $quote->addFieldToSelect('entity_id');
                    $quote->addFieldToFilter('space48_basket_extender_token', $cookieToken);
                    $quoteId = $quote->getFirstItem()->getData('entity_id');

                    if ($quoteId) {
                        Mage::getSingleton('core/session')->setBasketExtended(1);
                        Mage::getSingleton('checkout/session')->setQuoteId($quoteId);
                    }
                }
            }
        }

    }

    /**
     * Checks for an active cookie if not active it sets the cookie
     * Event: checkout_cart_save_after
     * @param Varien_Event_Observer $observer
     */
    public function initCookie(Varien_Event_Observer $observer)
    {
        if ($this->isEnabled() && !$this->userLoggedIn()) {

            $id = $observer->getData('cart')->getQuote()->getEntityId();

            $this->setCookie($id);

        }

    }

    public function setCookie($id)
    {
        $cookie = Mage::getModel('core/cookie');

        if (! $cookie->get(self::COOKIE_NAME)) {
            $token = md5($id . uniqid());
            if ($id) {
                $quote = Mage::getModel('sales/quote')->load($id);
                $quote->setSpace48BasketExtenderToken($token);
                $quote->save();
                $cookie->set(self::COOKIE_NAME, $token, $this->getCookieTime());
            }
        } else {
            $token = $cookie->get(self::COOKIE_NAME);
            $cookie->set(self::COOKIE_NAME, $token, $this->getCookieTime());
        }

    }

    /**
     * Unsets the session variable BasketExtended on login
     * Login merges the quote and deletes the non logged in one,
     * need to remove the cookie also
     */
    public function cleanupOnLogin()
    {
        Mage::getSingleton('core/session')->unsBasketExtended();

        $cookie = Mage::getModel('core/cookie');
        $cookie->delete(self::COOKIE_NAME);
    }

    public function isEnabled()
    {
        return Mage::helper('space48_baskettimeextender')->isEnabled();
    }

    public function getCookieTime()
    {
        return Mage::helper('space48_baskettimeextender')->getTime();
    }

    public function cookieIsActive()
    {
        if (Mage::getSingleton('core/session')->getBasketExtended()) {
            return true;
        }
        return false;

    }

    public function userLoggedIn()
    {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

}