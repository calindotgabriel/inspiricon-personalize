<?php
 
class Inspiricon_Personalize_Model_Mysql4_Personalize extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('personalize/personalize', 'personalize_id');
    }
}
