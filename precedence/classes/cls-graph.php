<?php
require_once("cls-connection.php");
class Graph extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleGraphDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_graph', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getGraphDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_graph', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getGraphStackedDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_bar_graph', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getColumnGraphDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_column_graph', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getPointGraphDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_point_graph', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getPieGraphDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_pie_chart', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertGraph($insert_data, $debug = 0) {
        return $this->insertRow('predr_graph', $insert_data, $debug);
    }
     public function insertPieGraph($insert_data, $debug = 0) {
        return $this->insertRow('predr_pie_chart', $insert_data, $debug);
    }
    
    public function insertStackedBarGraph($insert_data, $debug = 0) {
        return $this->insertRow('predr_bar_graph', $insert_data, $debug);
    }
    
    public function insertPointGraph($insert_data, $debug = 0) {
        return $this->insertRow('predr_point_graph', $insert_data, $debug);
    }
    
    public function insertColumnGraph($insert_data, $debug = 0) {
        return $this->insertRow('predr_column_graph', $insert_data, $debug);
    }
    
    public function deleteGraph($condition = '', $debug = 0) {
        $this->deleteRow('predr_graph', $condition, $debug);
    }

    public function updateGraph($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_graph', $update_data, $condition, $debug);
    }
    
    
}

?>