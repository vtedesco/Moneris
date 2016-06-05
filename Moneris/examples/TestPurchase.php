<?php
require '../mpgClasses.php';

/**
 * Simple classe who manage mpgClasses and make a vault purchase
 * Usage exemple :
 * $moneris = new Moneris('store5','yesguy','esqa.moneris.com');
 * $moneris->vaultPayment('sgc8ulfVT3iRk5L4Kk5ZHZj12',1.OO);
 */
class Moneris {

    // You can override the constructor with your Moneris configurations values
    public function __construct($store_id, $api_token, $res_url) {
        $this->store_id = $store_id;
        $this->api_token = $api_token;
        $this->res_url = $res_url;
    }

    public function vaultPayment($dataKey, $amount){

        // step 1) create transaction hash
        $txnArray=array(
            'type'      => 'res_purchase_cc',
            'data_key'  => $dataKey,
            'order_id'  => 'purchase-'.date("dmy-G:i:s").uniqid(),
            'cust_id'   => 'cust',
            'amount'    => number_format($amount, 2,'.',''),
            'crypt_type'=> '7'
        );

        // step 2) create a transaction  object passing the hash created in
        $mpgTxn = new \mpgTransaction($txnArray);

        // step 3) create a mpgRequest object passing the transaction object created in step 2
        $mpgRequest = new \mpgRequest($mpgTxn);

        // step 4) create mpgHttpsPost object which does an https post
        $mpgHttpPost = new \mpgHttpsPost(
            $this->store_id,
            $this->api_token,
            $this->res_url,
            $mpgRequest
        );
        
        // step 5) get an mpgResponse object
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        // step 6) Payment création
        # Your logic here

        return $mpgResponse;
    }
}