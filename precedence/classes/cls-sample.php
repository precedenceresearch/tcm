<?php
require_once("cls-connection.php");
class Sample extends Connection {

    public function __construct() {
        parent::__construct();
    }
    
    /********* Sample Report Title *********/
    
    public function insertSampleTitle($insert_data, $debug = 0) {
        return $this->insertRow('predr_sample_sampleTitle', $insert_data, $debug);
    }
    
    public function insertSampleCompany($insert_data, $debug = 0) {
        return $this->insertRow('predr_sample_companyProfile', $insert_data, $debug);
    }
    public function insertSampleTable($insert_data, $debug = 0) {
        return $this->insertRow('predr_sample_tableOption', $insert_data, $debug);
    }
    public function insertPremiumInsights($insert_data, $debug = 0) {
        return $this->insertRow('predr_sample_premiumTitle', $insert_data, $debug);
    }
    public function updatePremiumInsights($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_sample_premiumTitle', $update_data, $condition, $debug);
    }
    public function insertRegional($insert_data, $debug = 0) {
        return $this->insertRow('predr_sample_RegionalData', $insert_data, $debug);
    }

    
    public function getSampleSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_sampleTitle', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getPremiumSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_premiumTitle', $fields, $condition, $order_by, $limit, $debug);
    }
    
   
    public function getSegmentSubSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_subsegmentTitle', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getTableSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_tableOption', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSegmentSubSubSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_SubSubsegment', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSegmentSubSubStepSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('predr_sample_SubStepsegment', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSubPremiumSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_subPremium', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRegionalSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_sample_RegionalData', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSampleSegmentDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('`predr_sample_sampleTitle` LEFT JOIN `predr_sample_segmentTitle` USING (`sampleId`)', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRegionDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('predr_sample_region', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCountryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_country', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRegionalDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('predr_sample_RegionalData', $fields, $condition, $order_by, $limit, $debug);
    }
    
    /******************************************************/
    
    
    public function insertSampleCompany_q($insert_data, $debug = 0) {
        return $this->insertRow('predr_q_company_profile', $insert_data, $debug);
    }
    public function getCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_q_company_profile', $fields, $condition, $order_by, $limit, $debug);
    }
    public function insertSampleSegment($insert_data, $debug = 0) {
        return $this->insertRow('predr_q_segment_title', $insert_data, $debug);
    }
    public function insertSubsegment($insert_data, $debug = 0) {
        return $this->insertRow('predr_q_subsegmentTitle', $insert_data, $debug);
    }
    public function getCompanySingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_q_companyProfile', $fields, $condition, $order_by, $limit, $debug);
    }
    public function getSegmentDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_q_segment_title', $fields, $condition, $order_by, $limit, $debug);
    }
     public function getSubSegmentDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_q_subsegmentTitle', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSegmentSingleDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_q_segment_title', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function updateSegment($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_q_segment_title', $update_data, $condition, $debug);
    }
    
    public function updateSubSegment($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_q_subsegmentTitle', $update_data, $condition, $debug);
    }
    
    public function insertRegionSampleSegment($insert_data, $debug = 0) {
        return $this->insertRow('predr_q_subsegmentTitle_region', $insert_data, $debug);
    }
    
     public function insertRegionCountrySegment($insert_data, $debug = 0) {
        return $this->insertRow('predr_q_subsegmentTitle_country', $insert_data, $debug);
    }
    
    public function insertcountrySegmentValue($insert_data, $debug = 0) {
        return $this->insertRow('predr_q_subsegmentTitle_country_list', $insert_data, $debug);
    }
    
}

?>