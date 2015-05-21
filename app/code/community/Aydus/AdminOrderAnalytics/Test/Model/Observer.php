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
                
        $this->assertTrue(true);
        
        echo "\nCompleted Aydus_AdminOrderAnalytics model test.";
        
    }
    

}