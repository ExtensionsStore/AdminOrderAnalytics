<?php

/**
 * Observer
 *
 * @category   Aydus
 * @package    Aydus_AdminOrderAnalytics
 * @author     Aydus <davidt@aydus.com>
 */

class Aydus_AdminOrderAnalytics_Model_Observer 
{
    /**
     * Register session flag
     * Admin creates order and is directed to Order View
     * Flag determines whether to show the analytics script
     * 
     * @see sales_order_place_after
     * @param Varien_Event_Observer $observer
     */
    public function salesOrderPlaceAfter($observer)
    {
        $order = $observer->getOrder();
        $storeId = $order->getStoreId();
        $trackAdminOrders = Mage::getStoreConfig('google/analytics/track_admin_orders', $storeId);
        
        if ($trackAdminOrders){
            
            Mage::getSingleton('adminhtml/session')->setAdminOrderPlaced(true);
            $observer->setAdminOrderPlaced(true);
            
        }
        
        return $observer;
    }
    
}