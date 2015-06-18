<?php
 
class Inspiricon_Personalize_Model_Mysql4_Personalize_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('personalize/personalize');
    }
}
