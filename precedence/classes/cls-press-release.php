<?php
require_once("cls-connection.php");
class Press extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSinglePressDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_news', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getPressDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_news', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertPress($insert_data, $debug = 0) {
        return $this->insertRow('predr_news', $insert_data, $debug);
    }

    public function deletePress($condition = '', $debug = 0) {
        $this->deleteRow('predr_news', $condition, $debug);
    }

    public function updatePress($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_news', $update_data, $condition, $debug);
    }
    
    
}

?>