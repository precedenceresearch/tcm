<?php
require_once("cls-connection.php");
class Paylink extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSinglePaylinkDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_paylinkspr', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getPaylinkDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_paylinkspr', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertPaylink($insert_data, $debug = 0) {
        return $this->insertRow('predr_paylinkspr', $insert_data, $debug);
    }

    public function deletePaylink($condition = '', $debug = 0) {
        $this->deleteRow('predr_paylinkspr', $condition, $debug);
    }

    public function updatePaylink($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_paylinkspr', $update_data, $condition, $debug);
    }
    
    
}

?>