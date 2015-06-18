<?php
class Inspiricon_Personalize_ApiController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $urlTest = 'http://www.hashemian.com/tools/form-post-tester.php';
        $urlGoogle= 'http://google.ro';

        $request = "test request";
        $client = new Zend_Http_Client($urlGoogle);
        $client->setRawData($request, 'application/json');
        $client->request('POST');

    }

    public function productsAction() {

        var_dump($this->getRequest()->getPost());


        $id = $this->getRequest()->getPost('id');
        $session_id = $this->getRequest()->getPost('session_id');


        if ($id == NULL || $session_id == NULL) {
            Mage::throwException('Invalid request. Please check POST parameters');
        }

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT * FROM  personalize WHERE `product_id`='. $id . ";";
        $result = $readConnection->fetchAll($query);

        if (count($result) == 0) {
            Mage::throwException('Could not find product with id='.id.'in database');
        }
        $product = $result[0];

        $leftX = $product['leftx'];
        $leftY = $product['lefty'];
        $rightX = $product['rightx'];
        $rightY = $product['righty'];
        $imgUrl = $product['imgurl'];

        $serverAdress = 'http://192.168.0.21';
        $magentoPath = 'magento';
        $resourcePath = 'media/catalog/product';
        $fullImgUrl = $serverAdress .'/'.$magentoPath.'/'.$resourcePath.$imgUrl;

        $response = array(
            'session_id' => $session_id,
            '_id' => $id,
            'canvas' => array(
                'backgroundimg_url' => $fullImgUrl,
                'position' => array(
                    'left_x' => $leftX,
                    'left_y' => $leftY,
                    'right_x' => $rightX,
                    'right_y' => $rightY,
                ),
            ),
        );

        $this->getResponse()->setBody(json_encode($response));

    }



    public function startAction() {

        $id = $this->getRequest()->getParam('id');
        if ($id == NULL) {
            echo '{ "error" : "Id is null, try again" }';
            return;
        }

        $sessionId = Mage::getSingleton('core/session')->getEncryptedSessionId();
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT * FROM  personalize WHERE `product_id`='. $id . ";";
        $result = $readConnection->fetchAll($query);

        $product = $result[0];

        $leftX = $product['leftx'];
        $leftY = $product['lefty'];
        $rightX = $product['rightx'];
        $rightY = $product['righty'];
        $imgUrl = $product['imgurl'];

        $serverAdress = 'http://192.168.10.130';
        $magentoPath = 'magento';
        $resourcePath = 'media/catalog/product';

        $fullImgUrl = $serverAdress .'/'.$magentoPath.'/'.$resourcePath.$imgUrl;

        $request = array(
            'session_id' => $sessionId,
            '_id' => $id,
            'canvas' => array(
                'backgroundimg_url' => $fullImgUrl,
                'position' => array(
                    'left_x' => $leftX,
                    'left_y' => $leftY,
                    'right_x' => $rightX,
                    'right_y' => $rightY,
                ),
            ),
        );


//        echo(json_encode($request));

        $url = 'http://192.168.10.121/markju';
        /*$urlTest = 'http://www.hashemian.com/tools/form-post-tester.php';

        $json = json_encode($request);
        $client = new Zend_Http_Client($urlTest);
        $client->setRawData($json, 'application/json')->request('POST');


        echo $client->request()->getBody();*/

//        $this->_redirectUrl($url);

    }

    public function approveAction() {

        $id = $this->getRequest()->getParam('id');
        if ($id == NULL) {
            echo '{ "error" : "Id is null, try again" }';
            return;
        }

        $product = Mage::getModel('catalog/product')->load($id);
        $qty = 1;

        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $quote->addProduct($product, $qty);

        $quote->collectTotals()->save();

//        echo $product->getName();

        $this->_redirect('checkout/cart');

    }

    public function cancelAction() {
        echo "I should cancel";
    }




}
