<?php
 
class Inspiricon_Personalize_Block_Personalize extends Mage_Core_Block_Template
{
    public function showMessage() {
        return "Hello bears";
    }

    public function getMessage() {
        return "oyoyoy";
    }

    public function redirect() {
        $redirectUrl = 'http://google.ro';
        Mage::app()->getResponse()->setRedirect($redirectUrl)->sendResponse();
    }


}
