<?php
require_once("cls-connection.php");
class Lead extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleLeadDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_formdetails', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getLeadDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_formdetails', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRegionDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_countries_Region', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertLead($insert_data, $debug = 0) {
        return $this->insertRow('predr_formdetails', $insert_data, $debug);
    }

    public function deleteLead($condition = '', $debug = 0) {
        $this->deleteRow('predr_formdetails', $condition, $debug);
    }

    public function updateLead($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_formdetails', $update_data, $condition, $debug);
    }
    
    public function getFullLeadDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`predr_formdetails` INNER JOIN `predr_reports` ON `predr_formdetails`.`report_id` = `predr_reports`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertHDFC($insert_data, $debug = 0) {
        return $this->insertRow('predr_hdfscpayid', $insert_data, $debug);
    }
    
}

?>