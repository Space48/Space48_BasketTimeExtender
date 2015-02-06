<?php

class Space48_BasketTimeExtender_Model_Container_Sidebar_Cart extends Enterprise_PageCache_Model_Container_Sidebar_Cart
{
    /**
     * Get cache identifier
     *
     * @return string
     */
    protected function _getCacheId()
    {
        return self::getCacheId();
    }

    /**
     * Get cache identifier
     *
     * @return string
     */
    public static function getCacheId()
    {
        $cookieCart = Enterprise_PageCache_Model_Cookie::COOKIE_CART;
        $cookieCustomer = Enterprise_PageCache_Model_Cookie::COOKIE_CUSTOMER;
        $basketextender = Space48_BasketTimeExtender_Model_Observer::COOKIE_NAME;

        return md5(Enterprise_PageCache_Model_Container_Advanced_Quote::CACHE_TAG_PREFIX
            . (array_key_exists($cookieCart, $_COOKIE) ? $_COOKIE[$cookieCart] : '')
            . (array_key_exists($cookieCustomer, $_COOKIE) ? $_COOKIE[$cookieCustomer] : '')
            . (array_key_exists($basketextender, $_COOKIE) ? $_COOKIE[$basketextender] : ''));
    }
}