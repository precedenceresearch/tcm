<?php
require_once("classes/cls-media.php");

$obj_media = new Media();
$conn = $obj_media->getConnectionObj();
$target_dir = "../insightimg/";

//$target_dir_crop = "../insightimg/crop/";
$target_file = $target_dir . basename(str_replace(" ","-",$_FILES["img"]["name"]));
$table_file = SITEPATH."insightimg/".basename(str_replace(" ","-",$_FILES["img"]["name"]));
//$target_crop_file = $target_dir_crop . basename($_FILES["img"]["name"]);
$uploadOk = 0;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$filename_without_ext = pathinfo($target_file, PATHINFO_FILENAME);


if(isset($_POST['editimgid']))
{
    $condition = "`id` = '" . $_POST['editimgid'] . "'";
    $update_data['imagepath'] = $table_file;
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_media->updateMedia($update_data, $condition, 0);
    $imgname=str_replace(" ","-",$_POST['editimg']);
   //$target_dir
//   if(file_exists($target_file))
//   {
//       echo "dd";
//       unlink($target_file);
//   }
//   echo $target_file; die();
    unlink($target_file);
}
else
{
    $fields="*";
    $condition12 = "`predr_media`.`imagepath`='".$table_file."'";
    $media_exists = $obj_media->getMediaDetails($fields, $condition12, '', '', 0);
    $media_exist = end($media_exists);
    
    if(count($media_exists)>0)
    {
        $condition = "`id` = '" . $media_exist['id'] . "'";
        $update_data['imagepath'] = $table_file;
        $update_data['updated_at'] = date("Y-m-d h:i:s");
        $obj_media->updateMedia($update_data, $condition, 0);
    }
    else
    {
        $insert_data['imagepath'] = $table_file;
        $insert_data['status'] = 'Active';
        $insert_data['created_at'] = date("Y-m-d h:i:s");
        $insert_data['updated_at'] = date("Y-m-d h:i:s");
        $obj_media->insertMedia($insert_data, 0);
    }
    $imgname=str_replace(" ","-",$_POST['editimg']);
    unlink($target_file); 
}
   if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) 
   {
    //  list($width, $height) = getimagesize($target_file);
   
    // // Reduce width and height to half
    //  $new_width = 100;
    //  $new_height = 100;
    //  $newimage = imagecreatetruecolor($new_width,$new_height);
    //  if($imageFileType=="jpg" || $imageFileType=="jpeg")
    //  {
    //      $source = imagecreatefromjpeg($target_file);
    //  }
    //  if($imageFileType=="png")
    //  {
    //     $source = imagecreatefrompng($target_file);
    //  }
     
    //  imagecopyresampled($newimage,$source,0,0,0,0,$new_width,$new_height,$width,$height);
    //  $cropfilename=$filename_without_ext."-crop.".$imageFileType;
    //  if($imageFileType=="jpg" || $imageFileType=="jpeg")
    //  {
    //   imagejpeg($newimage,$target_dir_crop.$cropfilename);
    //  }
    //  if($imageFileType=="png")
    //  {
    //   imagepng($newimage,$target_dir_crop.$cropfilename);
    //  }
     
     
     $uploadOk = 1;
   } 
   

if($uploadOk==1)
{
    header("location:upload-media");
    exit();
}


  

?>