<?php

/**
 * Observer test
 *
 * @category   Aydus
 * @package    Aydus_AdminOrderAnalytics
 * @author     Aydus <davidt@aydus.com>
 */

class Aydus_AdminOrderAnalytics_Test_Model_Observer extends EcomDev_PHPUnit_Test_Case_Config
{    
    /**
     * Test observer
     *
     * @test
     * @loadFixture
     */
    public function salesOrderPlaceAfter()
    {
        echo "\nStarting Aydus_AdminOrderAnalytics model test.";
                
        $adminSession = $this->getModelMockBuilder('admin/session')
                ->disableOriginalConstructor()
                ->setMethods(null)
                ->getMock();
    
        $this->replaceByMock('singleton', 'admin/session', $adminSession);        
        
        $order = Mage::getModel('sales/order');
        $order->load(1);
        $observer = new Varien_Event_Observer();
        $event = new Varien_Event();
        $observer->setEvent($event);    
        $event->setOrder($order);
        $observer->setOrder($order);
        
        $model = Mage::getModel('aydus_adminorderanalytics/observer');
        
        $observer = $model->salesOrderPlaceAfter($observer);
        
        $adminOrderPlaced = (bool)Mage::getSingleton('admin/session')->getAdminOrderPlaced();
        
        $this->assertTrue($adminOrderPlaced);
        
        echo "\nCompleted Aydus_AdminOrderAnalytics model test.";
        
    }
    

}