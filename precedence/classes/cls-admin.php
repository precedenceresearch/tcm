<?php

require_once("cls-connection.php");

class Admin extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleAdminDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_backusers', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAdminDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_backusers', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertAdmin($insert_data, $debug = 0) {
        return $this->insertRow("predr_backusers", $insert_data, $debug);
    }

    public function deleteAdmin($condition = '', $debug = 0) {
        $this->deleteRow("predr_backusers", $condition, $debug);
    }

    public function updateAdmin($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("predr_backusers", $update_data, $condition, $debug);
    }
    
   
}

?>