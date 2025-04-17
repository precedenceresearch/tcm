<?php
require_once("cls-connection.php");
class Newsletter extends Connection {

    public function __construct() {
        parent::__construct();
    }

    
    
    public function getNewsletterDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_newsletter', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertNewsletterSubscription($insert_data, $debug = 0) {
        return $this->insertRow("predr_newsletter", $insert_data, $debug);
    }

   
    public function getSingleNewsletterDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_newsletter', $fields, $condition, $order_by, $limit, $debug);
    }
    
    
    public function insertNewsletter($insert_data, $debug = 0) {
        return $this->insertRow("predr_newsletter", $insert_data, $debug);
    }

    public function deleteNewsletter($condition = '', $debug = 0) {
        $this->deleteRow("predr_newsletter", $condition, $debug);
    }

    public function updateNewsletter($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("predr_newsletter", $update_data, $condition, $debug);
    }
}

?>