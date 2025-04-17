<?php
require_once("classes/cls-graph.php");

$obj_graph = new Graph();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$conn = $obj_graph->getConnectionObj();

if ($_POST['graph'] == "Bar Chart") {
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $_POST['barid']);
    $insert_data['graph_type'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['x-coord-title'] = mysqli_real_escape_string($conn, $_POST['xcordtitle']);
    $insert_data['y-coord-title'] = mysqli_real_escape_string($conn, $_POST['ycordtitle']);
    $insert_data['x-coordinate'] = mysqli_real_escape_string($conn, $_POST['xcord']);
    $insert_data['x-value'] = mysqli_real_escape_string($conn, $_POST['bval']);
    $insert_data['graph_script'] = mysqli_real_escape_string($conn, $_POST['barscript']);
    $insert_data['main_title'] = mysqli_real_escape_string($conn, $_POST['headerbartitle']);
    $insert_data['sub_title'] = mysqli_real_escape_string($conn, $_POST['headerbarsubtitle']);
    $insert_data['bar-value-color'] = mysqli_real_escape_string($conn, $_POST['bcol']);
    $insert_data['bar-format'] = mysqli_real_escape_string($conn, $_POST['bformat']);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Graph</strong> has been added successfully";
} 
if ($_POST['graph'] == "Pie Chart") {
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $_POST['barid']);
    $insert_data['graph_type'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['pie-option'] = mysqli_real_escape_string($conn, $_POST['pieoption']);
    $insert_data['pie-option-count'] = mysqli_real_escape_string($conn, $_POST['pieoptioncount']);
    $insert_data['pie-option-color'] = mysqli_real_escape_string($conn, $_POST['pieoptioncol']);
    $insert_data['graph_script'] = mysqli_real_escape_string($conn, $_POST['piescript']);
    $insert_data['main_title'] = mysqli_real_escape_string($conn, $_POST['headerpietitle']);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Graph</strong> has been added successfully";
} 
if ($_POST['graph'] == "Point Chart") {
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $_POST['barid']);
    $insert_data['graph_type'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['x-coord-title'] = mysqli_real_escape_string($conn, $_POST['xcordpointtitle']);
    $insert_data['y-coord-title'] = mysqli_real_escape_string($conn, $_POST['ycordpointtitle']);
    $insert_data['x-coordinate'] = mysqli_real_escape_string($conn, $_POST['xcordpoint']);
    $insert_data['x-value'] = mysqli_real_escape_string($conn, $_POST['bvalpoint']);
    $insert_data['graph_script'] = mysqli_real_escape_string($conn, $_POST['pointscript']);
    $insert_data['main_title'] = mysqli_real_escape_string($conn, $_POST['headerpointtitle']);
    $insert_data['sub_title'] = mysqli_real_escape_string($conn, $_POST['headerpointsubtitle']);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Graph</strong> has been added successfully";
} 
//header("Location:manage-report");
exit(0);
?>