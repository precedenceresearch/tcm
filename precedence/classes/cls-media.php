<?php
require_once("cls-connection.php");
class Media extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleMediaDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_media', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getMediaDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_media', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertMedia($insert_data, $debug = 0) {
        return $this->insertRow('predr_media', $insert_data, $debug);
    }

    public function deleteMedia($condition = '', $debug = 0) {
        $this->deleteRow('predr_media', $condition, $debug);
    }

    public function updateMedia($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_media', $update_data, $condition, $debug);
    }
    
    
}

?>