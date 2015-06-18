<?php
/**
 * Created by IntelliJ IDEA.
 * User: motan
 * Date: 13.05.2015
 * Time: 12:44
 */
class Inspiricon_Personalize_Model_DashBoard_Api
{
    /**
     * Returns list of best selling products, returned list is limited to the number items specified in argument.
     * @param int $limit
     */
    public function getBestsellers($limit=5)
    {
        //filter
        $visibility = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
        );

        $_arrayOfBestsellers = Mage::getResourceModel('reports/product_collection')
            ->addAttributeToSelect('*')
            ->addOrderedQty()
            ->addAttributeToFilter('visibility', $visibility)
            ->setOrder('ordered_qty', 'desc')
            ->getSelect()->limit($limit)->query();
        $bestProducts = array();

        $details = Mage::getModel('catalog/product');

        foreach ($_arrayOfBestsellers as $product)
        {
            $details->load($product['entity_id']);
            $bestProduct[] = array(
                "qty" => $product["ordered_qty"]
            , "price" => $details->getPrice()
            , "name" => $details->getName()
            );
        }

        return $bestProduct;
    }
    /**
     * Get sales totals
     * Returns totals for : Revenue, Tax, Shipping and Quantity for given time range, default is last 24 hours.
     * @param String $period - default '24h', possible values are: 24h, ,1y, 2y
     */
    public function getTotals($period='24h')
    {

        $collection = Mage::getResourceModel('reports/order_collection')
            ->addCreateAtPeriodFilter($period)
            //->getSelectCountSql()
            ->calculateTotals(1)
        ;
        /*
        $collection->addFieldToFilter('store_id',
            array('eq' => Mage::app()->getStore(Mage_Core_Model_Store::ADMIN_CODE)->getId())
        );
        */
        $collection->load();

        $totals = $collection->getFirstItem();


        return array(
            'Revenue' => $totals->getRevenue()
        , 'Tax' => $totals->getTax()
        , 'Shipping' => $totals->getShipping()
        , 'Quantity' => $totals->getQuantity() * 1
        );
    }
}
