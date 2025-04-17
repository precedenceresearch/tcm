<?php

require_once("cls-connection.php");

class Menu extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleMenuDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_menu', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getMenuDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_menu', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAdminDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_backusers', $fields, $condition, $order_by, $limit, $debug);
    }

    
}

?>