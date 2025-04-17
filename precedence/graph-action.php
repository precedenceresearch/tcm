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
    $obj_graph->insertStackedBarGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Stacked Graph</strong> has been added successfully";
} 

if ($_POST['graph'] == "Column Chart") {
    
     $uniqid = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)); // 5 letters (hex chars)
     $randomDigits = substr(str_shuffle('0123456789'), 0, 5); // 5 random digits
    
     $chartId = $uniqid . $randomDigits;
     
     $columnScript = str_replace('Column Script', $_POST['report_id'].$chartId, $_POST['columnscript']);
    
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $chartId);
    $insert_data['graph_type'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['columnDisplay'] = mysqli_real_escape_string($conn, $_POST['columnDisplay']);
    $insert_data['columnreportTitle'] = mysqli_real_escape_string($conn, $_POST['columnreportTitle']);
    $insert_data['columnyaxisTitle1'] = mysqli_real_escape_string($conn, $_POST['columnyaxisTitle1']);
    $insert_data['columnyaxisTitle2'] = mysqli_real_escape_string($conn, $_POST['columnyaxisTitle2']);
    $insert_data['columnXAxis'] = mysqli_real_escape_string($conn, $_POST['columnXAxis']);
    $insert_data['yaxis1Value'] = mysqli_real_escape_string($conn, $_POST['yaxis1Value']);
    $insert_data['yaxis2Value'] = mysqli_real_escape_string($conn, $_POST['yaxis2Value']);
    $insert_data['columnscript'] = mysqli_real_escape_string($conn, $columnScript);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertColumnGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Column Graph</strong> has been added successfully";
} 

if ($_POST['graph'] == "Bar Chart") {
    
     $uniqid = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)); // 5 letters (hex chars)
     $randomDigits = substr(str_shuffle('0123456789'), 0, 5); // 5 random digits
    
     $chartId = $uniqid . $randomDigits;
     
     $barScript = str_replace('Bar Script', $_POST['report_id'].$chartId, $_POST['barscript']);
    
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $chartId);
    $insert_data['graph_type'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['barDisplay'] = mysqli_real_escape_string($conn, $_POST['bar2Display']);
    $insert_data['x-coord-title'] = mysqli_real_escape_string($conn, $_POST['xcordtitle']);
    $insert_data['y-coord-title'] = mysqli_real_escape_string($conn, $_POST['ycordtitle']);
    $insert_data['x-coordinate'] = mysqli_real_escape_string($conn, $_POST['xcord']);
    $insert_data['x-value'] = mysqli_real_escape_string($conn, $_POST['bval']);
    $insert_data['graph_script'] = mysqli_real_escape_string($conn, $barScript);
    $insert_data['main_title'] = mysqli_real_escape_string($conn, $_POST['headerbartitle']);
    $insert_data['sub_title'] = mysqli_real_escape_string($conn, $_POST['headerbarsubtitle']);
    $insert_data['bar-value-color'] = mysqli_real_escape_string($conn, $_POST['bcol']);
    $insert_data['bar-format'] = mysqli_real_escape_string($conn, $_POST['bformat']);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Bar Graph</strong> has been added successfully";
} 

if ($_POST['graph'] == "Pie Chart") {
    
     $uniqid = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)); // 5 letters (hex chars)
     $randomDigits = substr(str_shuffle('0123456789'), 0, 5); // 5 random digits
    
     $chartId = $uniqid . $randomDigits;
     
     $pieScript = str_replace('Pie Script', $_POST['report_id'].$chartId, $_POST['piescript']);
    
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartId'] = mysqli_real_escape_string($conn, $chartId);
    $insert_data['barDisplay'] = mysqli_real_escape_string($conn, $_POST['pieDisplay']);
    $insert_data['pieoptions'] = mysqli_real_escape_string($conn, $_POST['pieoption']);
    $insert_data['piepercentages'] = mysqli_real_escape_string($conn, $_POST['pieoptioncount']);
    $insert_data['piecolors'] = mysqli_real_escape_string($conn, $_POST['pieoptioncol']);
    $insert_data['graph_script'] = mysqli_real_escape_string($conn, $pieScript);
    $insert_data['main_title'] = mysqli_real_escape_string($conn, $_POST['headerpietitle']);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertPieGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Pie Chart</strong> has been added successfully";
} 
if ($_POST['graph'] == "Point Chart") {
    
     $uniqid = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)); // 5 letters (hex chars)
     $randomDigits = substr(str_shuffle('0123456789'), 0, 5); // 5 random digits
    
     $chartId = $uniqid . $randomDigits;
     
     $pointScript = str_replace('Point Script', $_POST['report_id'].$chartId, $_POST['pointscript']);
    
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['chartid'] = mysqli_real_escape_string($conn, $chartId);
    $insert_data['barDisplay'] = mysqli_real_escape_string($conn, $_POST['pointDisplay']);
    $insert_data['years'] = mysqli_real_escape_string($conn, $_POST['pointyears']);
    $insert_data['reportTitle'] = mysqli_real_escape_string($conn, $_POST['headerpointtitle']);
    $insert_data['graphType'] = mysqli_real_escape_string($conn, $_POST['graph']);
    $insert_data['yaxisTitle'] = mysqli_real_escape_string($conn, $_POST['pointyaxisTitle']);
    $insert_data['northAmerica'] = mysqli_real_escape_string($conn, $_POST['pointnorthAmerica']);
    $insert_data['latinAmerica'] = mysqli_real_escape_string($conn, $_POST['pointlatinAmerica']);
    $insert_data['europe'] = mysqli_real_escape_string($conn, $_POST['pointeurope']);
    $insert_data['asiaPacific'] = mysqli_real_escape_string($conn, $_POST['pointasiaPacific']);
    $insert_data['middleEastA'] = mysqli_real_escape_string($conn, $_POST['pointmiddleEastA']);
    $insert_data['barscript'] = mysqli_real_escape_string($conn, $pointScript);
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_graph->insertPointGraph($insert_data, 0);

    $_SESSION['success'] = "<strong>Point Graph</strong> has been added successfully";
} 
header("Location:manage-report");
exit(0);
?>