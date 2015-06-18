<?php
/**
 * Created by IntelliJ IDEA.
 * User: motan
 * Date: 13.05.2015
 * Time: 10:50
 */

class Markju_Personalize_Model_Api extends Mage_Api_Model_Resource_Abstract
{

    public function create($customerData)
    {
        echo "create";
    }

    public function info($customerId)
    {
        echo "info";
    }

    public function items($filters)
    {
        echo "list";
    }

    public function update($customerId, $customerData)
    {
        echo "update";
    }

    public function delete($customerId)
    {
        echo "delete";
    }
}