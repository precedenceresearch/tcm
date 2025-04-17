<?php
require_once("cls-connection.php");
class Category extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleCategoryDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_category', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCategoryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_category', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertCategory($insert_data, $debug = 0) {
        return $this->insertRow("predr_category", $insert_data, $debug);
    }

    public function deleteCategory($condition = '', $debug = 0) {
        $this->deleteRow("predr_category", $condition, $debug);
    }

    public function updateCategory($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("predr_category", $update_data, $condition, $debug);
    }

}

?>