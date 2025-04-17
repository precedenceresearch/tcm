<?php
require_once("classes/cls-graph.php");

$obj_graph = new Graph();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$conn = $obj_graph->getConnectionObj();

if ($_POST['graph'] == "Stacked Chart") {
    
    $uniqid = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)); // 5 letters (hex chars)
    $randomDigits = substr(str_shuffle('0123456789'), 0, 5); // 5 random digits
    
     $chartId = $uniqid . $randomDigits;
     
     $stackedScript = str_replace('Stacked Script', $_POST['report_id'].$chartId, $_POST['stackedscript']);
    
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $chartId);
    $insert_data['graph_type'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['years'] = mysqli_real_escape_string($conn, $_POST['years']);
    $insert_data['barDisplay'] = mysqli_real_escape_string($conn, $_POST['barDisplay']);
    $insert_data['yaxisTitle'] = mysqli_real_escape_string($conn, $_POST['yaxisTitle']);
    $insert_data['reportTitle'] = mysqli_real_escape_string($conn, $_POST['reportTitle']);
    $insert_data['northAmerica'] = mysqli_real_escape_string($conn, $_POST['northAmerica']);
    $insert_data['latinAmerica'] = mysqli_real_escape_string($conn, $_POST['latinAmerica']);
    $insert_data['europe'] = mysqli_real_escape_string($conn, $_POST['europe']);
    $insert_data['asiaPacific'] = mysqli_real_escape_string($conn, $_POST['asiaPacific']);
    $insert_data['middleEastA'] = mysqli_real_escape_string($conn, $_POST['middleEastA']);
    $insert_data['barColor'] = mysqli_real_escape_string($conn, $_POST['barColor']);
    $insert_data['barscript'] = mysqli_real_escape_string($conn, $stackedScript);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertStackedGraphDetails($insert_data, 0);

    $_SESSION['success'] = "<strong>Stacked Graph</strong> has been added successfully";
} 
header("Location:manage-report");
exit(0);
?>