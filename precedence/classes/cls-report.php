<?php
require_once("cls-connection.php");
class Report extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleReportDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_reports', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_reports', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_topCompanies', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertReport($insert_data, $debug = 0) {
        return $this->insertRow('predr_reports', $insert_data, $debug);
    }
    
    public function insertCompany($insert_data, $debug = 0) {
        return $this->insertRow('predr_topCompanies', $insert_data, $debug);
    }

    public function deleteReport($condition = '', $debug = 0) {
        $this->deleteRow('predr_reports', $condition, $debug);
    }

    public function updateReport($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_reports', $update_data, $condition, $debug);
    }
    
    public function updateCompanies($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_topCompanies', $update_data, $condition, $debug);
    }
    
    public function updateCompany($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_topCompanies', $update_data, $condition, $debug);
    }
    
    /***************FAQ*****************/
    public function getReportFAQDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_mrfaq', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertReportFAQ($insert_data, $debug = 0) {
        return $this->insertRow('predr_mrfaq', $insert_data, $debug);
    }

    public function deleteReportFAQ($condition = '', $debug = 0) {
        $this->deleteRow('predr_mrfaq', $condition, $debug);
    }

    public function updateReportFAQ($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_mrfaq', $update_data, $condition, $debug);
    }
    
    /***************FAQ New*****************/
    public function getReportFAQNewDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_faq', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertReportFAQNew($insert_data, $debug = 0) {
        return $this->insertRow('predr_faq', $insert_data, $debug);
    }

    public function deleteReportFAQNew($condition = '', $debug = 0) {
        $this->deleteRow('predr_faq', $condition, $debug);
    }

    public function updateReportFAQNew($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_faq', $update_data, $condition, $debug);
    }
    
    /***************Country*****************/
    public function getCountryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_country', $fields, $condition, $order_by, $limit, $debug);
    }
    
        public function getReportDetailsthanks($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_reports', $fields, $condition, $order_by, $limit, $debug);
    }
    public function getReport_q_Details($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_q_reports', $fields, $condition, $order_by, $limit, $debug);
    }
      public function insertReport_q($insert_data, $debug = 0) {
         return $this->insertRow('predr_q_reports', $insert_data, $debug);
    }
    public function updateReport_q($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_q_reports', $update_data, $condition, $debug);
    }

}

?>