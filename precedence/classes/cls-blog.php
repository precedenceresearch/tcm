<?php
require_once("cls-connection.php");
class Blog extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleBlogDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('predr_blogs', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getBlogDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('predr_blogs', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertBlog($insert_data, $debug = 0) {
        return $this->insertRow('predr_blogs', $insert_data, $debug);
    }

    public function deleteBlog($condition = '', $debug = 0) {
        $this->deleteRow('predr_blogs', $condition, $debug);
    }

    public function updateBlog($update_data, $condition = '', $debug = 0) {
        return $this->updateRow('predr_blogs', $update_data, $condition, $debug);
    }
    
    
}

?>