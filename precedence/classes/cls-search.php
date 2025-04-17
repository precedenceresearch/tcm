<?php
require_once("cls-connection.php");
class Search extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleSearchDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_search', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSearchDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_search', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertSearch($insert_data, $debug = 0) {
        return $this->insertRow('predr_search', $insert_data, $debug);
    }

    public function deleteSearch($condition = '', $debug = 0) {
        $this->deleteRow('predr_search', $condition, $debug);
    }

    public function updateSearch($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_search', $update_data, $condition, $debug);
    }
    
   
}

?>