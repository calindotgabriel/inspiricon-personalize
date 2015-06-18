<?php
 
class Inspiricon_Personalize_Model_Personalize extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();


        $this->_init('personalize/personalize');


    }
}
