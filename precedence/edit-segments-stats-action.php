<?php
require_once("classes/cls-sample.php");

$obj_sample = new Sample();
$conn = $obj_sample->getConnectionObj();
$report_id = $_POST['report_id'];

try {
    if (!isset($_POST['segmentTitle']) || empty($_POST['segmentTitle'])) {
        throw new Exception("No segment data received.");
    }

    $segmentTitles = $_POST['segmentTitle'];
    $segmentIds = $_POST['segmentId'] ?? [];
    $subsegmentTitlesGrouped = $_POST['subsegmentTitle'] ?? [];
    $subsegmentIdsGrouped = $_POST['subsegmentId'] ?? [];

    foreach ($segmentTitles as $segmentIndex => $segmentTitle) {
        $escapedSegmentTitle = mysqli_real_escape_string($conn, $segmentTitle);
        $segmentId = $segmentIds[$segmentIndex] ?? null;

        if ($segmentId && strpos($segmentId, 'new-') === false) {
            // ✅ Update existing segment
            $obj_sample->updateSegment(
                ['segmentTitle' => $escapedSegmentTitle, 'updatedDate' => date("Y-m-d H:i:s")],
                "`segmentId` = '$segmentId'", 0
            );
        } else {
            // ✅ Insert new segment
            $segmentId = $obj_sample->insertSampleSegment(
                ['report_id' => $report_id, 'segmentTitle' => $escapedSegmentTitle, 'createdDate' => date("Y-m-d H:i:s")], 0
            );

            if (!$segmentId) {
                throw new Exception("Failed to insert new segment for Report ID: $report_id");
            }
        }

        // ✅ Ensure subsegments are inserted properly
        if (!empty($subsegmentTitlesGrouped[$segmentIndex])) {
            foreach ($subsegmentTitlesGrouped[$segmentIndex] as $subIndex => $subsegmentTitle) {
                if (empty($subsegmentTitle)) continue; // Ignore empty subsegment titles

                $escapedSubsegmentTitle = mysqli_real_escape_string($conn, $subsegmentTitle);
                $subsegmentId = $subsegmentIdsGrouped[$segmentIndex][$subIndex] ?? null;

                if ($subsegmentId && $subsegmentId !== "new") {
                    // ✅ Update existing subsegment
                    $obj_sample->updateSubSegment(
                        ['subsegmentTitle' => $escapedSubsegmentTitle, 'updatedDate' => date("Y-m-d H:i:s")],
                        "`id` = '$subsegmentId'", 0
                    );
                } else {
                    
                    // ✅ Insert new subsegment
                    $insertStatus = $obj_sample->insertSubsegment(
                        ['report_id' => $report_id, 'segmentId' => $segmentId, 'subsegmentTitle' => $escapedSubsegmentTitle, 'createdDate' => date("Y-m-d H:i:s")], 0
                    );

                    if (!$insertStatus) {
                        throw new Exception("Failed to insert subsegment for Segment ID: $segmentId");
                    }
                }
            }
        }
    }
    header('Content-Type: application/json; charset=utf-8');    
    echo json_encode(['status' => 'success', 'message' => 'Segments & Subsegments updated successfully.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
