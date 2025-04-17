<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("classes/cls-sample.php");
    
    try {

        if (!isset($_SESSION['ifg_admin'])) {
            header("Location: login.php");
        }

    $report_id=$_POST['report_id'];

    $obj_sample = new Sample();
    $conn = $obj_sample->getConnectionObj();

    $rep_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 10);

    $report_id = $_POST['report_id'];
  
           if(isset($_POST['segment_name']) && !empty($_POST['segment_name'])){
            
            $segmentNames = $_POST['segment_name'];
            if(isset($_POST['volumeSegment'])){
                $volumeSegments = $_POST['volumeSegment']; // Get volumeSegment values
            }
        
            $i = 0;
            foreach ($segmentNames as $segmentId => $segmentName) {
                if (!empty($segmentName)) { // Check if segment name is not empty
                    $escapedSegmentName = mysqli_real_escape_string($conn, $segmentName);
                    $escapedVolumeValue = isset($volumeSegments[$segmentId]) ? mysqli_real_escape_string($conn, $volumeSegments[$segmentId]) : 0; // Default to 0 if not set
        
                    $insert_data2['report_id'] = mysqli_real_escape_string($conn, $report_id);
                    $insert_data2['segmentTitle'] = $escapedSegmentName;
                    $insert_data2['volumeSegment'] = $escapedVolumeValue;
                    $insert_data2['createdDate'] = date("Y-m-d h:i:s");
                    $insert_data2['updatedDate'] = date("Y-m-d h:i:s");
                    $segmentId = $obj_sample->insertSampleSegment($insert_data2, 0);
            
                    if (isset($_POST['subsegment_name'][$i])) {
                        $subsegmentNames = $_POST['subsegment_name'][$i];
                        $j = 0;
            
                        foreach ($subsegmentNames as $subsegmentName) {
                            if (!empty($subsegmentName)) { // Check if subsegment name is not empty
                                $escapedSubSegmentName = mysqli_real_escape_string($conn, $subsegmentName);
            
                                // Insert subsegment into the 'subsegments' table
                                $insert_data3['report_id'] = mysqli_real_escape_string($conn, $report_id);
                                $insert_data3['segmentId'] = mysqli_real_escape_string($conn, $segmentId);
                                $insert_data3['subsegmentTitle'] = mysqli_real_escape_string($conn, $escapedSubSegmentName);
                                $insert_data3['createdDate'] = date("Y-m-d h:i:s");
                                $insert_data3['updatedDate'] = date("Y-m-d h:i:s");
                                $res = $obj_sample->insertSubsegment($insert_data3, 0);
                            }
                            $j++;
                        }
                    }
                }
                $i++;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $report_id]);
        exit;
    
     } 
     catch (Exception $e) {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }    
    
}else{
    header('Content-Type: application/json', true, 405); 
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
header("Location:manage-report-q");
exit(0);
?>