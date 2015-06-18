<?php
/**
 * Created by IntelliJ IDEA.
 * User: motan
 * Date: 13.05.2015
 * Time: 12:43
 */
class Inspiricon_Personalize_Model_Core_Api
{
    /**
     * Returns version of the installed magento
     * @return String
     */
    public function getVersion()
    {
        return Mage::getVersion();
    }
}