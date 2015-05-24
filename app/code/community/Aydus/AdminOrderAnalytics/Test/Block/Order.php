<?php

/**
 * Block test
 *
 * @category   Aydus
 * @package    Aydus_AdminOrderAnalytics
 * @author     Aydus <davidt@aydus.com>
 */

class Aydus_AdminOrderAnalytics_Test_Block_Order 
    extends EcomDev_PHPUnit_Test_Case_Controller
{    
    /**
     * Mock session
     */
    public function setUp()
    {
        $this->reset();
        $sessionMock = $this->getModelMockBuilder('admin/session')
            ->disableOriginalConstructor()->setMethods(null)->getMock();
        $this->replaceByMock('singleton', 'admin/session', $sessionMock);
    }
    
    /**
     * After admin creates order, admin is redirected to admin/sales_order/view
     * Template with Analytics tag is added to content block of page 
     *
     * @test
     * @loadFixture
     */
    public function isEnabled()
    {
        echo "\nStarting Aydus_AdminOrderAnalytics block test.";
        
        $adminUserId = 1;
        $adminUser = Mage::getSingleton('admin/user');
        $adminUser->load($adminUserId);
        
        $adminSession = Mage::getSingleton('admin/session');
        $adminSession->setIsFirstVisit(true);
        $adminSession->setUser($adminUser);
        $adminSession->setAcl(Mage::getResourceModel('admin/acl')->loadAcl());
        Mage::dispatchEvent('admin_session_user_login_success', 
                array('user'=>$adminUser));       
                     
        $orderId = 1;
        $this->dispatch('adminhtml/sales_order/view', 
                array('order_id'=>$orderId));
        
        $this->assertLayoutHandleLoaded('adminhtml_sales_order_view');
                
        $this->assertLayoutBlockCreated('adminorderanalytics');
                        
        echo "\nCompleted Aydus_AdminOrderAnalytics block test.";
        
    }

}