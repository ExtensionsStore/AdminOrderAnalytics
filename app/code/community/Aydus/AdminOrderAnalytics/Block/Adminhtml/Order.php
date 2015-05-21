<?php

/**
 * Block for adminhtml_sales_order_view content
 *
 * @category   Aydus
 * @package    Aydus_AdminOrderAnalytics
 * @author     Aydus <davidt@aydus.com>
 */

class Aydus_AdminOrderAnalytics_Block_Adminhtml_Order extends Mage_Adminhtml_Block_Template
{
    public function getCurrentOrder()
    {
        $currentOrder = Mage::registry('current_order');
        
        return $currentOrder;
    }
    
    public function getItems()
    {
        $currentOrder = $this->getCurrentOrder();
        
        $items = $currentOrder->getAllVisibleItems();
        
        return $items;
    }
    
    public function isEnabled()
    {
        $adminOrderPlaced = Mage::getSingleton('adminhtml/session')->getAdminOrderPlaced();
        
        $currentOrder = $this->getCurrentOrder();
        $storeId = $currentOrder->getStoreId();
                
        $account = $this->getAccount($storeId);
        
        $trackAdminOrders = Mage::getStoreConfig('google/analytics/track_admin_orders', $storeId);
        
        $enabled = ($adminOrderPlaced && $account && $trackAdminOrders) ? true : false;
        
        return $enabled;
    }
    
    public function getAccount($storeId = 0)
    {
        $account = Mage::getStoreConfig('google/analytics/account', $storeId);
        
        return $account;
    }
    
    protected function _afterToHtml($html)
    {
        Mage::getSingleton('adminhtml/session')->setAdminOrderPlaced(false);
        
        return parent::_afterToHtml($html);
    }
    

}