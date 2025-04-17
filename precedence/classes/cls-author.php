<?php
require_once("cls-connection.php");
class Author extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleAuthorDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_author', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAuthorDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_author', $fields, $condition, $order_by, $limit, $debug);
    }
    public function getReviewDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_reviewedBy', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertAuthor($insert_data, $debug = 0) {
        return $this->insertRow("predr_author", $insert_data, $debug);
    }

    public function deleteAuthor($condition = '', $debug = 0) {
        $this->deleteRow("predr_author", $condition, $debug);
    }

    public function updateAuthor($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("predr_author", $update_data, $condition, $debug);
    }

}

?>